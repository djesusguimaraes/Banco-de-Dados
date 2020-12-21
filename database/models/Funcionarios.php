<?php

namespace conpostgres;

class FuncionarioModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM public.funcionario;");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $stocks = [];
        while($row == $stmt->fetch(\PDO::FETCH_ASSOC)){
            $stocks = [
                'nome' => $row['nome'],
                'cpf' => $row['cpf'],
                'telefone' => $row['telefone'],
                'id_funcionario' => $row['id_funcionario']
            ];
        }
        return $stocks;
    }

    public function showByID($ID_funcionario)
    {
        $stmt = $this->pdo->query("SELECT nome, CPF, Telefone FROM public.funcionario WHERE ID_funcionario = '$ID_fucionario'");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stocks = [
            'nome' => $row['nome'],
            'CPF' => $row['CPF'],
            'Telefone' => $row['Telefone']
        ];
        return $stocks;
    }

    public function insert($nome, $CPF, $Telefone, $ID_funcionario)
    {

        {
            $sql = "INSERT INTO public.funcionario (nome, CPF, Telefone, ID_funcionario) VALUES (:nome, :cpf, :tel, :funcao)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':cpf', $CPF);
            $stmt->bindValue(':tel', $Telefone);
            $stmt->bindValue(':funcao', $ID_funcionario);
            $stmt->execute();
        }
    }

    public function deleteByID($id)
    {

        $sql = "DELETE from public.funcionario WHERE id_funcionario='$id'";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
    }

}
?>