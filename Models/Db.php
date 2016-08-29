<?php
namespace Models;

class Db
{
    const DBNAME = 'dbEcho';
    const TABLE = 'table';
    const HOST = '127.0.0.1';
    protected $user = 'root';
    protected $password = '';

    protected $dbh;

    public $queryResult;

    public function __construct()
    {
        $dbName = static::DBNAME;
        try {
            //создаем соединение с БД
            $this->dbh = new \PDO('mysql:host=' . self::HOST . '; dbname=' . $dbName, $this->user, $this->password);
        } catch (\PDOException $e) {
            if (1049!=$e->getCode()) {//ошибка соединения с БД
                die("DB ERROR: " . $e->getMessage());
            } else {//ошибка 1049 - БД не найдена, попытка создать новую БД
                try {
                    $this->dbh = new \PDO('mysql:host=' . self::HOST, $this->user, $this->password);
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

    public function checkTable($tableName = self::TABLE)
    {
        $sql = 'SHOW TABLES LIKE \'' . $tableName . '\'';
        $res = $this->query($sql, Album::class);
        return (0 != count($res));
    }


    public function getVarsToSQL($model)
    {//пробная функия перебора свойств объекта...
        $reflect = new \ReflectionClass($model);
        $props   = $reflect->getProperties();//ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED
        var_dump($props);
    }

    public function createTable ($tableName = self::TABLE, $varsList)
    {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . $tableName . ' (' . $varsList . ');'; //id SERIAL NOT NULL , name VARCHAR(100) NOT NULL , parent INT NOT NULL
        var_dump($sql);
        $this->execute($sql);
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

    public function dropTable($tableName = self::TABLE)
    {
        $this->execute('DROP TABLE ' . $tableName );
    }
}