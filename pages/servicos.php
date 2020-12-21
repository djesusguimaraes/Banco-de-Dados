<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\ServicoModel as ServicoModel;

$Servico = new ServicoModel($pdo);

$Servicos = $Servico->all();

?>
<?php
require '../templates/header.php';
?>
<div>
    <table class="table">
    <thead class="thead-light">
        <tr>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">Carro</th>
        <th scope="col">Telefone</th>
        <th scope="col">Placa</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Servicos as $dado) : ?>
            <tr>
            <td><?php echo htmlspecialchars($dado['nome']); ?></td>
            <td><?php echo htmlspecialchars($dado['cpf']); ?></td>
            <td><?php echo htmlspecialchars($dado['carro']); ?></td>
            <td><?php echo htmlspecialchars($dado['telefone']); ?></td>
            <td><?php echo htmlspecialchars($dado['placa']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
    
</div>
</body>
</html>