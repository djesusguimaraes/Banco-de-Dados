<?php

require '../../database/models/Servicos.php';

include_once '../../database/ini.php';

use conpostgres\ServicoModel as ServicoModel;
$servicoRegister = new ServicoModel($pdo);


$nome_servico = null;
$descricao = null;
$id_servico = null;
$preco = null;

if(!empty($_POST['servico'])){
    $id_servico = $_REQUEST['servico'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome_servico =  $_REQUEST['nome'];
    $descricao =  $_REQUEST['descricao'];
    $id_servico = $_REQUEST['servico'];
    $preco = $_REQUEST['preco'];
    
    try {
        $servicoRegister->insert($nome_servico, $descricao, $id_servico, $preco);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}

?>
<?php
require '../../templates/header.php';
?>

    <div class="container-sm">
        <h2><strong>Cadastro de Serviço</strong></h2>
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
                    <label for="servico">ID Serviço</label>
                    <input type="text" class="form-control" max-lenght="5" name="servico" id="servico" placeholder="Ex: 666">
                </div>
                <div class="form-group">
                    <label for="preco">Preço</label>
                    <input type="number" class="form-control" name="preco" id="preco" placeholder="Ex: ">
                </div>
            </fieldset>
            <button type="submit" class="btn btn-primary">Enviar</button>&nbsp&nbsp&nbsp<input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/servicos.php';" />
        </form>
    </div>
</body>

</html>
