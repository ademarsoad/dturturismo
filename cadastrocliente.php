<?php

include_once("config.php");
include_once("class/conexao.php");

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


if($doc->validaCpf($cliente->getCpf_cliente()) == false ) {
    echo "CPF incorreto";
}else  {
    $stmt = $conn->prepare("INSERT INTO cliente(nome_cliente, tel_cliente, email_cliente, cpf_cliente, rg_cliente, end_cliente, data_nasc )
    values (?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute(array(strtolower($cliente->getNome_cliente()), $cliente->getTel_cliente(), $cliente->getEmail_cliente(), $cliente->getCpf_cliente(),
    $cliente->getRg_cliente(),$cliente->getEnd_cliente(), $cliente->getData_nasc()));



   echo "<br> <hr>";
   echo "Nome do Cliente: ".ucfirst($cliente->getNome_cliente());
   echo "<br> <hr>";
   echo "Telefone do Cliente: ".$cliente->getTel_cliente();
   echo "<br> <hr>";
   echo "Endereço do cliente: ".$cliente->getEnd_cliente();
   echo "<br> <hr>";
   echo "Email do Cliente: ". $cliente->getEmail_cliente();
   echo "<br> <hr>";
   echo "CPF do Cliente: ".$cliente->getCpf_cliente();
   echo "<br> <hr>";
   echo "R.G do Cliente: ".$cliente->getRg_cliente();
   echo "<br> <hr>";
   echo "Data de Nascimento: ".$cliente->getData_nasc();
   
   //new Cliente;

   header("Location: cadastrocliente.html");

}

/*

$sth = $dbh->query('SELECT * FROM countries');

// fetch all rows into array, by default PDO::FETCH_BOTH is used
$rows = $stm->fetchAll();

// iterate over array by index and by name
foreach($rows as $row) {

    printf("$row[0] $row[1] $row[2]\n");
    printf("$row['id'] $row['name'] $row['population']\n");

}

*/
?>