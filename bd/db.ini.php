<?php

require 'connForDB.php';

echo "db.ini\n";

use connPHPPostgres\connection as connection;

$pdo = connection::get()->connect();