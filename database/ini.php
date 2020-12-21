<?php

require 'connect.php';

use conpostgres\connection as connection;

$pdo = connection::get()->connect();