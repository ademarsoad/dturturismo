<?php

include_once("conexao.php");


$titulo_excursao = $_POST["titulo"];
$desc_excursao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
$valor_excursao=$_POST["valor"];
$data_excursao_ida = $_POST["dataIda"];
$data_excursao_volta = $_POST["dataVolta"];
$excursao_valida = $_POST["checkValido"];

//$stmt = $conn->prepare("INSERT INTO excursao(titulo_excursao, desc_excursao, valor_excursao, data_excursao_ida, data_excursao_volta, excursao_valida)
//values (?, ?, ?, ?, ?, ?)");

//$stmt->execute(array($titulo_excursao, $desc_excursao, $valor_excursao, $data_excursao_ida, $data_excursao_volta, $excursao_valida));




echo "<br> <hr>";
echo "Titulo: ".ucfirst($titulo_excursao);
echo "<br> <hr>";
echo "Descrição: " . html_entity_decode($desc_excursao);
echo "<br> <hr>";
echo "Valor: ".$valor_excursao;
echo "<br> <hr>";
echo "Data de Ida: ". $data_excursao_ida;
echo "<br> <hr>";
echo "Data de Volta: ".$data_excursao_volta;
echo "<br> <hr>";
echo "Excursao Ativa: ".$excursao_valida;
echo "<br> <hr>";
echo $desc_excursao;

?>