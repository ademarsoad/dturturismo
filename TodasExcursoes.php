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
        .btn-editar, .btn-deletar {
            background-color: white;
            color: black;
            margin: 0px 5px;
            text-decoration: none;
}
    </style>
    <script>
    function excluir() {
    var x = confirm("Deseja realmenta excluir");
    if(x == true) {
        alert("Item será excluido");
    }else {
        alert("Item não será excluido");
    }
    
}
</script>
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
        <form action="TodasExcursoes.php" method="POST" class="cadastro">
            <input type="text" id="pesquisaCliente" name="pesquisa">
            <input type="submit" value="Pesquisar">
        </form>
        <hr />
        <table class="clienteTabela">
            <thead>
                <tr>
                    <th>Titulo Excursao</th>
                    <th>Valor da Excursao</th>
                    <th>Data da ida</th>
                    <th>Data da Volta</th>
                    <th>Excursao Ativa</th>
                    <th>Descrição</th>
                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("DAOExcursao.php");
                    $excursao = new DAOExcursao;

                    if(isset($_POST['pesquisa'])) {
                        $tituloExcursao = $_POST['pesquisa'];
                        $rows = $excursao->pesquisaExcursao($tituloExcursao);
                        foreach ($rows as $row) {
                            ?>
                                    <tr>
                                        <td><a href="paginaexcursao.php?id_pe=<?php echo $row["id_excursao"]; ?>"><?php printf(ucfirst("$row[titulo_excursao]"));  ?></a></td>
                                        <td><?php printf("$row[valor_excursao]");  ?></td>
                                        <td><?php printf(date_format(date_create("$row[data_excursao_ida]"), 'd/m/Y'));  ?></td>
                                        <td><?php printf(date_format(date_create("$row[data_excursao_volta]"), 'd/m/Y')); ?></td>
                                        <td><?php if($row['excursao_valida'] == 1) {echo "Ativo"; } else { echo "Desativado";} ?></td>
                                        <td><?php printf("$row[intro_excursao] "); ?></td>
                                        <td><a href="cadastroexcursao.php?id_up=<?php echo $row["id_excursao"]; ?>" class="btn-editar">Editar</a> 
                                        <a href="TodasExcursoes.php?id=<?php echo $row["id_excursao"]; ?>" class="btn-deletar" >Deletar</a></td>
                                    </tr>
            
                            <?php } } ?>
            </tbody>
        </table>
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
<?php
if (isset($_GET['id'])) {
    $id_excursao = addslashes($_GET['id']);
    $excursao->apagaExcursao($id_excursao);
    header("location: TodasExcursoes.php");
}

?>