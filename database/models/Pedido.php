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
                'order_date' => $row['order_date']
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
            'order_date' => $row['order_date']
        ];
        return $stocks;
    }

    public function last(){
        $sql = "SELECT MAX(id_pedido) FROM public.pedido;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function insert($numero, $cpf, $id_funcionario, $order_date)
    {
        {
            $sql = "INSERT INTO public.pedido(numero, cpf_cliente, id_funcionario, order_date) VALUES (:numero, :cpf_cliente, :id_funcionario, :order_date);";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':numero', $numero);
            $stmt->bindValue(':cpf_cliente', $cpf);
            $stmt->bindValue(':id_funcionario', $id_funcionario);
            $stmt->bindValue(':order_date', $order_date);
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
