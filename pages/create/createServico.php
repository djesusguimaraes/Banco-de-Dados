<?php

require '../../database/models/Servicos.php';

include_once '../../database/ini.php';

use conpostgres\ServicoModel as ServicoModel;
$servicoRegister = new ServicoModel($pdo);


$nome_servico = null;
$descricao = null;
$id_servico = null;
$preco = null;
$url = null;
$texto = null;

if(!empty($_POST['servico'])){
    $id_servico = $_REQUEST['servico'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome_servico =  $_REQUEST['nome'];
    $descricao =  $_REQUEST['descricao'];
    $preco = $_REQUEST['preco'];
    
    try {
        $servicoRegister->insert($nome_servico, $descricao, $preco);
        $url = 1;
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
        $url = $error;
    }
}

if ($url == 1){
    $texto = ("<div class=\"alert alert-success\" role=\"alert\">Serviço cadastrado com sucesso!<a href=\"http://localhost/javalato/pages/adm.php\" ><button class=\"btn btn-outline-success btn-sm float-right\" style=\"padding: 5px; margin-top: -4px;\">Voltar à seleção</button></a></div>");
}else if($url != null){
    $texto = ("<div class=\"alert alert-danger\" role=\"alert\">$url<a href=\"http://localhost/javalato/pages/adm.php\" ><button class=\"btn btn-outline-danger btn-sm float-right\" style=\"padding: 5px; margin-top: 0px;\">Voltar à seleção</button></a></div>");
}
?>
<?php
require '../../templates/header.php';
?>

    <div class="container-sm" style="margin-top: 30px;">
        <div class="form-inline">
            <a href="http://localhost/javalato/pages/adm.php"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <h2><strong>Cadastro de Serviço</strong></h2>
        </div><br>
        <?php echo $texto;?>
        <form action="createServico.php" method="post">
            <fieldset>
                <div class="form-group">
                    <label for="nome">Nome do Serviço</label>
                    <input type="text" class="form-control" max-lenght="80" name="nome" id="nome" placeholder="Serviço a ser realizado">
                    <small id="help" class="form-text text-muted">Campo Obrigatório</small>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" max-lenght="200" name="descricao" id="descricao" placeholder="Descrição do serviço">
                    <small id="help" class="form-text text-muted">Campo Obrigatório</small>
                </div>
                <div class="form-group">
                    <label for="preco">Preço</label>
                    <input type="number" class="form-control" name="preco" id="preco" placeholder="Ex: ">
                </div><br>
            </fieldset>
            <button type="submit" class="btn btn-primary">Enviar</button>&nbsp&nbsp&nbsp<input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/adm.php';" />
        </form>
    </div>
</body>

</html>
