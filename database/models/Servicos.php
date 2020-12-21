<?php

namespace conpostgres;

class ServicoModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function showByID($id)
    {
        $stmt = $this->pdo->query("SELECT \"Nome_servico\", \"Descricao\", \"ID_servico\" FROM public.\"Servico\" WHERE \"ID_servico\"='$id'");
        $stocks = [];
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            $stocks[] = [
                'Nome_servico' => $row['Nome_servico'],
                'Descricao' => $row['Descricao'],
                'ID_servico' => $row['ID_servico'],
            ];
        return $stocks;
    }

    public function insert($Nome_servico, $Descricao, $ID_servico)
    {

        {
            $sql = "INSERT INTO \"Servico\" (\"Nome_servico\", \"Descricao\", \"ID_servico\") VALUES (:nome, :descricao, :servico)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':nome', $Nome_servico);
            $stmt->bindValue(':descricao', $Descricao);
            $stmt->bindValue(':servico', $ID_servico);

            $stmt->execute();
        }
    }

    public function deleteByID($id)
    {

        $sql = "DELETE from public.Servico WHERE ID_servico='$id'";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
    }

}
?>


