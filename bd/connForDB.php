<?php

namespace connPHPPostgres;

Class connection
{

    // private static $host = "localhost";
    // private static $user = "root";
    // private static $port = "5432"; //find connection port
    // private static $password = "farofa";
    // private static $dbname = "javalato";
// $conn = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
    public static $conn;

    public static function connect()
    {
        $params = parse_ini_file('paramsPDO.ini');
        if ($params === false) {
            throw new \Exception("Error reading database configuration file");
        }
        // Conecta ao postgres
        $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
                $params['host'], 
                $params['port'], 
                $params['database'], 
                $params['user'], 
                $params['password']);

        $pdo = new \PDO($conStr);
        
  
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
        /**
     * retorna uma instancia da coneccao do banco de dados
     * @return type
     */
    public static function get() {
        if (null === static::$conn) {
            static::$conn = new static();
        }
        
        return static::$conn;
    }
    
}