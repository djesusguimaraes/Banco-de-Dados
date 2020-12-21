<?php

require '../../bd/models/Funcionario.php';

include_once '../../bd/db.ini.php';

use connPHPPostgres\FuncionarioModel as FuncionarioModel;
$funcionarioRegister = new FuncionarioModel($pdo);

$Nome_funcionario = null;
$CPF = null;
$Telefone = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Nome_funcionario =  $_REQUEST['nome'];
    $CPF =  $_REQUEST['cpf'];
    $Telefone = $_REQUEST['tel'];

    try {
        $funcionarioRegister->insert($Nome_funcionario, $CPF, $Telefone);
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
    <script src="../js/functions.js"></script>
    
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
            <img src="../../img/Group 1.png" alt="">
        </div>
    </header>
    <div class="esquerda">
        <form class="pure-form pure-form-stacked" action="CadastroFuncionario.php" method="post">
            <fieldset>
                <legend>Dados do Funcionário</legend>
                <label for="stacked-name">Nome Funcionário</label>
                <input type="text" value="<?php echo !empty($Nome_funcionario) ? $Nome_funcionario : ''; ?>" name="nome" id="stacked-name" placeholder="Seu nome..." />
                <span class="pure-form-message">Campo obrigatório.</span>
                <label for="cpf">CPF</label>
                <input type="text" oninput="mascara(this, 'cpf')" value="<?php echo !empty($CPF) ? $CPF : ''; ?>" name="cpf" id="cpf" autocomplete="off" placeholder="000.000.000-00" />
                <span class="pure-form-message">Campo obrigatório.</span>
                <label for="tel">Telefone</label>
                <input type="text" oninput="mascara(this, 'tel')" value="<?php echo !empty($Telefone) ? $Telefone : ''; ?>" name="tel" id="tel"/>
            </fieldset>   
            <button type="submit" class="pure-button pure-button-primary" value="Cadastrar">Cadastrar</button>
        </form>
    </div>
    <div class="direita">
        
    </div>
</body>

</html>