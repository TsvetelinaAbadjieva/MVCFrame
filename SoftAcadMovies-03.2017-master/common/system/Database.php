<?php

class Database
{

    const DB_HOST     = '127.0.0.1';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const DB_NAME     = 'movies';

    private static $instance = null;

    private $connection;

    private function __construct()
    {
        $connection = mysqli_connect(
            self::DB_HOST,
            self::DB_USERNAME,
            self::DB_PASSWORD,
            self::DB_NAME
        );

        if (!$connection) {
            echo mysqli_connect_error(); die;
        }

        $this->connection = $connection;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            $db = new Database();
            self::$instance = $db;
        }

        return  self::$instance;
    }


    public function query($sql)
    {
        return mysqli_query($this->connection, $sql);
    }

    public function translate($result)
    {
        return mysqli_fetch_assoc($result);
    }
    
    public function last_id()
    {
        return mysqli_insert_id($this->connection);
    }
    
    public function error() {
        die(mysqli_error($this->connection));
    }

    public function affected_rows()
    {
        return mysqli_affected_rows($this->connection);
    }

    public function escape($data) {

        $escapeData = [];
        foreach ($data as $key => $value) {
            $escapeData[$key] = mysqli_real_escape_string($this->connection, $value);
        }

        return $escapeData;
    }
}