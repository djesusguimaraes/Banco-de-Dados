<?php

require '../bd/models/Cliente.php';

include_once '../bd/db.ini.php';

use ConnPHPPostgres\ClientModel as ClientModel;

$ClientModel = new ClientModel($pdo);

$CPF = null;

if (!empty($_GET['cpf'])) {
    $CPF = $_REQUEST['cpf'];
    $Client = $ClientModel->showByCPF($CPF);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CPF = $_POST['cpf'];
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
    <link rel="stylesheet" href="../../css/normalize_pure.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Fugaz+One&family=PT+Sans:ital@1&family=Sarabun:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="../../js/functions.js"></script>
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
    <?php if (!empty($Client)) : ?>
        <div class="container">

            <div>
                <!-- <div class="col"><a href="../pages/funcionarios.php"><img src="../assets/images/backbutton.png" height="30px"></a></div> -->
                <div class="col">
                    <h4>Remover Cliente</h4>
                </div>
                <div class="col"></div>
            </div>

            <!-- <div class="span10">
                <div style="padding-top: 10px;">
                    <div class="card">
                        <div class="card-body"> -->
                            <h5 class="">Nome: <?php echo htmlspecialchars($Client['Nome']); ?></h5>
                            <!-- <h6 class="card-subtitle mb-2 text-muted">Parente relacionado: <?php
                                                                                            //$employer = $employerModel->getById($dependent['essn']);
                                                                                            //echo htmlspecialchars($employer['fname']), " ", htmlspecialchars($employer['lname']);
                                                                                            ?></h6>--> 
                            <form class="" action="ShowCliente.php?id=<?php echo $Client['CPF']; ?>" method="post">
                                <!-- Alerta em caso de erro -->
                                <!-- <?php //if (!empty($error)) : ?>
                                    <span class="text-danger"><?php //echo $error; ?></span>
                                <?php //endif; ?> -->

                                <input type="hidden" name="CPF" value="<?php echo $CPF; ?>" />

                                <!-- <div class="alert  alert-danger" role="alert">
                                    <h5> Deseja excluir o Funcionário? </h5>
                                    <div class="form actions">
                                        <button type="submit" class="btn btn-danger"> Sim </button>
                                        <a href="../pages/funcionarios.php" type="btn" class="btn btn-default"> Não </a>
                                    </div>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>

</html>