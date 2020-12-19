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
           $stmt = $this->conn->query("SELECT Telefone, Nome, ID_Cliente, CPF, ID_Serviço FROM public.Cliente WHERE ID_Cliente='$id'");
           $stocks = [];
           while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {

               $stocks[] = [
                   'Telefone' => $row['Telefone'],
                   'Nome' => $row['Nome'],
                   'ID_Cliente' => $row['ID_Cliente'],
                   'CPF' => $row['CPF'],
                   'ID_Serviço' => $row['ID_Serviço']
               ];
           }
           return $stocks;
       }

       public function insert($Telefone, $Nome, $CPF, $ID_Servico, $Carro)
       {

           {
               $sql = "INSERT INTO Cliente (Telefone, Nome, CPF, ID_Serviço, Carro) VALUES (:tel,:nome, :cpf, :servico, :carro)";
               $stmt = $this->conn->prepare($sql);

               $stmt->bindValue(':tel', $Telefone);
               $stmt->bindValue(':nome', $Nome);
               $stmt->bindValue(':cpf', $CPF);
               $stmt->bindValue(':servico', $ID_Servico);
               $stmt->bindValue(':carro', $Carro);
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
