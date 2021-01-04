<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\ServicoModel as ServicoModel;
use conpostgres\FuncionarioModel as FuncionarioModel;
use conpostgres\ClientModel as ClientModel;
use conpostgres\CarroModel as CarroModel;
use conpostgres\PedidoModel as PedidoModel;
use conpostgres\ItemModel as ItemModel;

$Funcionario = new FuncionarioModel($pdo);
$Servico = new ServicoModel($pdo);
$Client = new ClientModel($pdo);
$Car = new CarroModel($pdo);
$Pedido = new PedidoModel($pdo);
$Item = new ItemModel($pdo);

$Funcionarios = $Funcionario->all();
$Servicos = $Servico->all();
$Clientes = $Client->all();

$i = 0;
$j = 0;
$k = 0;

$id_funcionario = null;
$id_servico = null;
$id_pedido = null;
$id_item = null;
$cpf = null;
$texto = null;
$nome = null;

if (!empty($_POST['del_funcionario'])){
    $id_funcionario = $_POST['del_funcionario'];
    $nome = $Funcionario->showByID($id_funcionario)['nome'];
    $texto = "
    <div class=\"alert alert-warning\" style=\"box-shadow: inset 0 0 .4em gold, 0px 3px 5px #ccc;\" role=\"alert\">
        <form action=\"http://localhost/javalato/pages/adm.php\" method=\"post\">
            <div class=\"\">
                Você quer realmente apagar o funcionário $nome, número $id_funcionario?
                <input type=\"hidden\" name=\"id_funcionario\" id=\"id_funcionario\"value=\"$id_funcionario\">
            </div><br>
            <input type=\"button\" class=\"btn btn-success btn-sm\" name=\"cancel\" value=\"Cancelar\" onClick=\"window.location='http://localhost/javalato/pages/adm.php';\" />
            <button type=\"submit\" name=\"apagou\" class=\"btn btn-outline-danger btn-sm\">Confirmar</button>
        </form>&nbsp
    </div>";
}

