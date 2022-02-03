<?php

class PDOConection {
    
    public $pdo;
    private $dbname = "dturturismo";
    private $host = "localhost";
    private $login = "root";
    private $senha = "";
    
    public function __construct()
    {
        try{
            $this->pdo = new PDO("mysql:dbname=$this->dbname;host=$this->host", $this->login, $this->senha);
            echo "Banco acessado com sucesso";
        }catch(PDOException $e){
            echo "Problema com o PDO " . $e->getMessage();
        }catch(Exception $e) {
            echo "Erro geral do programa " . $e->getMessage();
        }
           
    }
}


?>