<?php

namespace conpostgres;

class PedidoModel
{
    private $pdo;

    public function __construct($pdo)
    {
       $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM public.pedido;');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            $stocks[] = [
                'numero' => $row['numero'],
                'id_pedido' => $row['id_pedido'],
                'cpf_cliente' => $row['cpf_cliente'],
                'id_funcionario' => $row['id_funcionario'],
                'order_date' => $row['order_date'],
                'preco_total' => $row['preco_total']

            ];
        }
        return $stocks;
    }

    public function showByID($id_pedido)
    {
        $stmt = $this->pdo->query("SELECT * FROM public.pedido WHERE id_pedido='$id_pedido';");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stocks = [
            'numero' => $row['numero'],
            'id_pedido' => $row['id_pedido'],
            'cpf_cliente' => $row['cpf_cliente'],
            'id_funcionario' => $row['id_funcionario'],
            'order_date' => $row['order_date'],
            'preco_total' => $row['preco_total']
        ];
        return $stocks;
    }

    public function last(){
        $stmt = $this->pdo->query("SELECT MAX(id_pedido) FROM public.pedido;");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $stocks = $row['max'];
        return $stocks;
   
    }

    public function update($numero, $cpf, $id_funcionario, $order_date, $id_pedido)    
    {
        $sql = "UPDATE public.pedido SET numero='$numero', cpf_cliente='$cpf', id_funcionario='$id_funcionario', order_date='$order_date' WHERE  id_pedido='$id_pedido';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function insert($numero, $cpf, $id_funcionario, $order_date, $id_pedido, $preco_total)
    {
        {
            $sql = "INSERT INTO public.pedido(numero, cpf_cliente, id_pedido, id_funcionario, order_date, preco_total) VALUES (:numero, :cpf_cliente, :id_pedido, :id_funcionario, :order_date, :preco_total);";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':numero', $numero);
            $stmt->bindValue(':cpf_cliente', $cpf);
            $stmt->bindValue(':id_pedido', $id_pedido);
            $stmt->bindValue(':id_funcionario', $id_funcionario);
            $stmt->bindValue(':order_date', $order_date);
            $stmt->bindValue(':preco_total', $preco_total);
            $stmt->execute();
        }
    }

    public function deleteByID($id_pedido)
    {
        $sql = "DELETE FROM public.pedido WHERE id_pedido='$id_pedido';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
}
?>
