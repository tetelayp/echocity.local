<?php
namespace Models;

class Db
{

    protected $dbh;

    public $queryResult;

    public function __construct()
    {
        $dbName = Settings::DBNAME;
        $host = Settings::HOST;
        $user = Settings::USER;
        $password = Settings::PASSWORD;

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

    public function insertRecord ($tableName, $data)
    {
        //INSERT INTO `gallery`(`id`, `folder`, `name`, `description`, `dateCreate`, `dateUpdate`, `cover`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])

        $values = $this->getPropsArray($data);

        if (false === $values){
            return false; //получен пустой объект
        }
        $props = '`' . implode('`, `', array_keys($values)) . '`';
        //var_dump($props);

        $values = '\'' . implode('\', \'', $values) . '\'';
        //var_dump($values);

        $sql = 'INSERT INTO `' . $tableName . '` (' . $props . ') VALUES (' . $values . ');';
        //var_dump($sql);
        return $this->execute($sql);
    }

    public function getAllRecords($tableName, $class)
    {
        $sql = 'SELECT * FROM `' . $tableName . '` WHERE 1';
        return $this->query($sql, $class);
    }

    public function getRecordsByID($tableName, $id, $class)
    {
        $sql = 'SELECT * FROM `' . $tableName . '` WHERE id=' . $id;
        return $this->query($sql, $class);
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

    public function query($sql, $class)
    {
        unset($this->queryResult);
        try {
            $sth =  $this->dbh->prepare($sql);
            $res = $sth->execute();
            if (false!==$res) {
                $this->queryResult = $sth->fetchAll(\PDO::FETCH_CLASS, $class);
            } else {
                $this->queryResult = [];
            }
            return $this->queryResult;
        } catch (\Exception $e) {
            die("DB ERROR: ". $e->getMessage());
        }

    }

    public function dropTable($tableName)
    {
        $this->execute('DROP TABLE ' . $tableName );
    }

////////////////////////////////////
    protected function getPropsArray($model)
    {//пробная функия перебора свойств объекта...
        $reflect = new \ReflectionClass($model);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);//ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED
        foreach ($props as $prop) {
            $v = $prop->getValue($model);
            if (isset($v)){
                $v = str_replace('\\\'','`',$v);
                $v = str_replace('\'','`',$v);
                $v = str_replace('"','``',$v);

                $data[$prop->getName()] = $v;
            }

        }
        if (!isset($data)) {return false;}
        return $data;
    }
}