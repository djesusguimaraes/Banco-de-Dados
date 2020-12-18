<?php

Class banco
{

    private static $servername = "localhost";
    private static $username = "root";
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
                self::$conn = new PDO("pgsql:host=" .self::$servername, "username=" .self::$username, "password=" .self::$password, "dbName=" .self::$dbName);
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
