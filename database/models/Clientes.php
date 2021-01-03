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
                'telefone' => $row['telefone'],
                'delete_at' => $row['delete_at']
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
            'telefone' => $row['telefone'],
            'delete_at' => $row['delete_at']
        ];
        return $stocks;
    }

    public function update($nome, $telefone, $cpf)
    {
        $sql = "UPDATE public.cliente SET nome='$nome', telefone='$telefone' WHERE  cpf='$cpf';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function hide($mostra, $cpf)
    {
        $sql = "UPDATE public.cliente SET delete_at = '$mostra' WHERE  cpf='$cpf';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function unnhide($cpf)
    {
        $sql = "UPDATE public.cliente SET delete_at = null WHERE  cpf='$cpf';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function insert($nome, $cpf, $telefone)
    {

        {
            $sql = "INSERT INTO public.cliente(nome, cpf, telefone) VALUES (:nome, :cpf, :tel);";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':cpf', $cpf);
            $stmt->bindValue(':tel', $telefone);
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
