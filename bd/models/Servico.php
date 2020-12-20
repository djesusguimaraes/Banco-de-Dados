<?php

namespace connPHPPostgres;

class ServicoModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function showByID($id)
    {
        $stmt = $this->conn->query("SELECT Nome, Descricao, ID_Servico FROM public.Servico WHERE ID_Servico='$id'");
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {

            $stocks[] = [
                'Nome' => $row['Nome'],
                'Descricao' => $row['Descricao'],
                'ID_Servico' => $row['ID_Servico'],
            ];
        }
        return $stocks;
    }

    public function insertInto($Nome, $Descricao, $ID_Servico)
    {

        {
            $sql = "INSERT INTO Servico (Nome, Descricao, ID_Servico) VALUES (:Nome, :Descricao, :ID_Servico)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':Nome', $Nome);
            $stmt->bindValue(':Descricao', $Descricao);
            $stmt->bindValue(':ID_Servico', $ID_Servico);

            $stmt->execute();
        }
    }

    public function deleteByID($id)
    {

        $sql = "DELETE from public.Servico WHERE ID_Servico='$id'";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
    }

}
?>


