<?php 

include_once("config.php");

class DAOPagamento {

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

    public function pagarExcursao($forma, $valorTotal, $quant_parcela, $id_exc, $id_cli) {
        $cmd = $this->conn->prepare("INSERT INTO pagamento(forma_pagamento, valor_total, quant_parcelas, excursao_id_excursao, cliente_id_cliente)
        VALUES(:f, :vt, :qp, :e, :c)");
        $cmd->bindValue(":f", $forma);
        $cmd->bindValue(":vt", $valorTotal);
        $cmd->bindValue(":qp", $quant_parcela);
        $cmd->bindValue(":e", $id_exc);
        $cmd->bindValue("c", $id_cli);
        $cmd->execute();
        
    }
    public function todosPagamentos($clienteId, $excursaoId) {
        $cmd = $this->conn->prepare("SELECT * FROM pagamento where cliente_id_cliente = :idcliente and excursao_id_excursao = :idexcursao");
        $cmd->bindValue(":idcliente", $clienteId);
        $cmd->bindValue(":idexcursao", $excursaoId);
        $cmd->execute();

        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;

    }
    public function mostraPagamento($clienteId, $excursaoId) {
        $cmd = $this->conn->prepare("SELECT p.idpagamento, p.forma_pagamento, p.valor_total, p.quant_parcelas, c.nome_cliente, e.titulo_excursao, pa.valor_parcela, pa.num_parcela, pa.data_pagamento FROM pagamento p
        inner join cliente c on c.id_cliente = p.cliente_id_cliente
        inner join excursao e on e.id_excursao = p.excursao_id_excursao
        inner join parcela pa on p.idpagamento = pa.pagamento_idpagamento
        where c.id_cliente = :clienteId and e.id_excursao = :excursaoId");
        $cmd->bindValue(":clienteId", $clienteId);
        $cmd->bindValue(":excursaoId", $excursaoId);
        $cmd->execute();

        $rem = $cmd->fetchall(PDO::FETCH_ASSOC);
        
        return $rem;
    }
    public function pagarParcela($valor, $num_parcela, $data_pag, $idParc) {
        $cmd = $this->conn->prepare("INSERT INTO parcela(valor_parcela, data_pagamento, num_parcela, pagamento_idpagamento)
        VALUES(:vp, :dp, :np, :ip)");
        $cmd->bindValue(":vp", $valor);
        $cmd->bindValue(":dp", $data_pag);
        $cmd->bindValue(":np", $num_parcela);
        $cmd->bindValue(":ip",$idParc);
        $cmd->execute();
        return true;
    }

    public function tudoPago($pegaidcliente, $pegaidexcursao) {

        $cmd = $this->conn->prepare("SELECT sum(p.valor_parcela) as total, pa.valor_total from parcela p 
        inner join pagamento pa on pa.idpagamento = p.pagamento_idpagamento
        WHERE excursao_id_excursao = :eie and cliente_id_cliente = :cic");

        $cmd->bindValue(":eie", $pegaidexcursao);
        $cmd->bindValue(":cic", $pegaidcliente);

        $cmd->execute();

        $retorno = $cmd->fetch(PDO::FETCH_ASSOC);
        if($retorno['total'] != $retorno['valor_total']){
            $fundo = "red";
        }else {
            $fundo = "green";
        }
        

        return $fundo;
    }

    public function alterarPagameto($idPagamento, $quant_parcela, $valor, $forma) {
        echo "Atualizando <br>";
        /* echo $idPagamento . "<br>";
        echo $quant_parcela . "<br>";
        echo $valor . "<br>";
        echo $forma . "<br>"; */
        $cmd = $this->conn->prepare("UPDATE pagamento SET forma_pagamento = :fp, valor_total = :vt, quant_parcelas = :qt WHERE idpagamento = :idpa");
        $cmd->bindValue(":fp", $forma);
        $cmd->bindValue(":vt", $valor);
        $cmd->bindValue(":qt", $quant_parcela);
        $cmd->bindValue("idpa", $idPagamento);

        $cmd->execute();
    }
}

?>