<?php

namespace connPHPPostgres;

class FuncionarioModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function show()
    {
        $stmt = $this->pdo->query("SELECT * FROM public.\"Funcionario\";");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $stocks = [];
        while($row == $stmt->fetch(\PDO::FETCH_ASSOC)){
            $stocks = [
                'nome' => $row['Nome_funcionario'],
                'cpf' => $row['CPF'],
                'tel' => $row['Telefone'],
                'funcao' => $row['ID_funcionario']
            ];
        }
        return $stocks;
    }

    public function showByID($ID_fucionario)
    {
        $stmt = $this->pdo->query("SELECT \"Nome_funcionario\", \"CPF\", \"Telefone\" FROM public.\"Funcionario\" WHERE \"ID_funcionario\" = '$ID_fucionario'");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stocks = [
            'nome' => $row['Nome_funcionario'],
            'cpf' => $row['CPF'],
            'tel' => $row['Telefone']
        ];
        return $stocks;
    }

    public function insert($Nome_funcionario, $CPF, $Telefone, $ID_fucionario)
    {

        {
            $sql = "INSERT INTO public.\"Funcionario\" (\"Nome_funcionario\", \"CPF\", \"Telefone\", \"ID_funcionario\") VALUES (:nome, :cpf, :tel, :funcao)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':nome', $Nome_funcionario);
            $stmt->bindValue(':cpf', $CPF);
            $stmt->bindValue(':tel', $Telefone);
            $stmt->bindValue(':funcao', $ID_fucionario);
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