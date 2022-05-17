<?php


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
        <p>Cliente : Ademar Couto</p>
        <p>ID do CLiente:  <?php if(isset($_GET["id_paga"])){echo $_GET["id_paga"] ?> </p>
        <p>Excursao : Gramado</p>
        <p>ID da Excursao: <?php echo $_GET["id_exc"] ;}?></p>
        
        <form class="cadastro" action="" method="POST">
            <label for="forma_pagamento">Forma de Pagamento</label>
            <select name="forma_pagamento" id="forma_pagamento" >
                <option value=""></option>
                <option value="a vista">Á vista</option>
                <option value="pix">Pix</option>
                <option value="cartao">Cartão</option>
                <option value="boleto">Boleto</option>
            </select>
            <label for="quant_parcela">Quantas Parcelas</label>
            <input type="text" id="quant_parcela">
            <label for="valor_total">Valor Total</label>
            <input id="valor_total" type="number_format(5,2)" value="<?php echo $_GET["total"] ?>">

            <input type="submit" value="Pagar">
        </form>
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