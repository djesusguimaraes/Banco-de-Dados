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
<div class="container">
<h2><strong>Serviços</strong></h2><br>
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
                    <input type="hidden" name="id_servico" id="id_servico" value="<?php echo htmlspecialchars($dado['id_servico']); ?>">
                    <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                </form>
                <form action="" method="get">
                    <input type="hidden" name="id_servico" id="id_servico" value="<?php echo htmlspecialchars($dado['id_servico']);?>">&nbsp&nbsp
                    <button type="submit" class="btn btn-outline-info btn-sm"?>Update</button>
                </form>
            </div>
            </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
    
</div>
<div class="container">
    <a href="create/createServico.php"><button type="button" class="btn btn-outline-success btn-lg">Insert</button></a>
</div>

</body>
</html>