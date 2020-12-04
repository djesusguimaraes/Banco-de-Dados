<?php

namespace ConexaoPostGre;

class connection
{
    private static $conn;

    public function connect()
    {
        // Le os parametros do banco do dados -> database.ini
        $params = parse_ini_file('stratch.ini');
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
}