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
        $stocks = [];
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $stocks[] = [
                'nome' => $row['nome'],
                'cpf' => $row['cpf'],
                'telefone' => $row['telefone'],
                'id_funcionario' => $row['id_funcionario']
            ];
        }
        return $stocks;
    }

    public function showByID($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM public.funcionario WHERE id_funcionario='$id';");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stocks = [
            'nome' => $row['nome'],
            'cpf' => $row['cpf'],
            'telefone' => $row['telefone'],
            'id_funcionario' => $row['id_funcionario'],
        ];
        return $stocks;
    }

    public function update($nome, $cpf, $telefone, $id)
    {
        $sql = "UPDATE public.funcionario SET nome='$nome', cpf='$cpf', telefone='$telefone' WHERE id_funcionario='$id';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function insert($nome, $cpf, $telefone, $funcao)
    {

        {
            $sql = "INSERT INTO public.funcionario(nome, cpf, telefone, id_funcionario) VALUES (:nome, :cpf, :tel, :funcao);";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':cpf', $cpf);
            $stmt->bindValue(':tel', $telefone);
            $stmt->bindValue(':funcao', $funcao);
            $stmt->execute();
        }
    }

    public function deleteByID($id)
    {

        $sql = "DELETE FROM public.funcionario WHERE id_funcionario='$id';";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
    }

}
?>