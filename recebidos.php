<?php

include_once("DAOPagamento.php");
include_once("DAOCliente.php");
include_once("DAOExcursao.php");

$exc = new DAOExcursao;
$cl = new DAOCliente;
$pa = new DAOPagamento;


session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/ValidandoFormulario.js" defer></script>
    <title>DED Turismo</title>

    <style>
        .btn-editar,
        .btn-deletar {
            background-color: white;
            color: black;
            margin: 0px 5px;
            text-decoration: none;
        }
    </style>

</head>

<body>
    <header class="cabecalho">
        <a href="index.html">
            <img src="img/Logo-DED-Tur-colorida%5B108%5D-150x150.png" class="navegacao-topo-logo">
        </a>
        <input type="checkbox" id="check">
        <label for="check" class="check-label">
            <img src="img/icone.png" class="check-img">
        </label>
        <nav class="navegacao">
            <ul class="navegacao-lista">
                <li><a href="index.php">Home</a></li>
                <li><a href="cadastroexcursao.php">Excursões</a></li>
                <li><a href="TodasExcursoes.php">Pesquisa Excursão</a></li>
                <li><a href="cadastrocliente.php">Cliente</a></li>
                <li><a href="TodosCLientes.php">Pesquisa Cliente</a></li>
                <li><a href="sair.php"> Sair </a></li>

            </ul>
        </nav>
    </header>
    <section class="sessaoprincipal">
    <?php if(isset($_GET["id_paga"])){
        $rows = $pa->mostraPagamento($_GET["id_paga"], $_GET["id_exc"]);
        $cliente = $cl->chamaCliente($_GET["id_paga"]);
        $excur = $exc->chamaExcursao($_GET["id_exc"]);
        $pag = $pa->todosPagamentos($_GET["id_paga"], $_GET["id_exc"]);

        $idPagamento = $pag["idpagamento"];

        $total_parcela = $excur["valor_excursao"];

        $campos = "";
     ?>
     <p>Cliente: <?php echo $cliente["nome_cliente"] ?></p>
    
        <p class="tituloExcursao"><?php echo $excur["titulo_excursao"] ?></p>
        
        
        <caption>Valor Total: <?php echo $excur["valor_excursao"] ?> </caption>
        
        <table class="clienteTabela">
            <thead>
                <tr>
                    <th>Parcela</th>
                    <th>Valor</th>
                    <th>Data Pagamento</th>
                </tr>

            </thead>
        <?php foreach($rows as $row){
            ?>
            
            <tbody>
                <tr>
                    <th><?php printf("$row[num_parcela]"); ?>/<?php printf("$row[quant_parcelas]"); ?> </th>
                    <th><?php printf("$row[valor_parcela]"); ?></th>
                    <th><?php printf(date_format(date_create("$row[data_pagamento]"), 'd/m/Y')); ?></th>
                </tr>
                
            </tfoot>
            
            <?php $total_parcela = $total_parcela - $row["valor_parcela"]; if($row["num_parcela"] == $row["quant_parcelas"]){$campos = "disabled";} } ?> <p>Faltando pagar: <?php echo $total_parcela; }?></p>
        </table>
        <form action="" method="POST" class="cadastro">
            <p><label for="num">Numero de Parcelas</label> 
               <input type="text" id="num" name="num_parcela" <?php echo $campos ?> ></p>
               <p><label for="var">Valor</label> 
               <input type="text" id="var" name="valor" <?php echo $campos ?> ></p>
               <p><label for="data">Data Pagamento</label> 
               <input type="date" id="data" name="data_pag" <?php echo $campos ?> ></p>
                <input type="submit" value="Pagar" <?php echo $campos ?> >

        </form>
        <?php if(isset($_POST["num_parcela"])) {
            $pa->pagarParcela($_POST["valor"],$_POST["num_parcela"], $_POST["data_pag"], $idPagamento );
            header("Refresh:0");
        } ?>
    </section>
    
    <footer class="rodape clearfix">
        <div class="rodape-coluna ">
            <h2 class="rodape-titulo">Midias Sociais</h2>
            <ul class="navegacao-lista">
                <li><a class="rodape-links" href="https://www.instagram.com/dtur_turismo/" target="_blanck">Instagram </a></li>
                <li><a class="rodape-links" href="#">YouTube</a></li>
                <li><a class="rodape-links" href="#">Facebook</a></li>
                <li><a class="rodape-links" href="#">WhatsApp</a></li>
            </ul>

        </div>

        <div class="rodape-coluna ">
            <div>
                <img src="img/Logo-DED-Tur-colorida%5B108%5D-150x150.png" class="navegacao-topo-logo">
                <p>Somos uma agência de viagens, com o objetivo de proporcionar experiências incríveis através de excursões personalizadas e completas. </p>
            </div>
        </div>
        <div class="rodape-coluna">
            <h2 class="rodape-titulo">Links</h2>

            <ul class="navegacao-lista">
                <li><a class="rodape-links" href="index.html">Index</a></li>
                <li><a class="rodape-links" href="excursao.html">Excursões</a></li>
                <li><a class="rodape-links" href="bateevolta.html">bate e Volta</a></li>
                <li><a class="rodape-links" href="sobrenos.html">Sobre Nós</a></li>

            </ul>

        </div>

    </footer>
    <div class="rodape-linha">
        &copy; Todos os direitos reservados
    </div>
</body>

</html>