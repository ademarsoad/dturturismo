<?php
include_once("DAOExcursao.php");
include_once("DAOCliente_excursao.php");
include_once("DAOCliente.php");

$dao = new DAOExcursao;
$cl = new DAOCliente;
$ce = new DAOCliente_excursao;

$n = 0;
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
    
</head>

<body>
    <?php
        if(isset($_GET['id_pe']) && !empty($_GET['id_pe']) ) {
            $idexcursao = $_GET['id_pe'];
            $res = $dao->chamaExcursao($idexcursao);
        }
        if(isset($_POST['id_cliente'])) {
            $idDoCliente = $_POST['id_cliente'];
            $idDaExcursao = $_GET['id_pe'];
            $ascento = $_POST['ascento'];
            $quarto = $_POST['quarto'];
            $ce->cadastraClientePasseio($idDoCliente, $idDaExcursao, $ascento, $quarto);
        }

    ?>
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
        <div class="infocliente">
            <p>Titulo da Excursao: <?php echo $res['titulo_excursao'] ?></p>
            <p>Valor da Excursao: <?php echo $res['valor_excursao'] ?></p>
            <p>Data da ida: <?php echo (date_format(date_create("$res[data_excursao_ida]"), 'd/m/Y')) ?></p>
            <p>Data da Volta: <?php echo (date_format(date_create("$res[data_excursao_volta]"), 'd/m/Y')) ?></p>
        </div>
        <div class="form-cliente-excursao">
            <form action="" method="POST">
                <p>Cliente:</p>
                <input type="text" list="minha-lista" name="id_cliente">
                <datalist id="minha-lista" >
                <?php
                    if(isset($_GET['id_pe'])){
                        $rows = $cl->todosClientes();

                        foreach($rows as $row) {
                            ?>
                    
                    <option value="<?php printf("$row[id_cliente]"); ?>" ><?php printf("$row[nome_cliente]"); }}?></option>
                    
                </datalist>
                
                <p>Assento</p>
                <input type="text" name="ascento">
                <p>Quarto</p>
                <input type="text" name="quarto">
                
                <input type="submit" value="Cadastrar">
            </form>
        </div>
        
        <div>
            <table class="clienteTabela">
            <thead>
                <tr>
                    <th>Quantidade</th>
                    <th>Cliente</th>
                    <th>Assento</th>
                    <th>Quarto</th>
                    <th>Pagamentos</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_GET['id_pe'])){
                        $rows = $ce->clientePasseio($idexcursao);
                        foreach($rows as $row) {
                            
                            $n = $n+1;
                         ?>
                         <tr>
                             <td><?php echo $n; ?> </td>
                            <td><?php printf("$row[nome_cliente]");  ?></td>
                            <td><?php printf("$row[ascento]");  ?></td>
                            <td><?php printf("$row[quarto] "); ?></td>
                            <td><a href=""> Verificar Pagamentos</a></td>
                         </tr>
                           

                       <?php } } ?>

            </tbody>

            </table>
        </div>
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
