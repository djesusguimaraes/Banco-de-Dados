<?php

require '../bd/models/Servico.php';

include_once '../bd/db.ini.php';

use connPHPPostgres\ServicoModel as ServicoModel;

$Nome_servico = null;
$Descricao = null;
$ID_servico = null;

if(!empty($_POST['servico'])){
    $ID_servico = $_REQUEST['servico'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Nome_servico =  $_REQUEST['nome'];
    $Descricao =  $_REQUEST['descricao'];
    $ID_servico = $_REQUEST['servico'];
    
    try {
        $clientRegister = new ServicoModel($pdo);
        $clientRegister->insert($Nome_servico, $Descricao, $ID_servico);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
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
    
</head>
<body>
    <header>
    <!-- <div class="esquerda"><a href="../index.php"><img src="../img/backbutton.png" height="20px"></a></div> -->
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
    <div class="central">
        <form class="pure-form pure-form-stacked" action="CadastroServico.php" method="post">
            <fieldset>
                <legend>Dados do Serviço</legend>
                <label for="stacked-name">Serviço</label>
                <input type="text" value="<?php echo !empty($$Nome_servico) ? $Nome_servico : ''; ?>" name="nome" id="stacked-name" placeholder="Serviço..." />
                <span class="pure-form-message">Campo obrigatório.</span>
                <label for="Descrição">Descrição</label>
                <input type="text" value="<?php echo !empty($Descricao) ? $Descricao : ''; ?>" name="descricao" id="descricao" autocomplete="off" placeholder="Descreva o serviço..."/>
                <span class="pure-form-message">Campo obrigatório.</span>
                <label for="tel">Número de serviço</label>
                <input type="text" value="<?php echo !empty($ID_servico) ? $ID_servico : ''; ?>" name="servico" id="servico"/>
            </fieldset>
            <button type="submit" class="pure-button pure-button-primary" value="Cadastrar">Cadastrar</button>
        </form> 

    </div>

</body>

</html>