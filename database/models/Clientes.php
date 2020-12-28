<?php

namespace conpostgres;

class ClientModel
{
    private $pdo;

    public function __construct($pdo)
    {
       $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM public.cliente;');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            $stocks[] = [
                'nome' => $row['nome'],
                'cpf' => $row['cpf'],
                'carro' => $row['carro'],
                'telefone' => $row['telefone'],
                'placa' => $row['placa'],
                'id_servico' => $row['id_servico'],
                'id_funcionario' => $row['id_funcionario']

            ];
        }
        return $stocks;
    }

    public function showByCPF($cpf)
    {
        $stmt = $this->pdo->query("SELECT * FROM public.cliente WHERE cpf='$cpf';");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stocks = [
            'nome' => $row['nome'],
            'cpf' => $row['cpf'],
            'carro' => $row['carro'],
            'telefone' => $row['telefone'],
            'placa' => $row['placa']
        ];
        return $stocks;
    }

    public function update($nome, $telefone, $carro, $placa, $cpf)
    {
        $sql = "UPDATE public.cliente SET nome='$nome', telefone='$telefone', carro='$carro', placa='$placa' WHERE  cpf='$cpf';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function insert($nome, $cpf, $carro, $telefone, $placa, $servico, $funcionario)
    {

        {
            $sql = "INSERT INTO public.cliente(nome, cpf, carro, telefone, placa, id_servico, id_funcionario) VALUES (:nome, :cpf, :carro, :tel, :placa, :servico, :funcao);";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':cpf', $cpf);
            $stmt->bindValue(':carro', $carro);
            $stmt->bindValue(':tel', $telefone);
            $stmt->bindValue(':placa', $placa);
            $stmt->bindValue(':servico', $servico);
            $stmt->bindValue(':funcao', $funcionario);
            $stmt->execute();

        }
    }

    public function deleteByCPF($cpf)
    {

        $sql = "DELETE FROM public.cliente WHERE cpf='$cpf';";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
    }
}
?>
