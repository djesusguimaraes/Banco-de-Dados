<?php

require '../bd/models/Cliente.php';

include_once '../bd/db.ini.php';

use connPHPPostgres\ClientModel as ClientModel;

$ClientModel = new ClientModel($pdo);

$CPF = null;

if (!empty($_GET['CPF'])) {
    echo "eu to aqui porra1";
    $CPF = $_REQUEST['CPF'];
    $Client = $ClientModel->showByCPF($CPF);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CPF = $_POST['CPF'];
    try {
        $ClientModel->deleteByCPF($CPF);
        header("Location: ../../index.php");
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/normalize_pure.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Fugaz+One&family=PT+Sans:ital@1&family=Sarabun:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="../js/functions.js"></script>
    <title>Lista de Clientes</title>
</head>

<body>
    <header>
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
            <img src="../img/Group 1.png" alt="">
        </div>
    </header>
        <div class="esquerda">
            <table border = "1">
            <tr> 
            <th>Nome</th> 
            <th>CPF</th> 
            <th>Telefone</th> 
            <th>ID do Funcionário</th>
            <th></th> 
            </tr>
            <!-- <th>Nome: <?php //echo htmlspecialchars($Client['Nome']); ?></th> -->
            <th>
                <th action="ShowCliente.php?id=<?php echo $Client['CPF']; ?>" method="post">
                    <input type="hidden" name="CPF" value="<?php echo $CPF; ?>" /> 
                </form>
            </th>
    </body>

</html>
   