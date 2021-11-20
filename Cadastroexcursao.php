<?php

include_once("class/Conexao.php");
include_once("config.php");

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
$valor_excursao=$_POST["valor"];
$data_excursao_ida = $_POST["dataIda"];
$data_excursao_volta = $_POST["dataVolta"];
$excursao_valida = $_POST["checkValido"];

$stmt = $conn->prepare("INSERT INTO excursao(titulo_excursao, desc_excursao, valor_excursao, data_excursao_ida, data_excursao_volta, excursao_valida, intro_excursao)
values (?, ?, ?, ?, ?, ?, ?)");

$stmt->execute(array($excursao->getTitulo_excursao(), $desc_excursao, $excursao->getValor_excursao(), $excursao->getData_excrusao_ida(),
$excursao->getData_excrusao_volta(), $excursao->getExcursao_valida(), $excursao->getIntro_excursao()));




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

header("Location: cadastroexcursao.html");

?>