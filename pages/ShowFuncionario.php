<?php

require '../db/models/Funcionario.php';

include_once '../db/db.ini.php';

use ConexaoPHPPostgres\FuncionarioModel as FuncionarioModel;

$funcionarioModel = new FuncionarioModel($pdo);

try{
    $funcionarios = $funcionarioModel->show();
}catch(PDOException $e){
    $erro = $e->getMessage();
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
    
    <div class="direita">
        <table border="1"> 
            <tr> 
            <th>Nome</th> 
            <th>CPF</th> 
            <th>Telefone</th> 
            <th>ID do Funcionário</th> 
            </tr> 
            <?php while($dado = $stmt->fetch_array()) { ?> 
            <tr> 
            <td><?php echo $dado['Nome_funcionario']; ?></td>
            <td><?php echo $dado['CPF']; ?></td> 
            <td><?php echo $dado['Telefone']; ?></td>  
            <td><?php echo $dado['ID_funcionario']; ?></td>  
            </tr> 
            <?php } ?> 
        </table>
    </div>
</body>

</html>