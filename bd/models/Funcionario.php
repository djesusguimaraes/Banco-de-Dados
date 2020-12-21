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
        $stmt = $this->pdo->query("SELECT \"Nome_funcionario\", \"CPF\", \"Telefone\" FROM public.\"Funcionario\" WHERE \"CPF\" = '$CPF'");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stocks = [
            'nome' => $row['Nome_funcionario'],
            'cpf' => $row['CPF'],
            'tel' => $row['Telefone']
        ];
        return $stocks;
    }

    public function insert($Nome_funcionario, $CPF, $Telefone)
    {

        {
            $sql = "INSERT INTO public.\"Funcionario\" (\"Nome_funcionario\", \"CPF\", \"Telefone\") VALUES (:nome, :cpf, :tel)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':nome', $Nome_funcionario);
            $stmt->bindValue(':cpf', $CPF);
            $stmt->bindValue(':tel', $Telefone);

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