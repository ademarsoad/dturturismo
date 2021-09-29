<?php


include_once("checaCpf.php");
include_once("conexao.php");

$nome_cliente = $_POST["nome"];
$tel_cliente = $_POST["tel"];
$email_cliente = $_POST["email"];
$end_cliente = $_POST["end"];
$cpf_cliente = $_POST["cpf"];
$rg_cliente = $_POST["rg"];
$data_nasc = $_POST["data_nasc"];



$stmt = $conn->prepare("INSERT INTO cliente(nome_cliente, tel_cliente, email_cliente, cpf_cliente, rg_cliente, end_cliente, data_nasc )
values (?, ?, ?, ?, ?, ?, ?)");

$stmt->execute(array(strtolower($nome_cliente), $tel_cliente, $email_cliente, $cpf_cliente, $rg_cliente, $end_cliente, $data_nasc));


echo "<br> <hr>";
echo "Nome do Cliente: ".ucfirst($nome_cliente);
echo "<br> <hr>";
echo "Telefone do Cliente: ".$tel_cliente;
echo "<br> <hr>";
echo "Endereço do cliente: ".$end_cliente;
echo "<br> <hr>";
echo "Email do Cliente: ". $email_cliente;
echo "<br> <hr>";
echo "CPF do Cliente: ".$cpf;
echo "<br> <hr>";
echo "R.G do Cliente: ".$rg_cliente;
echo "<br> <hr>";
echo "Data de Nascimento: ".$data_nasc;

?>