<?php
include_once("../config.php");
include_once("PDOConection.php");

class DAOCliente
{
    private $pdo;
    private $dbname = "dturturismo";
    private $host = "localhost";
    private $login = "root";
    private $senha = "";

    
  
    public function cadastroCliente()
    {

    }

}
$cliente = new DAOCliente;
$cliente->cadastroCliente();

?>
