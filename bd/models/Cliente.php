<?php

namespace connPHPPostgres;

class ClientModel
{
    private $pdo;

    public function __construct($pdo)
    {
       $this->pdo = $pdo;
    }

    public function showByCPF($CPF)
    {
        $stmt = $this->pdo->pg_query("SELECT \"Nome\", \"CPF\", \"Carro\", \"Telefone\", \"Placa\"  FROM public.\"Cliente\" WHERE \"CPF\"='$CPF'");
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Nome' => $row['Nome'],
                'CPF' => $row['CPF'],
                'Carro' => $row['Carro'],
                'Telefone' => $row['Telefone'],
                'Placa' => $row['Placa']
            ];
        }
        return $stocks;
    }

    public function insert($Nome, $CPF, $Carro, $Telefone, $Placa)
    {

        {
            $sql = "INSERT INTO \"Cliente\" (\"Nome\", \"CPF\", \"Carro\", \"Telefone\", \"Placa\") VALUES (:nome, :cpf, :carro, :tel, :placa)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':nome', $Nome);
            $stmt->bindValue(':cpf', $CPF);
            $stmt->bindValue(':carro', $Carro);
            $stmt->bindValue(':tel', $Telefone);
            $stmt->bindValue(':placa', $Placa);
            $stmt->execute();

        }
    }

    public function deleteByCPF($CPF)
    {

        $sql = "DELETE from public.\"Cliente\" WHERE \"CPF\"='$CPF'";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
    }
}
?>
