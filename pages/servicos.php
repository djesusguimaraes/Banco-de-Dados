<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\ServicoModel as ServicoModel;

$Servico = new ServicoModel($pdo);

$Servicos = $Servico->all();

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
<h2><strong>Serviços</strong></h2>
    <table class="table">
    <thead class="thead-light">
        <tr>
        <th scope="col">Nome do Serviço</th>
        <th scope="col">Descrição</th>
        <th scope="col">ID Serviço</th>
        <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Servicos as $dado) : ?>
            <tr>
            <td><?php echo htmlspecialchars($dado['nome']); ?></td>
            <td><?php echo htmlspecialchars($dado['descricao']); ?></td>
            <td><?php echo htmlspecialchars($dado['id_servico']); ?></td>
            <td>
            <div class="d-inline-block">
                <form action="servicos.php" method="post">
                    <input type="hidden" name="id_servico" value="<?php echo htmlspecialchars($dado['id_servico']); ?>">
                    <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                </form>
                <form action="servicos.php" method="post">
                    <input type="hidden" name="id_servico" value="">
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