<?php
include('templates/header.php');
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
<div class="container" style="padding-top: 30px;">
    <div class="jumbotron">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="display-4">Sistema empresa</h1>
                <p class="lead">Exemplo de CRUD conectando ao Postgres usando PHP</p>
            </div>
        </div>
    </div>
</div>

<?php
include('templates/footer.php');
?>