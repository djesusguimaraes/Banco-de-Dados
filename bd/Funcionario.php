<?php

namespace connPHPPostgres;

class FuncionarioModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function showByID($id)
    {
        $stmt = $this->conn->query("SELECT Nome, ID_Funcionario, CPF, ID_funcao FROM public.Funcionario WHERE ID_Funcionario='$id'");
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {

            $stocks[] = [
                'name' => $row['name'],
                'id_employee' => $row['id_employee'],
                'cpf' => $row['cpf'],
                'id_funcao' => $row['id_funcao'],
            ];
        }
        return $stocks;
    }

    public function insertInto($Nome, $ID_Funcionario, $CPF, $ID_Funcao)
    {

        {
            $sql = "INSERT INTO Funcionario (Nome,ID_Funcionario, CPF) VALUES (:Nome, :ID_Funcionario, :CPF, :ID_Funcao)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':Nome', $Nome);
            $stmt->bindValue(':ID_Funcionario', $ID_Funcionario);
            $stmt->bindValue(':CPF', $CPF);
            $stmt->bindValue(':ID_Funcao', $ID_Funcao);

            $stmt->execute();
        }
    }

    public function deleteByID($id)
    {

        $sql = "DELETE from public.Funcionario WHERE ID_Funcionario='$id'";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
    }

}
?>