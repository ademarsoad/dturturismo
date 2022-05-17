<?php

include_once("config.php");


class DAOCliente_excursao {

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
    public function cadastraClientePasseio($idDoCliente, $idDoPasseio, $assento, $quarto) {
        $cmd = $this->conn->prepare("INSERT INTO cliente_excursao( id_cliente, id_excursao, ascento, quarto) VALUES (:idc, :ide, :a, :q)");
        $cmd->bindValue(":idc", $idDoCliente);
        $cmd->bindValue(":ide", $idDoPasseio);
        $cmd->bindParam(":a", $assento);
        $cmd->bindValue(":q", $quarto);
        $cmd->execute(); 
        
    }
    public function todosPasseios($id_cliente) {
        $cmd = $this->conn->prepare("SELECT e.titulo_excursao, e.valor_excursao, e.data_excursao_ida, e.data_excursao_volta, 
        ce.ascento, ce.quarto from cliente_excursao ce
        inner join cliente c on c.id_cliente = ce.id_cliente
        inner join excursao e on e.id_excursao = ce.id_excursao
        where c.id_cliente = :id");
        $cmd->bindValue(":id", $id_cliente);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function clientePasseio($id_excursao) {
        $cmd = $this->conn->prepare("select c.id_cliente, c.nome_cliente, c.rg_cliente, e.id_excursao, e.data_excursao_ida, e.data_excursao_volta, e.valor_excursao, ascento, quarto from cliente_excursao ce
        inner join cliente c on c.id_cliente = ce.id_cliente
        inner join excursao e on e.id_excursao = ce.id_excursao
        where e.id_excursao = :id");
        $cmd->bindValue(":id", $id_excursao);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function chamarPasseio($clienteidcliente, $excursaoidexcursao) {
        $cmd = $this->conn->prepare("SELECT ascento, quarto FROM cliente_excursao WHERE id_cliente = :cic and id_excursao = :eie");
        $cmd->bindValue(":cic", $clienteidcliente);
        $cmd->bindValue(":eie", $excursaoidexcursao);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);

        return $res;

    }
    public function editarPasseio($iddocliente, $iddaexcursao, $assento, $quarto) {
        $cmd = $this->conn->prepare("UPDATE cliente_excursao SET ascento = :ass, quarto = :q WHERE id_cliente = :cic AND id_excursao = :eie");
        $cmd->bindValue(":ass", $assento);
        $cmd->bindValue(":q", $quarto);
        $cmd->bindValue(":cic", $iddocliente);
        $cmd->bindValue(":eie", $iddaexcursao);
        $cmd->execute();
        
    }
}

?>