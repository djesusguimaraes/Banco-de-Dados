<?php

namespace conpostgres;

Class connection
{
    public static $conn;

    public static function connect()
    {
        $params = parse_ini_file('portas.ini');
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