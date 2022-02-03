<?php

include_once("class/Conexao.php");
include_once("config.php");

class DAOExcursao
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
    public function cadastroExcursao()
    {
        $excursao = new Excursao;

        $excursao->setTitulo_excursao($_POST['titulo']);
        $excursao->setDesc_excursao(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
        $excursao->setValor_excursao($_POST['valor']);
        $excursao->setData_excursao_ida($_POST['dataIda']);
        $excursao->setData_excursao_volta($_POST['dataVolta']);
        $excursao->setExcursao_valida($_POST['checkValido']);
        $excursao->setIntro_excursao($_POST['intro']);

        $titulo_excursao = $_POST["titulo"];
        $desc_excursao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
        $valor_excursao = $_POST["valor"];
        $data_excursao_ida = $_POST["dataIda"];
        $data_excursao_volta = $_POST["dataVolta"];
        $excursao_valida = $_POST["checkValido"];

        $stmt = $this->conn->prepare("INSERT INTO excursao(titulo_excursao, desc_excursao, valor_excursao, data_excursao_ida, data_excursao_volta, excursao_valida, intro_excursao)
        values (:t, :d, :v, :di, :dv, :ev, :ie)");

        $stmt->bindValue(":t", $excursao->getTitulo_excursao());
        $stmt->bindValue(":d", $desc_excursao);
        $stmt->bindValue(":v", $excursao->getValor_excursao());
        $stmt->bindValue(":di", $excursao->getData_excrusao_ida());
        $stmt->bindValue(":dv", $excursao->getData_excrusao_volta());
        $stmt->bindValue(":ev", $excursao_valida);
        $stmt->bindValue(":ie", $excursao->getIntro_excursao());
        $stmt->execute();
    }

    public function atualizaExcursao($id_up, $tituloExcursao, $desc_excursao, $valorExcursao, $dataIda, $dataVolta, $excursaoValida, $introExcursao) {
        $cmd = $this->conn->prepare("UPDATE excursao SET titulo_excursao = :t, desc_excursao = :d, valor_excursao = :v, data_excursao_ida = :di, data_excursao_volta = :dv, 
        excursao_valida = :ev, intro_excursao = :ie WHERE id_excursao = :idUp");
        $cmd->bindValue(":idUp", $id_up);
        $cmd->bindValue(":t", $tituloExcursao);
        $cmd->bindValue(":d", $desc_excursao);
        $cmd->bindValue(":v", $valorExcursao);
        $cmd->bindValue(":di", $dataIda);
        $cmd->bindValue(":dv", $dataVolta);
        $cmd->bindValue(":ev", $excursaoValida);
        $cmd->bindValue(":ie", $introExcursao);

        $cmd->execute();

        echo "<script>alert('Atualizado com sucesso')  </script>";
    }

    public function apagaExcursao ($id) {
        $apagar = $this->conn->prepare("DELETE FROM excursao WHERE id_excursao = :id");
        $apagar->bindValue(":id", $id);
        $apagar->execute();
    }
    public function pesquisaExcursao($tituloExcursao) {

        $titulo = trim($tituloExcursao . "%");
        $pesquisa = $this->conn->prepare("SELECT * FROM excursao WHERE titulo_excursao like :t");
        $pesquisa->bindValue(":t", $titulo);
        $pesquisa->execute();

        $rows = $pesquisa->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function chamaExcursao($idExcursao) {
        $sth = $this->conn->prepare("SELECT * FROM excursao WHERE id_excursao = :idExcursao");
        $sth->bindValue(":idExcursao", $idExcursao);
        $sth->execute();

        $res = $sth->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
}


