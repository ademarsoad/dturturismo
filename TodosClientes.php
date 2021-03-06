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
        <form action="TodosClientes.php" method="POST" class="cadastro">
            <input type="text" id="pesquisaCliente" name="pesquisa">
            <input type="submit" value="Pesquisar">
        </form>
        <hr />
        <table class="clienteTabela">
            <thead>
                <tr>
                    <th>Nome do Cliente</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>R.G</th>
                    <th>Data de Nascimento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("DAOCliente.php");
                    $pessoa = new DAOCliente;

                    if(isset($_POST['pesquisa'])) {
                        $nomeCliente = $_POST['pesquisa'];
                        $rows = $pessoa->pesquisaCliente($nomeCliente);
                        foreach ($rows as $row) {
                            ?>
                                    <tr>
                                        <td><a href="paginacliente.php?id_pg=<?php echo $row["id_cliente"]; ?>" > <?php printf(ucfirst("$row[nome_cliente]"));  ?></a></td>
                                        <td><?php printf("$row[tel_cliente]");  ?></td>
                                        <td><?php printf("$row[end_cliente]");  ?></td>
                                        <td><?php printf("$row[email_cliente] "); ?></td>
                                        <td><?php printf("$row[cpf_cliente] "); ?></td>
                                        <td><?php printf("$row[rg_cliente] "); ?></td>
                                        <td><?php printf(date_format(date_create("$row[data_nasc]"), 'd/m/Y')); ?></td>
                                        <td><a href="cadastrocliente.php?id_up=<?php echo $row["id_cliente"]; ?>" class="btn-editar">Editar</a> 
                                        <a href="TodosClientes.php?id=<?php echo $row["id_cliente"]; ?>" class="btn-deletar" onclick="excluir()">Deletar</a></td>
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
    $id_pessoa = addslashes($_GET['id']);
    $pessoa->deletaCliente($id_pessoa);
    header("location: TodosClientes.php");
}

?>