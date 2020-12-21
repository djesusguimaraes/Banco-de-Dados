<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\ClientModel as ClientModel;
$Client = new ClientModel($pdo);

$Clientes = $Client->all();

$cpf = null;


if (!empty($_POST['cpf'])) {
    $cpf = $_POST['cpf'];
    try {
        $Client->deleteByCPF($cpf);
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}

?>
<?php
require '../templates/header.php';
?>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="index.php">JAVALATO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                    <a class="nav-link" href="pages/clientes.php">Cliente</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="pages/funcionarios.php">Funcionário</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="pages/servicos.php">Serviço</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sobre
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Ação</a>
                        <a class="dropdown-item" href="#">Outra ação</a>
                        <a class="dropdown-item" href="#">Algo mais aqui</a>
                    </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <br>
<div class="container-lg">
    <table class="table">
    <thead class="thead-light">
        <tr>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">Carro</th>
        <th scope="col">Telefone</th>
        <th scope="col">Placa</th>
        <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Clientes as $dado) : ?>
            <tr>
            <td><?php echo htmlspecialchars($dado['nome']); ?></td>
            <td><?php echo htmlspecialchars($dado['cpf']); ?></td>
            <td><?php echo htmlspecialchars($dado['carro']); ?></td>
            <td><?php echo htmlspecialchars($dado['telefone']); ?></td>
            <td><?php echo htmlspecialchars($dado['placa']); ?></td>
            <td>
            <div class="d-inline-block">
                <form action="clientes.php" method="post">
                    <input type="hidden" name="cpf"value="<?php echo htmlspecialchars($dado['cpf']); ?>">
                    <button type="submit" class="btn btn-outline-danger"?>Delete</button>
                </form>
                <form action="clientes.php" method="post">
                    <input type="hidden" name="cpf" value="">
                </form>
            </div>
            </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>
<div class="container">
<a href="create/createCliente.php"><button type="button" class="btn btn-outline-success btn-lg">Insert</button></a>

</div>
</body>
</html>