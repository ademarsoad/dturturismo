<?php
/*
include_once("conexao.php");

$sth = $conn->query('SELECT * FROM cliente');

// fetch all rows into array, by default PDO::FETCH_BOTH is used
$rows = $sth->fetchAll();

// iterate over array by index and by name

foreach ($rows as $row) {
    print("<br />");
    printf("$row[nome_cliente], $row[tel_cliente], $row[email_cliente], $row[cpf_cliente], $row[rg_cliente]");
    printf("<br />---------------------------------------------------------------------------------------------- <br />");
}
*/
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
    <title>DED Turismo</title>

    <style>
        .btn-editar {
            background-color: white;
            color: black;
            padding: 5px;
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
                <li><a href="index.html">Home</a></li>
                <li><a href="excursao.html">Excursões</a></li>
                <li><a href="bateevolta.html">Bate e Volta</a></li>
                <li><a href="sobrenos.html">Sobre Nós</a></li>

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
                include_once("class/conexao.php");

                if(empty($_POST['pesquisa'])) {
                    $_POST['pesquisa'] = "";
                    echo "<br />Nome para pesquisa precisa ser digitado";
                }else {

                    $pesquisaCliente = "%" . trim($_POST["pesquisa"]) . "%";

                    $sth = $conn->prepare('SELECT * FROM cliente WHERE nome_cliente like :nome_cliente');
                    $sth->bindValue(":nome_cliente", '%' . $pesquisaCliente);
                    $sth->execute();

                    // fetch all rows into array, by default PDO::FETCH_BOTH is used
                    $rows = $sth->fetchAll();

                    // iterate over array by index and by name

                    foreach ($rows as $row) {
                ?>
                        <tr>
                            <td><?php printf(ucfirst("$row[nome_cliente]"));  ?></td>
                            <td><?php printf("$row[tel_cliente]");  ?></td>
                            <td><?php printf("$row[end_cliente]");  ?></td>
                            <td><?php printf("$row[email_cliente] "); ?></td>
                            <td><?php printf("$row[cpf_cliente] "); ?></td>
                            <td><?php printf("$row[rg_cliente] "); ?></td>
                            <td><?php printf(date_format(date_create("$row[data_nasc]"), 'd/m/Y')); ?></td>
                            <td><a href="" class="btn-editar">Editar</a> <a href="" class="btn-deletar">Deletar</a></td>
                        </tr>

                <?php }
                } ?>


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