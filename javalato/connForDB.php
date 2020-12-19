<?php

namespace connPHPPostgres;

Class connection
{

    private static $servername = "localhost";
    private static $username = "root";
    private static $port = "5432"; //find connection port
    private static $password = "";
    private static $dbName = "javalato";

    private static $conn = null;

    public function __construct()
    {
        self::connect();
    }

    public static function connect()
    {
        if (self::$conn == null)
        {
            try {
                self::$conn = new \PDO("pgsql:host=" .self::$servername.";". "port=" .self::$port, "dbName=" .self::$dbName,"username=" .self::$username, "password=" .self::$password);
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $exception)
            {
                die($exception->getMessage());
            }
        }
        return self::$conn;
    }

    public static function disconnect()
    {
        self::$conn = null;
    }
}
