<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\ServicoModel as ServicoModel;
use conpostgres\FuncionarioModel as FuncionarioModel;

$Funcionario = new FuncionarioModel($pdo);
$Servico = new ServicoModel($pdo);

$Funcionarios = $Funcionario->all();
$Servicos = $Servico->all();

$i = 0;
$j = 0;

$id_funcionario = null;
$id_servico = null;

if (!empty($_POST['id_funcionario'])) {
    $id_funcionario = $_POST['id_funcionario'];
    try {
        $Funcionario->deleteByID($id_funcionario);
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}

if (!empty($_POST['id_servico'])) {
    $id_servico = $_POST['id_servico'];
    try {
        $Servico->deleteByID($id_servico);
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}
?>
<?php
require '../templates/header.php';
?>
<div class="container" style="margin-top: 30px;">
    <div class="form-inline">
        <a href="http://localhost/javalato/"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <h2><strong>Área de Administração</strong></h2>
    </div>
    <div class="" style="margin-top: 50px;">
            <h3><strong>Funcionários</strong></h3>
        
        <a href="create/createFuncionario.php"><button type="button" class="btn btn-success btn-md float-right">Cadastrar Funcionário</button></a><br>&nbsp
        <table class="table">
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
                <tr>
                <td class="table-info"><?php echo $j += 1;?></td>
                <td><?php echo htmlspecialchars($dado['id_funcionario']); ?></td>
                <td><?php echo htmlspecialchars($dado['nome']); ?></td>
                <td><?php echo htmlspecialchars($dado['cpf']); ?></td>
                <td><?php echo htmlspecialchars($dado['telefone']); ?></td>
                <td >
                    <div class="form-check-inline">
                        <form action="adm.php" method="post">
                            <input type="hidden" name="id_funcionario" value="<?php echo htmlspecialchars($dado['id_funcionario']); ?> ">
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
</div>

    <div class="container" style="margin-top: 50px;">
        <div class="form-inline">
            <h3><strong>Serviços</strong></h3>
        </div>
        <a href="create/createServico.php"><button type="button" class="btn btn-success btn-md float-right">Cadastrar Serviço</button></a><br>&nbsp
        <table class="table">
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
                <tr>
                <td class="table-info"><?php echo $i += 1;?></td>
                <td><?php echo htmlspecialchars($dado['nome']); ?></td>
                <td><?php echo htmlspecialchars($dado['descricao']); ?></td>
                <td><?php echo htmlspecialchars($dado['id_servico']); ?></td>
                <td><?php echo 'R$'.htmlspecialchars($dado['preco']).'.00';?></td>
                <td>
                <div class="form-check-inline float-right">
                    <form action="adm.php" method="post">
                        <input type="hidden" name="id_servico" value="<?php echo htmlspecialchars($dado['id_servico']); ?>">
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
</body>
</html>