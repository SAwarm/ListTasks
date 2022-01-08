<?php

class Connection
{

    private $host   =   'localhost';
    private $dbname =   'list_tasks';
    private $user   =   'root';
    private $pass   =   '';

    public function connect()
    {
        try {

            $conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->pass"
            );

            return $conn;

        } catch (PDOException $pe) {
            return '<p>' . $pe->getMessage() . '</p>';
        }
    }
}
