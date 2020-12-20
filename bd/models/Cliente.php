<?php

namespace connPHPPostgres;

class ClientModel
{
    private $conn;

    public function __construct($conn)
    {
       $this->conn = $conn;
    }

    public function showByID($id)
    {
        $stmt = $this->conn->query("SELECT Nome, CPF, Carro, Telefone, ID_Serviço FROM public.Cliente WHERE CPF='$id'");
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {

            $stocks[] = [
                'Nome' => $row['Nome'],
                'CPF' => $row['CPF'],
                'Carro' => $row['Carro'],
                'Telefone' => $row['Telefone'],
                'ID_serviço' => $row['ID_serviço']
            ];
        }
        return $stocks;
    }

    public function insert($Telefone, $Nome, $CPF, $Carro)
    {

        {
            $sql = "INSERT INTO Cliente (Nome, CPF, Carro, Telefone, ID_servico) VALUES (:nome, :cpf, :carro, :tel)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':nome', $Nome);
            $stmt->bindValue(':cpf', $CPF);
            $stmt->bindValue(':carro', $Carro);
            $stmt->bindValue(':tel', $Telefone);
            // $stmt->bindValue(':servico', $ID_servico);
            $stmt->execute();
        }
    }

    public function deleteByCPF($CPF)
    {

        $sql = "DELETE from public.Cliente WHERE CPF='$CPF'";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
    }
}
?>
