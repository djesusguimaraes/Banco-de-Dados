<?php

namespace conpostgres;

class CarroModel
{
    private $pdo;

    public function __construct($pdo)
    {
       $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM public.carro;');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            $stocks[] = [
                'placa' => $row['placa'],
                'modelo' => $row['modelo'],
                'ano' => $row['ano'],
                'cpf' => $row['cpf']
            ];
        }
        return $stocks;
    }

    public function show($cpf)
    {
        $stmt = $this->pdo->query("SELECT * FROM public.carro WHERE cpf='$cpf';");
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $stocks[] = [
                'placa' => $row['placa'],
                'modelo' => $row['modelo'],
                'ano' => $row['ano']
            ];
        }
        return $stocks;
    }

    public function showByCPF($cpf)
    {
        $stmt = $this->pdo->query("SELECT * FROM public.carro WHERE cpf='$cpf';");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stocks = [
            'placa' => $row['placa'],
            'modelo' => $row['modelo'],
            'ano' => $row['ano']
        ];
        return $stocks;
    }

    public function update($placa, $modelo, $ano)
    {
        $sql = "UPDATE public.carro SET placa='$placa', modelo='$modelo', ano='$ano' WHERE  placa='$placa';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function insert($placa, $modelo, $ano, $cpf)
    {
        {
            $sql = "INSERT INTO public.carro(placa, modelo, ano, cpf) VALUES (:placa, :modelo, :ano, :cpf);";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':placa', $placa);
            $stmt->bindValue(':modelo', $modelo);
            $stmt->bindValue(':ano', $ano);
            $stmt->bindValue(':cpf', $cpf);
            $stmt->execute();
        }
    }

    public function deleteByPlaca($placa)
    {
        $sql = "DELETE FROM public.carro WHERE placa='$placa';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
}
?>
