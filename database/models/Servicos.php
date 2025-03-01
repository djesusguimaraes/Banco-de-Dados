<?php

namespace conpostgres;

class ServicoModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM public.servico;");
        $stocks = [];
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $stocks[] = [
                'nome' => $row['nome'],
                'descricao' => $row['descricao'],
                'id_servico' => $row['id_servico'],
                'preco' => $row['preco']

            ];
        }
        return $stocks;
    }

    public function showByID($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM public.servico WHERE id_servico='$id';");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stocks = [
            'nome' => $row['nome'],
            'descricao' => $row['descricao'],
            'id_servico' => $row['id_servico'],
            'preco' => $row['preco']
        ];

        return $stocks;
    }

    public function update($nome, $descricao, $preco, $id)
    {
        $sql = "UPDATE public.servico SET nome='$nome', descricao='$descricao', preco='$preco' WHERE  id_servico='$id';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function insert($nome_servico, $descricao, $preco)
    {
        {
            $sql = "INSERT INTO public.servico (nome, descricao, preco) VALUES (:nome, :descricao, :preco);";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':nome', $nome_servico);
            $stmt->bindValue(':descricao', $descricao);
            $stmt->bindValue(':preco', $preco);

            $stmt->execute();
        }
    }

    public function deleteByID($id)
    {

        $sql = "DELETE FROM public.servico WHERE id_servico='$id';";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
    }

}
?>


