<?php


require 'connection.php';

use ConexaoPostGre\connection as Connection;

$pdo = Connection::get()->connect();

