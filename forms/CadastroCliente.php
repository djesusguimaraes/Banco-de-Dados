<?php

require '../bd/models/Funcionario.php';

include_once '../bd/db.ini.php';

use connPHPPostgres\FuncionarioModel as FuncionarioModel;

// $Telefone = null;
$Nome = null;
$CPF = null;
// $ID_servico = 0;

if(!empty($_POST['cpf'])){
    $CPF = $_REQUEST['cpf'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Nome =  isset($_POST['nome']) ? $_POST['nome']: ' ';
    $CPF =  isset($_POST['cpf']) ? $_POST['cpf']: ' ';
    // $Modelo = isset($_POST['modelo']) ? $_POST['modelo']: ' ';
    // $Ano = isset($_POST['ano']) ? $_POST['ano']: ' ';
    // $Carro = isset($_POST['modelo']) ? $_POST['carro']: ' ';
    // $Telefone =  isset($_POST['tel']) ? $_POST['tel']: ' ';
    
    // $ID_servico =  $_POST['servico'];

    try {
        $clientRegister = new FuncionarioModel($pdo);
        $clientRegister->insertINto($Nome, $CPF);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    <title>Adicionar novo dependente</title>
</head>

<body>
    <div class="container">

        <div class="row py-5">
            <!-- <div class="col"><a href="../pages/funcionarios.php"><img src="../assets/images/backbutton.png" height="30px"></a></div> -->
            <div class="col">
                <h4>Cadastrar novo dependente</h4>
            </div>
            <div class="col"></div>
        </div>

        <form action="CadastroCliente.php" method="post">
            <!-- Alerta em caso de erro -->
            <?php if (!empty($error)) : ?>
                <span class="text-danger"><?php echo $error; ?></span>
            <?php endif; ?>

            <!-- <input type="hidden" name="id" value="<?php echo $id; ?>" /> -->

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input class="form-control" value="<?php echo !empty($Nome) ? $Nome : ''; ?>" type="text" name="nome" id="nome" required>
            </div>

            <!-- <div class="form-group">
                <label for="Sex">Sexo:</label>
                <br>
                <input type="radio" id="male" name="sex" value="M" <?php echo $sex === 'M' ? "checked" : '' ?> required>
                <label for="male">Masculino</label><br>
                <input type="radio" id="female" name="sex" value="F" <?php echo $sex === 'F' ? "checked" : '' ?>>
                <label for="female">Feminino</label><br>
                <input type="radio" id="other" name="sex" value="O" <?php echo $sex == 'O' ? "checked" : '' ?>>
                <label for="other">Outro</label>
            </div> -->


            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input class="form-control" type="text" value="<?php echo !empty($CPF) ? $CPF : ''; ?>" name="cpf" id="cpf" required>
            </div>

            <!-- <div class="form-group">
                <label for="tel">ID:</label>
                <input class="form-control" value="<?php echo !empty($ID_funcionario) ? $ID_funcionario : ''; ?>" type="text" name="fucionario" id="fucionario" required>
            </div> -->

            <input class="btn btn-primary" type="submit" value="Cadastrar">

        </form>
    </div>

</body>

</html>



<!-- <!DOCTYPE html>
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
                    <a href="#" id="menuLink1" class="pure-menu-link">Contact</a>
                    <ul class="pure-menu-children">
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link">Email</a>
                        </li>
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link">Twitter</a>
                        </li>
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link">Tumblr Blog</a>
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
        <div class="esquerda">
            <h1>Solicitação de Serviços</h1>
            <form name="cadCliente" class="pure-form pure-form-aligned" action="CadastroCliente.php" method="post">
                <fieldset id="cliente">
                    <legend>Dados do Cliente</legend>
                    <div class="pure-control-group">
                        <label for="name" class="pure-label">Nome</label>
                        <input type="text" value="<?php echo !empty($Nome) ? $Nome : ''; ?>" name="nome" id="nome" placeholder="Digite seu nome..." required/>
                        <span class="pure-form-message-inline">*</span>
                    </div>
                    <div class="pure-control-group">
                        <label for="cpf" class="pure-label">CPF</label>
                        <input oninput="mascara(this, 'cpf')" type="text" value="<?php echo !empty($CPF) ? $CPF : ''; ?>" name="cpf" id="cpf" autocomplete="off" placeholder="Digite seu CPF..." required/>
                        <span class="pure-form-message-inline">*</span>
                    </div>
                    <div class="pure-control-group">
                        <label for="foo" class="pure-label">Contato</label>
                        <input oninput="mascara(this, 'tel')" maxlength="12" type="text" value="<?php echo !empty($Telefone) ? $Telefone : ''; ?>" name="tel" id="tel" placeholder="Digite seu telefone..."/>
                    </div>
                </fieldset>
                <fieldset id="veiculo">
                    <legend>Dados do Veículo</legend>
                    <div class="pure-control-group">
                        <label for="" class="pure-label">Modelo</label>
                        <input type="text" value="<?php echo !empty($Modelo) ? $Modelo : ''; ?>" name="modelo" id="modelo"/>
                    </div>
                    <div class="pure-control-group">
                        <label for="ano" class="pure-label">Ano</label>
                        <input type="number" value="<?php echo !empty($Ano) ? $Ano : ''; ?>" name="ano" id="ano"/>
                    </div>
                    <!-- <div class="pure-control-group">
                        <label for="servico" class="pure-label">Ano</label>
                        <input type="number" value="" name="servico" id="servico"/>
                    </div> -->
                </fieldset>
                <fieldset>
                    <!-- <legend>Escolha Serviços</legend>
                    <div class="pure-control-group">
                        <label for="servico" class="pure-label">Opções</label>
                        <div class="pure-control-group">
                            <select name="simples" id="servico" class="opcao">
                                <option value="1">Ducha Simples</option>
                                <option value="2">Ducha Completa</option>
                                <option value="3">Limpeza Completa</option>
                                <option value="4">Aplicação de Cera de Alta Tecnologia</option>
                                <option value="5">Higienização e Hidratação em Bancos</option>
                                <option value="6">Higienização de Ar Condicionado</option>
                                <option value="7">Higienização de Teto</option>
                                <option value="8">Hipermeabilização de Tecido</option>
                                <option value="9">Lavagem Técnica do Motor</option>
                                <option value="10">Descontaminação de Pintura</option>
                                <option value="11">Vitrificação de Pintura</option>
                                <option value="12">Tira Riscos</option>
                                <option value="13">Polimento Técnico</option>
                                <option value="14">Insul Film</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="pure-controls">
                        <button type="submit" class="pure-button pure-button-primary" value="Cadastrar">Wash</button>
                    </div>
                </fieldset>
            </form>
        </div>

        <div class="direita">
            <!-- <h1>Lista de Serviços</h1>
            <ol type="1" class="lista_opcoes">
                <li>Ducha Simples</li>
                <li>Ducha Completa</li>
                <li>Limpeza Completa</li>
                <li>Aplicação de Cera de Alta Tecnologia</li>
                <li>Higienização e Hidratação em Bancos</li>
                <li>Higienização de Ar Condicionado</li>
                <li>Higienização de Teto</li>
                <li>Hipermeabilização de Tecido</li>
                <li>Lavagem Técnica do Motor</li>
                <li>Descontaminação de Pintura</li>
                <li>Vitrificação de Pintura</li>
                <li>Tira Riscos</li>
                <li>Polimento Técnico</li>
                <li>Insul Film</li>
            </ol>
        </div> -->
    </div>
</body>
    
</html> -->