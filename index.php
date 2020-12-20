<?php

require 'bd/connForDB.php';

use connPHPPostgres\connection as connection;

$pdo = connection::get()->connect();

?>