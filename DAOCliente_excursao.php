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
        $cmd = $this->conn->prepare("select c.nome_cliente, e.data_excursao_ida, e.data_excursao_volta, ascento, quarto from cliente_excursao ce
        inner join cliente c on c.id_cliente = ce.id_cliente
        inner join excursao e on e.id_excursao = ce.id_excursao
        where e.id_excursao = :id");
        $cmd->bindValue(":id", $id_excursao);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}



?>