<?php
class Database
{
    public function connect()
    {
        $host = 'localhost';
        $db = 'myda';
        $user = 'myda_admin';
        $pass = 'qfvPg!LUq[Ee-_03';

        $dsn = "mysql:host=$host; dbname=$db; charset=UTF8";
        try {
            $pdo = new PDO($dsn, $user, $pass);
            return $pdo;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}