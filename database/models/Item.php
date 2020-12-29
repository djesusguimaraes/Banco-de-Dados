<?php

namespace conpostgres;

class ItemModel
{
    private $pdo;

    public function __construct($pdo)
    {
       $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM public.item;');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            $stocks[] = [
                'id_item' => $row['id_item'],
                'id_pedido' => $row['id_pedido'],
                'id_servico' => $row['id_servico'],
                'quantidade' => $row['quantidade']
            ];
        }
        return $stocks;
    }

    public function showByID($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM public.item WHERE id_item='$id';");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stocks = [
            'id_item' => $row['id_item'],
            'id_pedido' => $row['id_pedido'],
            'id_servico' => $row['id_servico'],
            'quantidade' => $row['quantidade']
        ];
        return $stocks;
    }

    public function update($id, $quantidade)    
    {
        $sql = "UPDATE public.item SET quantidade='$quantidade' WHERE  id_item='$id';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function insert($id_servico, $id_funcionario, $quantidade)
    {

        {
            $sql = "INSERT INTO public.item(id_servico, id_funcionario, quantidade) VALUES (:id_servico, :quantidade);";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':id_servico', $id_servico);
            $stmt->bindValue(':quantidade', $quantidade);
            $stmt->execute();

        }
    }

    public function deleteByID($id)
    {
        $sql = "DELETE FROM public.item WHERE cpf='$id';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
}
?>
