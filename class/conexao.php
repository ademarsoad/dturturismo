<?php
/*
class Conexao {

    private $login = "root";
    private $senha = "";
    private $banco = "dturturimo";
    private $conn;
 
    public function __construct() {
        try{
            $conn = new PDO("mysql:host=localhost; dbname=dturturismo", "root", "");
            if($conn) {
            echo "database conectado";
            }
            }catch (PDOException $e){
            // report error message
            echo $e->getMessage();
            }
    }
    */

    try{
        $conn = new PDO("mysql:host=localhost; dbname=dturturismo", "root", "");
    }catch(PDOException $e) {
        echo "Erro com o banco de dados ". $e;
    }catch(Exception $e) {
        echo "Erro generico " . $e;
    }
    

    

?>