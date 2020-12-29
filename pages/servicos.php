<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\ServicoModel as ServicoModel;

$Servico = new ServicoModel($pdo);

$Servicos = $Servico->all();

$i = 0;

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
<div class="col-sm-12" style="margin-top: 30px;">
    <div class="form-inline">
        <a href="http://localhost/javalato/"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <h2><strong>Serviços</strong></h2>
    </div>
    <a href="create/createServico.php"><button type="button" class="btn btn-success btn-md float-right">Inserir</button></a><br>&nbsp
    <table class="table">
    <thead class="thead-dark">
        <tr>
        <th>#</th>
        <th scope="col">Nome do Serviço</th>
        <th scope="col">Descrição</th>
        <th scope="col">ID Serviço</th>
        <th scope="col">Preço</th>
        <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Servicos as $dado) : ?>
            <tr>
            <td><?php echo $i += 1;?></td>
            <td><?php echo htmlspecialchars($dado['nome']); ?></td>
            <td><?php echo htmlspecialchars($dado['descricao']); ?></td>
            <td><?php echo htmlspecialchars($dado['id_servico']); ?></td>
            <td><?php echo htmlspecialchars($dado['preco']); ?></td>
            <td>
            <div class="form-check-inline">
                <form action="servicos.php" method="post">
                    <input type="hidden" name="id_servico" value="<?php echo htmlspecialchars($dado['id_servico']); ?>">
                    <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                </form>
                <form action="update/upServico.php" method="post">
                    <input type="hidden" name="id_servico" id="id_servico" value="<?php echo htmlspecialchars($dado['id_servico']);?>">&nbsp
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