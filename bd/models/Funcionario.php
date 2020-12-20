<?php

namespace connPHPPostgres;

class FuncionarioModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function showByID($CPF)
    {
        $stmt = $this->pdo->query("SELECT \"Nome_funcionario\", \"CPF\" FROM public.\"Funcionario\" WHERE \"CPF\" = '$CPF'");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stocks = [
            'nome' => $row['Nome_funcionario'],
            'cpf' => $row['CPF'],
        ];
        return $stocks;
    }

    public function insert($Nome_funcionario, $CPF)
    {

        {
            $sql = "INSERT INTO public.\"Funcionario\" (\"Nome_funcionario\", \"CPF\") VALUES (:Nome, :CPF)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':Nome', $Nome_funcionario);
            $stmt->bindValue(':CPF', $CPF);

            $stmt->execute();
        }
    }

    public function deleteByID($id)
    {

        $sql = "DELETE from public.Funcionario WHERE ID_Funcionario='$id'";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
    }

}
?>