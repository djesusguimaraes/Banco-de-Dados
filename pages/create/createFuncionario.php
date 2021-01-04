<?php

require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\FuncionarioModel as FuncionarioModel;
$funcionarioRegister = new FuncionarioModel($pdo);

$nome = null;
$cpf = null;
$telefone = null;
$funcao = null;
$url = null;
$texto = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome =  $_REQUEST['nome'];
    $cpf =  $_REQUEST['cpf'];
    $telefone = $_REQUEST['tel'];
    $funcao = $_REQUEST['funcao'];

    try {
        $funcionarioRegister->insert($nome, $cpf, $telefone, $funcao);
        $url = 1;
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
        $url = $error;
    }
}
if ($url == 1){
    $texto = ("<div class=\"alert alert-success\" role=\"alert\">Funcionário cadastrado com sucesso!<a href=\"http://localhost/javalato/pages/adm.php\" ><button class=\"btn btn-outline-success btn-sm float-right\" style=\"padding: 5px; margin-top: -4px;\">Voltar à seleção</button></a></div>");
}else if($url != null){
    $texto = ("<div class=\"alert alert-danger\" role=\"alert\">$url<a href=\"http://localhost/javalato/pages/adm.php\" ><button class=\"btn btn-outline-danger btn-sm float-right\" style=\"padding: 5px; margin-top: 0px;\">Voltar à seleção</button></a></div>");
}
?>
<?php
require '../../templates/header.php';
?>
<div class="container" style="margin-top: 30px;">
    <div class="form-inline">
        <a href="http://localhost/javalato/pages/adm.php"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <h2><strong>Cadastro de Funcionário</strong></h2>  
    </div><br>
    <?php echo $texto; ?>
    <form action="createFuncionario.php" method="post">
        <fieldset>
            <div class="form-group">
                <label for="nome">Nome Completo*</label>
                <input type="text" class="form-control" max-lenght="80" name="nome" id="nome" placeholder="Seu nome" required>
                <!-- <small id="help" class="form-text text-muted">Campo Obrigatório</small> -->
            </div>
            <div class="form-group">
                <label for="cpf">CPF*</label>
                <input type="text" oninput="mascara(this, 'cpf');" class="form-control" max-lenght="14" name="cpf" id="cpf" placeholder="Seu CPF" required>
            </div>
            <div class="form-group">
                <label for="tel">Telefone*</label>
                <input type="text" oninput="mascara(this, 'tel');" class="form-control" max-lenght="14" name="tel" id="tel" placeholder="Ex: (00) 00000-0000" required>
            </div>
            <div class="form-group">
                <label for="funcao">ID Funcionário*</label>
                <input type="text" class="form-control" max-lenght="5" name="funcao" id="funcao" placeholder="Ex: 54234" required>
            </div><br>
        </fieldset>
        <button type="submit" class="btn btn-primary">Enviar</button>&nbsp&nbsp&nbsp<input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/adm.php';" />
    </form>
</div>
</body>
</html>