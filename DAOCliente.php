<?php

include_once("config.php");


class DAOCliente
{
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=localhost; dbname=dturturismo", "root", "");
        } catch (PDOException $e) {
            echo "Erro com o banco de dados " . $e;
        } catch (Exception $e) {
            echo "Erro generico " . $e;
        }
    }
    public function cadastroCliente()
    {
        $cliente = new Cliente;

        $cliente->setNome_cliente($_POST["nome"]);
        $cliente->setTel_cliente($_POST["tel"]);
        $cliente->setEmail_cliente($_POST["email"]);
        $cliente->setEnd_cliente($_POST["end"]);
        $cliente->setCpf_cliente($_POST["cpf"]);
        $cliente->setRg_cliente($_POST["rg"]);
        $cliente->setData_nasc($_POST["data_nasc"]);

        $doc = new Checacpf;

        //$doc->validaCpf($cliente->getCpf_cliente());


        if ($doc->validaCpf($cliente->getCpf_cliente()) == false) {
            echo "CPF incorreto";
        } else {

            /* $stmt = $conn->prepare("INSERT INTO cliente(nome_cliente, tel_cliente, email_cliente, cpf_cliente, rg_cliente, end_cliente, data_nasc )
    values (?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute(array(strtolower($cliente->getNome_cliente()), $cliente->getTel_cliente(), $cliente->getEmail_cliente(), $cliente->getCpf_cliente(),
    $cliente->getRg_cliente(),$cliente->getEnd_cliente(), $cliente->getData_nasc()));
*/

            $cmd = $this->conn->prepare("INSERT INTO cliente(nome_cliente, tel_cliente, email_cliente, cpf_cliente, rg_cliente, end_cliente, data_nasc )
    values (:n, :t, :e, :c, :r, :en, :d)");

            $cmd->bindValue(":n", addslashes($cliente->getNome_cliente()));
            $cmd->bindValue(":t", addslashes($cliente->getTel_cliente()));
            $cmd->bindValue(":e", addslashes($cliente->getEmail_cliente()));
            $cmd->bindValue(":c", addslashes($cliente->getCpf_cliente()));
            $cmd->bindValue(":r", addslashes($cliente->getRg_cliente()));
            $cmd->bindValue(":en", addslashes($cliente->getEnd_cliente()));
            $cmd->bindValue(":d", addslashes($cliente->getData_nasc()));

            $cmd->execute();

            /*
            echo "<br> <hr>";
            echo "Nome do Cliente: " . ucfirst($cliente->getNome_cliente());
            echo "<br> <hr>";
            echo "Telefone do Cliente: " . $cliente->getTel_cliente();
            echo "<br> <hr>";
            echo "Endereço do cliente: " . $cliente->getEnd_cliente();
            echo "<br> <hr>";
            echo "Email do Cliente: " . $cliente->getEmail_cliente();
            echo "<br> <hr>";
            echo "CPF do Cliente: " . $cliente->getCpf_cliente();
            echo "<br> <hr>";
            echo "R.G do Cliente: " . $cliente->getRg_cliente();
            echo "<br> <hr>";
            echo "Data de Nascimento: " . $cliente->getData_nasc();

            //new Cliente;

            //header("Location: cadastrocliente.html");
            */

            echo "<script>alert('Cadastrado com sucesso')  </script>";
            return true;
        }
    }
    public function pesquisaCliente($pesquisaCliente)
    {
        //echo $pesquisaCliente;

        //if(empty($pesquisaCliente)) {

        //  echo "<br />Nome para pesquisa precisa ser digitado";
        //}else {

        $nome = trim($pesquisaCliente . "%");

        $sth = $this->conn->prepare('SELECT * FROM cliente WHERE nome_cliente like :nome_cliente ORDER BY nome_cliente');
        $sth->bindValue(":nome_cliente", $nome);
        $sth->execute();

        // fetch all rows into array, by default PDO::FETCH_BOTH is used
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }
    public function deletaCliente($id)
    {
        echo "Deletando cliente com o id " . $id;
        $cmd = $this->conn->prepare("DELETE FROM cliente WHERE id_cliente = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }

    //Função para chamar o cliente antes de atualizar seu cadastro 
    public function chamaCliente($idCliente)
    {
       
        $sth = $this->conn->prepare("SELECT * FROM cliente WHERE id_cliente = :id");
        $sth->bindValue(":id", $idCliente);
        $sth->execute();
        $res = $sth->fetch(PDO::FETCH_ASSOC);

        return $res;
    }

    //Função para atualizar cadastro do cliente
    public function atualizarDados($id_up, $nomeUp, $telUp, $emailUp, $cpfUp, $rgUp, $dataUp, $endUp)
    {
        echo "Atualizando os dados";
        
        $cmd = $this->conn->prepare("UPDATE cliente SET nome_cliente = :n, tel_cliente = :t, email_cliente = :e, cpf_cliente = :c, rg_cliente = :r,
        data_nasc = :d, end_cliente = :en WHERE id_cliente = :idUp ");
        $cmd->bindValue(":idUp", $id_up);
        $cmd->bindValue(":n", $nomeUp);
        $cmd->bindValue(":t", $telUp);
        $cmd->bindValue(":e", $emailUp);
        $cmd->bindValue(":c", $cpfUp);
        $cmd->bindValue(":r", $rgUp);
        $cmd->bindValue(":en", $endUp);
        $cmd->bindValue(":d", $dataUp);
        $cmd->execute();

        echo "<script>alert('Atualizado com sucesso')  </script>";
    }
    public function todosClientes() {
        
        $cmd = $this->conn->prepare("SELECT * FROM cliente");
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
}
