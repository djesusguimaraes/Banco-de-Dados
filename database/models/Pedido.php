<?php

namespace conpostgres;

class PedidoModel
{
    private $pdo;

    public function __construct($pdo)
    {
       $this->pdo = $pdo;
    }

    public function showByCPF($cpf)
    {
    $stmt = $this->pdo->query("SELECT id_pedido FROM public.pedido WHERE cpf_cliente='$cpf';");
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            $stocks[] = [
                'id_pedido' => $row['id_pedido']
            ];
        }
        return $stocks;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM public.pedido;');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            $stocks[] = [
                'id_pedido' => $row['id_pedido'],
                'cpf_cliente' => $row['cpf_cliente'],
                'id_funcionario' => $row['id_funcionario'],
                'order_date' => $row['order_date'],
                'preco_total' => $row['preco_total']

            ];
        }
        return $stocks;
    }

    public function junto(){
        $stmt = $this->pdo->query('SELECT cpf_cliente, id_funcionario, order_date, preco_total, id_servico, a.id_pedido, c.id_item FROM pedido a INNER JOIN item c ON a.id_pedido = c.id_pedido;');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            $stocks[] = [
                'cpf_cliente' => $row['cpf_cliente'],
                'id_funcionario' => $row['id_funcionario'],
                'order_date' => $row['order_date'],
                'preco_total' => $row['preco_total'],
                'id_servico' => $row['id_servico'],
                'id_pedido' => $row['id_pedido'],
                'id_item' => $row['id_item']
            ];
        }
        return $stocks;
    }

    public function showByID($id_pedido)
    {
        $stmt = $this->pdo->query("SELECT * FROM public.pedido WHERE id_pedido='$id_pedido';");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stocks = [
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

    public function update($cpf, $id_funcionario, $order_date, $id_pedido)    
    {
        $sql = "UPDATE public.pedido SET cpf_cliente='$cpf', id_funcionario='$id_funcionario', order_date='$order_date' WHERE  id_pedido='$id_pedido';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function insert($cpf, $id_funcionario, $order_date, $id_pedido, $preco_total)
    {
        {
            $sql = "INSERT INTO public.pedido(cpf_cliente, id_pedido, id_funcionario, order_date, preco_total) VALUES (:cpf_cliente, :id_pedido, :id_funcionario, :order_date, :preco_total);";
            $stmt = $this->pdo->prepare($sql);

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

    public function deleteByCPF($cpf)
    {
        $sql = "DELETE FROM public.pedido WHERE cpf_cliente='$cpf';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
}
?>
