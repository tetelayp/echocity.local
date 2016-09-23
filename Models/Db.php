<?php
namespace Models;

class Db
{

    protected $dbh;

    public $queryResult;

    public function __construct()
    {
        $dbName = \Settings::DBNAME;
        $host = \Settings::HOST;
        $user = \Settings::USER;
        $password = \Settings::PASSWORD;

        try {
            //создаем соединение с БД
            $this->dbh = new \PDO('mysql:host=' . $host . '; dbname=' . $dbName, $user, $password);
        } catch (\PDOException $e) {
            if (1049!=$e->getCode()) {//ошибка соединения с БД
                die("DB ERROR: " . $e->getMessage());
            } else {//ошибка 1049 - БД не найдена, попытка создать новую БД
                try {
                    $this->dbh = new \PDO('mysql:host=' . $host, $user, $password);
                    $this->createDataBase($dbName);
                    $sql = 'USE ' . $dbName;
                    $sth = $this->dbh->prepare($sql);
                    $sth->execute();
                } catch (\PDOException $e) { // ошибка создания БД
                    die("DB ERROR: " . $e->getMessage());
                }
            }
        }

    }

    public function createDataBase($dbName)
    {
        $sql = 'CREATE DATABASE IF NOT EXISTS ' . $dbName . ';';

        $this->execute($sql);
    }

    public function checkTable($tableName)
    {
        $sql = 'SHOW TABLES LIKE \'' . $tableName . '\'';
        $res = $this->query($sql, Album::class);
        return (0 != count($res));
    }

    public function createTable ($tableName, $varsList)
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . $tableName . ' (' . $varsList . ');'; //id SERIAL NOT NULL , name VARCHAR(100) NOT NULL , parent INT NOT NULL
        return $this->execute($sql);
    }

    /**
     * @param $tableName
     * @param $data
     * @return bool
     *
     *  if isset $data->id - UPDATE other INSERT
     */
    public function insertUpdateRecord ($tableName, $data)
    {
        //INSERT INTO `gallery`(`id`, `folder`, `name`, `description`, `dateCreate`, `dateUpdate`, `cover`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])
        //UPDATE `test3`.`users` SET `name` = 'PPaaaaaa', `parent` = '1' WHERE `users`.`id` = 18

        $propArray = $this->getPropsArray($data);

        if (false === $propArray){
            return false; //получен пустой объект
        }

        $propArray = $this->encodeSpecialChars($propArray);

        if (isset($propArray['id'])) {
            //update record
            $id = $propArray['id'];
            unset($propArray['id']);
            $sql='UPDATE `' . $tableName . '` SET ';
            foreach ($propArray as $prop=>$value){
                $sql .= '`' . $prop . '` = \'' . $value . '\', ';
            }
            $sql = substr($sql, 0, (strlen($sql)-2)) . 'WHERE `id` = ' . $id;
        } else {
            //insert record
            $props = '`' . implode('`, `', array_keys($propArray)) . '`';
            //var_dump($props);

            $values = '\'' . implode('\', \'', $propArray) . '\'';
            //var_dump($values);

            $sql = 'INSERT INTO `' . $tableName . '` (' . $props . ') VALUES (' . $values . ');';
            //var_dump($sql);
        }

        return $this->execute($sql);
    }

    public function getAllRecords($tableName, $class)
    {
        $sql = 'SELECT * FROM `' . $tableName . '` WHERE 1';
        $result = $this->query($sql, $class);
        return $result;
    }

    public function getRecordsByID($tableName, $id, $class)
    {
        $sql = 'SELECT * FROM `' . $tableName . '` WHERE `id`=' . $id;
        $result = $this->query($sql, $class);
        return $result;
    }

    public function deleteRecordsByID($tableName, $id)
    {
        //DELETE FROM `test3`.`users` WHERE `users`.`id` = 342
        $sql = 'DELETE FROM `' . $tableName . '` WHERE `id`=' . $id;
        $result = $this->execute($sql);
        return $result;
    }



    public function execute($sql)
    {
        try {
            $sth =  $this->dbh->prepare($sql);
            return $sth->execute();

        } catch (\Exception $e) {
            die("DB ERROR: ". $e->getMessage());
        }

    }

    public function query($sql, $class = null)
    {
        unset($this->queryResult);
        //var_dump($sql);
        try {
            $sth =  $this->dbh->prepare($sql);
            $res = $sth->execute();
            if (false!==$res) {
                if (!$class)
                {
                    $this->queryResult = $sth->fetchAll();
                } else {
                    $this->queryResult = $sth->fetchAll(\PDO::FETCH_CLASS, $class);
                }

            } else {
                $this->queryResult = [];
            }


            return $this->decodeSpecialCharsInarrayOfObjects($this->queryResult);

            //return $this->queryResult;
        } catch (\Exception $e) {
            die("DB ERROR: ". $e->getMessage());
        }

    }

    public function dropTable($tableName)
    {
        $this->execute('DROP TABLE ' . $tableName );
    }

/////////////////////////////////////////////////////////////////////////////////////
    protected function getPropsArray($model)
    {//пробная функия перебора свойств объекта...
        $reflect = new \ReflectionClass($model);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);//ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED
        foreach ($props as $prop) {
            $v = $prop->getValue($model);
            if (isset($v)){
                //$v = str_replace('\\\'','`',$v); // replace ' -> `
                //$v = str_replace('\'','`',$v);   // replace ' -> `
                //$v = str_replace('"','``',$v);   // replace " -> `

                $v = str_replace('<?','=?',$v);
                $v = str_replace('?>','?=',$v);
                $v = str_replace('<script>','=script=',$v);
                $v = str_replace('</script>','=/script=',$v);

                $data[$prop->getName()] = $v;
            }

        }
        if (!isset($data)) {return false;}
        return $data;
    }

    protected function encodeSpecialChars($arrayOfStringsWithSpecialChars)
    {
        if (!$arrayOfStringsWithSpecialChars) return false;
        foreach ($arrayOfStringsWithSpecialChars as $key=>$value){
            if (isset($value)){
                $arrayOfStringsWithSpecialChars[$key] = htmlspecialchars($value, ENT_QUOTES); // Преобразует специальные символы в HTML-сущности
            }
        }
        return $arrayOfStringsWithSpecialChars;
    }


    protected function decodeSpecialChars($arrayOfEncodedStrings)
    {
        //var_dump($arrayOfEncodedStrings);
        if (!$arrayOfEncodedStrings) return false;
        foreach ($arrayOfEncodedStrings as $key=>$value){
            if (isset($value)){
                $arrayOfEncodedStrings[$key] = htmlspecialchars_decode($value, ENT_QUOTES);
            }
        }
        //var_dump($arrayOfEncodedStrings);
        return $arrayOfEncodedStrings;
    }


    protected function decodeSpecialCharsInArrayOfObjects($arrayOfObjects)
    {
        //var_dump($arrayOfObjects);
        if (count($arrayOfObjects)>0){
            if (is_object($arrayOfObjects[0])){
                foreach ($arrayOfObjects as $k=>$v){
                    $propArray = $this->getPropsArray($v);
                    $propArray = $this->decodeSpecialChars($propArray);
                    foreach ($propArray as $prop=>$value){
                        if (isset($value)){
                            $arrayOfObjects[$k]->$prop =  $value;
                        }
                    }
                }
            }

        }
        return $arrayOfObjects;
    }

}

