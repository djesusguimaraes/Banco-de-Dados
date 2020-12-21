<?php

require '../bd/models/Cliente.php';
// require '../database/Employer.php';

include_once '../bd/db.ini.php';

use ConexaoPHPPostgres\ClientModel as ClientModel;
// use ConexaoPHPPostgres\EmployerModel as EmployerModel;

$ClientModel = new ClientModel($pdo);
// $employerModel = new EmployerModel($pdo);

$CPF = null;
// $dependent_name = "";

if (!empty($_GET['cpf'])) { // && !empty($_GET['dependent_name'])) {
    $CPF = $_REQUEST['cpf'];
    //$dependent_name = $_REQUEST['dependent_name'];
    $Client = $ClientModel->deleteByCPF($CPF);
}