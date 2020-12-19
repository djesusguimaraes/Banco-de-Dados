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
               $sql = "INSERT INTO Cliente (Telefone,Nome, CPF, ID_Serviço, Carro) VALUES (:Telefone,:Nome, :CPF, :ID_Serviço, :Carro)";
               $stmt = $this->conn->prepare($sql);

               $stmt->bindValue(':Telefone', $Telefone);
               $stmt->bindValue(':Nome', $Nome);
               $stmt->bindValue(':CPF', $CPF);
               $stmt->bindValue(':ID_Serviço', $ID_Servico);
               $stmt->bindValue(':Carro', $Carro);
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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/normalize_pure.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Fugaz+One&family=Sarabun:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script type="java/javascript" src="../js/functions.js"></script>
    
</head>
<body>
    <header>
        <div class="pure-menu pure-menu-horizontal">
            <ul class="pure-menu-list">
                <li class="pure-menu-item pure-menu-selected">
                    <a href="#" class="pure-menu-link">Home</a>
                </li>
                <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
                    <a href="#" id="menuLink1" class="pure-menu-link">Contact</a>
                    <ul class="pure-menu-children">
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link">Email</a>
                        </li>
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link">Twitter</a>
                        </li>
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link">Tumblr Blog</a>
                        </li>
                    </ul>
                </li>
                <li class="pure-menu-item pure-menu-selected">
                    <a href="#" class="pure-menu-link">Administração</a>
                </li>
            </ul>
        </div>
        <div class="topo">
            <p class="logo">JavaLato</p>
            <p class="slogan">Seu carro em boas mãos.</p>
            <img src="../img/water.jpg" alt="">
        </div>
    </header>
    <div class="esquerda">
        <h1>Solicitação de Serviços</h1>
        <form name="cadCliente" class="pure-form pure-form-aligned" action="Cliente.php" method="POST">
            <fieldset id="cliente">
                <legend>Dados do Cliente</legend>
                <div class="pure-control-group">
                    <label for="name" class="pure-label">Nome</label>
                    <input type="text" id="name" placeholder="Digite seu nome..." required/>
                    <span class="pure-form-message-inline">*</span>
                </div>
                <div class="pure-control-group">
                    <label for="cpf" class="pure-label">CPF</label>
                    <input oninput="mascara(this, 'cpf')" type="text" id="cpf" autocomplete="off" placeholder="Digite seu CPF..." required/>
                    <span class="pure-form-message-inline">*</span>
                </div>
                <div class="pure-control-group">
                    <label for="foo" class="pure-label">Contato</label>
                    <input oninput="mascara(this, 'tel')" maxlength="12" type="tel" id="foo" placeholder="Digite seu telefone..."/>
                </div>
            </fieldset>
            <fieldset id="veiculo">
                <legend>Dados do Veículo</legend>
                <div class="pure-control-group">
                    <label for="modelo" class="pure-label">Modelo</label>
                    <input type="text" id="modelo"/>
                </div>
                <div class="pure-control-group">
                    <label for="ano" class="pure-label">Ano</label>
                    <input type="number"/>
                </div>
                <div class="pure-control-group">
                    <label for="pertences" class="pure-label">Pertences</label>
                    <textarea name="pertences" id="pertences" cols="21" rows="3"></textarea>
                </div>
            </fieldset>
            <fieldset>
                <legend>Escolha Serviços</legend>
                <div class="pure-control-group">
                    <label for="servico" class="pure-label">Opções</label>
                    <div class="pure-control-group">
                        <select name="simples" id="opcao_servico" class="opcao">
                            <option value="1">Ducha Simples</option>
                            <option value="2">Ducha Completa</option>
                            <option value="3">Limpeza Completa</option>
                            <option value="4">Aplicação de Cera de Alta Tecnologia</option>
                            <option value="5">Higienização e Hidratação em Bancos</option>
                            <option value="6">Higienização de Ar Condicionado</option>
                            <option value="7">Higienização de Teto</option>
                            <option value="8">Hipermeabilização de Tecido</option>
                            <option value="9">Lavagem Técnica do Motor</option>
                            <option value="10">Descontaminação de Pintura</option>
                            <option value="11">Vitrificação de Pintura</option>
                            <option value="12">Tira Riscos</option>
                            <option value="13">Polimento Técnico</option>
                            <option value="14">Insul Film</option>
                        </select>
                    </div>
                </div>
                <div class="pure-controls">
                    <button type="submit" class="pure-button pure-button-primary">Wash</button>
                </div>
            </fieldset>
        </form>
    </div>

    <div class="direita">
        <h1>Lista de Serviços</h1>
        <ol type="1" class="lista_opcoes">
            <li>Ducha Simples</li>
            <li>Ducha Completa</li>
            <li>Limpeza Completa</li>
            <li>Aplicação de Cera de Alta Tecnologia</li>
            <li>Higienização e Hidratação em Bancos</li>
            <li>Higienização de Ar Condicionado</li>
            <li>Higienização de Teto</li>
            <li>Hipermeabilização de Tecido</li>
            <li>Lavagem Técnica do Motor</li>
            <li>Descontaminação de Pintura</li>
            <li>Vitrificação de Pintura</li>
            <li>Tira Riscos</li>
            <li>Polimento Técnico</li>
            <li>Insul Film</li>
        </ol>
    </div>
</body>
    
</html>