if (!empty($_POST['id_funcionario'])) {
    if (empty($_POST['cancel'])){
        $id_funcionario = $_POST['id_funcionario'];
    }
    try {
        $Funcionario->deleteByID($id_funcionario);
        header('Location: http://localhost/javalato/pages/adm.php');
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}

if (!empty($_POST['del_servico'])){
    $id_servico = $_POST['del_servico'];
    $nome = $Servico->showByID($id_servico)['nome'];
    $texto = "
    <div class=\"alert alert-warning\" style=\"box-shadow: inset 0 0 .4em gold, 0px 3px 5px #ccc;\" role=\"alert\">
        <form action=\"http://localhost/javalato/pages/adm.php\" method=\"post\">
            <div class=\"\">
                Você quer realmente apagar o serviço de $nome?
                <input type=\"hidden\" name=\"id_servico\" id=\"id_servico\"value=\"$id_servico\">
            </div><br>
            <input type=\"button\" class=\"btn btn-success btn-sm\" name=\"cancel\" value=\"Cancelar\" onClick=\"window.location='http://localhost/javalato/pages/adm.php';\" />
            <button type=\"submit\" name=\"apagou\" class=\"btn btn-outline-danger btn-sm\">Confirmar</button>
        </form>&nbsp
    </div>";
}

if (!empty($_POST['id_servico'])) {
    if (empty($_POST['cancel'])){
        $id_servico = $_POST['id_servico'];
    }
    try {
        $Servico->deleteByID($id_servico);
        header('Location: http://localhost/javalato/pages/adm.php');
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}

if(!empty($_POST['kill'])) {
    $cpf = $_POST['kill'];
    $nome = $Client->showByCPF($cpf)['nome'];
    $texto = "
    <div class=\"alert alert-danger\" style=\"box-shadow: inset 0 0 .4em red, 0px 3px 5px #ccc;\" role=\"alert\">
        <form action=\"http://localhost/javalato/pages/adm.php\" method=\"post\">
            <div class=\"\">
                Quer realmente apagar PERMANENTEMENTE o cliente $nome?
                <input type=\"hidden\" name=\"delete\" id=\"delete\"value=\"$cpf\">
            </div><br>
            <input type=\"button\" class=\"btn btn-success btn-sm\" name=\"cancel\" value=\"Cancelar\" onClick=\"window.location='http://localhost/javalato/pages/adm.php';\" />
            <button type=\"submit\" name=\"apagou\" class=\"btn btn-outline-danger btn-sm\">Confirmar</button>
        </form>&nbsp
    </div>";
}

if (!empty($_POST['delete'])) {
    if (empty($_POST['cancel'])){
        $cpf = $_POST['delete'];
    }
    $id_pedido = $Pedido->showByCPF($cpf);
    foreach($id_pedido as $dado){
        $Item->deleteByID($dado);
        $Pedido->deleteByID($dado);
    };
    try {
        $Car->deleteByCPF($cpf);
        $Client->deleteByCPF($cpf);
        header('Location: http://localhost/javalato/pages/adm.php');
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}

if(!empty($_POST['restore'])) {
    $cpf = $_POST['restore'];
    $nome = $Client->showByCPF($cpf)['nome'];
    $texto = "
    <div class=\"alert alert-warning\" style=\"box-shadow: inset 0 0 .4em gold, 0px 3px 5px #ccc; border-radius: 0px;\" role=\"alert\">
        <form action=\"http://localhost/javalato/pages/adm.php\" method=\"post\">
            <div class=\"\">
                Deseja reativar o cadastro do cliente $nome?
                <input type=\"hidden\" name=\"restored\" id=\"restored\"value=\"$cpf\">
            </div><br>
            <input type=\"button\" class=\"btn btn-outline-danger btn-sm\" name=\"cancel\" value=\"Cancelar\" onClick=\"window.location='http://localhost/javalato/pages/adm.php';\" />
            <button type=\"submit\" name=\"apagou\" class=\"btn btn-success btn-sm\">Confirmar</button>
        </form>&nbsp
    </div>";
}

if (!empty($_POST['restored'])) {
    if (empty($_POST['cancel'])){
        $cpf = $_POST['restored'];
    }
    try {
        $Client->unnhide($cpf);
        header('Location: http://localhost/javalato/pages/adm.php');
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}
?>
<?php
require '../templates/header.php';
?>

<div class="container-fluid" style="margin-top: 30px;">
<!-- Título -->
    <div class="form-inline">   
        <a href="http://localhost/javalato/" style="margin-left: 65px;"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>
        <h2 style="margin-left: 30px;"><strong>Área de Administração</strong></h2>
    </div>
    <div class="col-sm-5 float-sm-right" style="margin-right: 50px;">
        <!-- Confirmação de deleção funcionário, cliente e serviço -->
        <?php if ($texto!=null):?>
            <div style="margin-top: 100px;">
                <?php echo $texto; ?>
            </div>
        <?php endif; ?>
        <!-- Tabela de Funcionários -->
        <div style="margin-top: 50px;">
            <h3 class="col-sm-4" style="margin-bottom: -30px;"><strong>Funcionários</strong></h3>
            <a href="create/createFuncionario.php"><button type="button" class="btn btn-success btn-md float-right">Cadastrar Funcionário</button></a><br>&nbsp
            <table class="table" style="border-bottom: 1px solid #005484; border-right: 1px solid #005484; border-left: 1px solid #005484; box-shadow: 0px 3px 5px #ccc;">
            <thead class="thead-dark">
                <tr>
                <th style="background-color: #005484;" scope="col">#</th>
                <th style="background-color: #005484;" scope="col">ID</th>
                <th style="background-color: #005484;" scope="col">Nome</th>
                <th style="background-color: #005484;" scope="col">CPF</th>
                <th style="background-color: #005484;" scope="col">Telefone</th>
                <th style="background-color: #005484;" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Funcionarios as $dado) : ?>
                    <tr style="font-size: 11pt;">
                    <td class="table-info" style="border-right: 1px solid #005484;"><strong><?php echo $j += 1;?></strong></td>
                    <td><?php echo htmlspecialchars($dado['id_funcionario']); ?></td>
                    <td><?php echo htmlspecialchars($dado['nome']); ?></td>
                    <td><?php echo htmlspecialchars($dado['cpf']); ?></td>
                    <td><?php echo htmlspecialchars($dado['telefone']); ?></td>
                    <td >
                        <div class="form-check-inline">
                            <form action="adm.php" method="post">
                                <input type="hidden" name="del_funcionario" value="<?php echo htmlspecialchars($dado['id_funcionario']); ?>">
                                <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                            </form>&nbsp
                            <form action="update/upFuncionario.php" method="post">
                                <input type="hidden" name="id_funcionario" id="id_funcionario" value="<?php echo htmlspecialchars($dado['id_funcionario']); ?>">
                                <button type="submit" class="btn btn-outline-info btn-sm">Update</button>
                            </form>
                        </div>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
        
        <!-- Tabela de Clientes -->
        <div class="form-inline" style="margin-top: 50px">
        <h3 class="col-sm-8" style="margin-bottom: 20px;"><strong>Histórico de Clientes</strong></h3>
        </div>
        <table class="table" style="border-bottom: 1px solid #848688; border-right: 1px solid #848688; box-shadow: 0px 3px 5px #ddd; margin-bottom: 150px">
            <thead class="thead-dark">
                <tr>
                <th style="background-color: #848688;" scope="col">#</th>
                <th style="background-color: #848688;" scope="col">Exclusão</th>
                <th style="background-color: #848688;" scope="col">CPF</th>
                <th style="background-color: #848688;" scope="col">Nome</th>
                <th style="background-color: #848688;" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Clientes as $dado) : ?>
                    <?php if ($dado['delete_at'] != null):?>
                        <tr style="font-size: 11pt;">
                            <td style="background-color: #ccc;"><?php echo $k += 1;?></td>
                            <td><?php echo htmlspecialchars($dado['delete_at']); ?></td>
                            <td><?php echo htmlspecialchars($dado['cpf']); ?></td>
                            <td><?php echo htmlspecialchars($dado['nome']); ?></td>
                            <td>
                                <div class="form-check-inline">
                                    <form action="adm.php" method="post">
                                        <input type="hidden" name="restore" id="restore" value="<?php echo htmlspecialchars($dado['cpf']);?>">
                                        <button type="submit" class="btn btn-outline-success btn-sm"?>Restore</button>
                                    </form>&nbsp
                                    <form action="adm.php" method="post">
                                        <input type="hidden" name="kill" value="<?php echo htmlspecialchars($dado['cpf']); ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endif;?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Tabela de Serviços -->
    <div class="col-sm-6" style="margin: 50px auto 150px 50px;">
        <div class="form-inline">
        <h3 class="col-sm-4" style="margin-bottom: -30px;"><strong>Serviços</strong></h3>
        </div>
        <a href="create/createServico.php"><button type="button" class="btn btn-success btn-md float-right">Cadastrar Serviço</button></a><br>&nbsp
        <table class="table" style="border-bottom: 1px solid #005484; border-right: 1px solid #005484; border-left: 1px solid #005484; box-shadow: 0px 3px 5px #ccc;">
        <thead class="thead-dark">
            <tr>
            <th style="background-color: #005484;" scope="col">#</th>
            <th style="background-color: #005484;" scope="col">Nome do Serviço</th>
            <th style="background-color: #005484;" scope="col">Descrição</th>
            <th style="background-color: #005484;" scope="col">ID</th>
            <th style="background-color: #005484;" scope="col">Preço</th>
            <th style="background-color: #005484;" scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Servicos as $dado) : ?>
                <tr style="font-size: 11pt;">
                <td class="table-info" style="border-right: 1px solid #005484;"><strong><?php echo $i += 1;?></strong></td>
                <td><?php echo htmlspecialchars($dado['nome']); ?></td>
                <td><?php echo htmlspecialchars($dado['descricao']); ?></td>
                <td><?php echo htmlspecialchars($dado['id_servico']); ?></td>
                <td><?php echo 'R$'.htmlspecialchars($dado['preco']).'.00';?></td>
                <td>
                <div class="form-check-inline float-right">
                    <form action="adm.php" method="post">
                        <input type="hidden" name="del_servico" value="<?php echo htmlspecialchars($dado['id_servico']); ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                    </form>&nbsp
                    <form action="update/upServico.php" method="post">
                        <input type="hidden" name="id_servico" id="id_servico" value="<?php echo htmlspecialchars($dado['id_servico']);?>">
                        <button type="submit" class="btn btn-outline-info btn-sm"?>Update</button>
                    </form>
                </div>
                </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>

</body>
</html>
<?php
include('../templates/footer.php');