<?php
include '../db/models/Funcionario.php';
include_once '../db/db.ini.php';

use ConexaoPHPPostgres\FuncionarioModel as FuncionarioModel;

$funcionarioModel = new FuncionarioModel($pdo);
$funcionarios = $funcionarioModel->show();

?>
<?php
include('../../templates/header.php');
?>

<div class="container">

    <div class="row py-5">
        <div class="col"><a href="../../pages/funcionarios.php"><img src="../../assets/images/backbutton.png" height="40px"></a></div>
        <div class="col">
            <h4>Cadastrar novo funcionário</h4>
        </div>
        <div class="col"></div>
    </div>

    <form action="funcionario.php" method="post">
        <!-- Alerta em caso de erro -->
        <?php if (!empty($error)) : ?>
            <span class="text-danger"><?php echo $error; ?></span>
        <?php endif; ?>

        <div class="form-group">
            <label for="Nome">Primeiro Nome:</label>
            <input class="form-control" value="<?php echo !empty($fname) ? $fname : ''; ?>" type="text" name="fname" id="primeironome" required>
        </div>

        <div class="form-group">
            <label for="Sobrenome">Sobrenome:</label>
            <input class="form-control" type="text" value="<?php echo !empty($lname) ? $lname : ''; ?>" name="lname" id="sobrenome" required>
        </div>

        <div class="form-group">
            <label for="Ssn">Snn:</label>
            <input class="form-control" type="text" value="<?php echo !empty($ssn) ? $ssn : ''; ?>" name="ssn" id="ssn" required>
        </div>

        <div class="form-group">
            <label for="dno">Departamento:</label>
            <select class="form-control" id="dno" name="dno" value="<?php echo !empty($dno) ? $dno : ''; ?>" required>
                <?php foreach ($departments as $department) : ?>
                    <tr>
                        <option value="<?php echo htmlspecialchars($department['dnumber']); ?>" <?php echo $department['dnumber'] == $dno ? "selected" : '' ?>><?php echo htmlspecialchars($department['dname']); ?></option>
                    </tr>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="Salary">Salario:</label>
            <input class="form-control" type="number" value="<?php echo !empty($salary) ? $salary : ''; ?>" name="salary" id="salary" required>
        </div>

        <div class="form-group">
            <label for="Address">Endereço:</label>
            <input class="form-control" type="text" value="<?php echo !empty($address) ? $address : ''; ?>" name="address" id="address" required>
        </div>

        <div class="form-group">
            <label for="Data">Data Nascimento:</label>
            <input class="form-control" type="date" value="<?php echo !empty($bdate) ? $bdate : ''; ?>" name="bdate" id="datanascimento" required>
        </div>

        <input class="btn btn-primary" type="submit" value="Cadastrar">

    </form>
</div>

<?php
include('../../templates/footer.php');
?>