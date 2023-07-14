<?php
class BaseModel
{
    private $dbHost = HOST;
    private $dbName = DB;
    private $dbUser = USER;
    private $dbPassword = PASS;
    private $charset = 'utf8mb4';

    public function connect()
    {
        $dsn = "mysql:host=$this->dbHost;dbname=$this->dbName;charset=$this->charset";
//        $dsn = "$this->dbHost;dbname=$this->dbName;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $conn = new PDO($dsn, $this->dbUser, $this->dbPassword, $options);
            return $conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
