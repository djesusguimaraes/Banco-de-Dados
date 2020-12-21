<?php

require '../../bd/models/Cliente.php';

include_once '../../bd/db.ini.php';

use connPHPPostgres\ClientModel as ClientModel;

$Nome = null;
$CPF = null;
$Telefone = null;
$Modelo = null;
$Ano = null;
$Carro = null;
$Placa = null;

if(!empty($_POST['cpf'])){
    $CPF = $_REQUEST['cpf'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Nome =  $_REQUEST['nome'];
    $CPF =  $_REQUEST['cpf'];
    $Telefone =  $_REQUEST['tel'];
    $Modelo = $_REQUEST['modelo'];
    $Ano = $_REQUEST['ano'];

    $Carro = $Modelo.$Ano;
    
    $Placa = $_REQUEST['placa'];    
    
    try {
        $clientRegister = new ClientModel($pdo);
        $clientRegister->insert($Nome, $CPF, $Carro, $Telefone, $Placa);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/normalize_pure.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Fugaz+One&family=PT+Sans:ital@1&family=Sarabun:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="../../js/functions.js"></script>
</head>
<body>
    <header>
    <!-- <div class="esquerda"><a href="../index.php"><img src="../img/backbutton.png" height="40px"></a></div> -->
        <div class="pure-menu pure-menu-horizontal">
            <ul class="pure-menu-list">
                <li class="pure-menu-item pure-menu-selected">
                    <a href="#" class="pure-menu-link">Home</a>
                </li>
                <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                    <a href="#" id="menuLink1" class="pure-menu-link">Sobre</a>
                    <ul class="pure-menu-children">
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link">Serviços</a>
                        </li>
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link">Cadastro</a>
                        </li>
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link">Sobre nós</a>
                        </li>
                    </ul>
                </li>
                <li class="pure-menu-item pure-menu-selected">
                    <a href="#" class="pure-menu-link">Administração</a>
                </li>
            </ul>
        </div>
        <div class="topo">
            <p class="logo">JavaLato</p>
            <p class="slogan">Seu carro em boas mãos.</p>
            <img src="../../img/Group 1.png" alt="">
        </div>
    </header>
    <div class="central">
        <h1>Cadastro Cliente</h1>
        <form class="pure-form pure-form-stacked" action="CadastroCliente.php" method="post">
            <fieldset>
                <legend>Dados do Cliente</legend>
                <label for="stacked-name">Nome</label>
                <input type="text" value="<?php echo !empty($Nome) ? $Nome : ''; ?>" name="nome" id="stacked-name" placeholder="Seu nome..." />
                <span class="pure-form-message">Campo obrigatório.</span>
                <label for="cpf">CPF</label>
                <input type="text" oninput="mascara(this, 'cpf')" value="<?php echo !empty($CPF) ? $CPF : ''; ?>" name="cpf" id="cpf" autocomplete="off" placeholder="000.000.000-00" />
                <span class="pure-form-message">Campo obrigatório.</span>
                <label for="tel">Telefone</label>
                <input type="text" oninput="mascara(this, 'tel')" value="<?php echo !empty($Telefone) ? $Telefone : ''; ?>" name="tel" id="tel"/>
            </fieldset>
            <fieldset>
                <legend>Dados do Veículo</legend>
                <label for="stacked-modelo">Modelo</label>
                <input type="text" value="<?php echo !empty($Modelo) ? $Modelo : ''; ?>" name="modelo" id="stacked-name" placeholder="Ford K" />
                <label for="stacked-ano">Ano</label>
                <input type="number" value="<?php echo !empty($Ano) ? $Ano : ''; ?>" name="ano" id="stacked-ano" placeholder="2000" />
                <label for="stacked-placa">Placa</label>
                <input type="text" max-lenght="7" value="<?php echo !empty($Placa) ? $Placa : ''; ?>" name="placa" id="stacked-placa" placeholder="ABC1234" />
            </fieldset>    
            <button type="submit" class="pure-button pure-button-primary" value="Cadastrar">Cadastrar</button>
        </form>
    </div>
</body>
    
</html>