<?php

include_once("DAOCliente.php");

$dao = new DAOCliente;

session_start();
if(!isset($_SESSION['id_usuario'])){
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/ValidandoFormulario.js" defer></script>

    <title>DED Turismo</title>
    
</head>


<body>

    <?php
        if(isset($_POST["nome"])){
            if(isset($_GET['id_up']) && !empty($_GET['id_up'])) {
                $nomeUp = $_POST['nome'];
                $telUp = $_POST['tel'];
                $endUp = $_POST['end'];
                $emailUp = $_POST['email'];
                $cpfUp = $_POST['cpf'];
                $rgUp = $_POST['rg'];
                $dataUp = $_POST['data_nasc'];
                $dao->atualizarDados($_GET['id_up'], $nomeUp, $telUp, $emailUp, $cpfUp, $rgUp, $dataUp, $endUp);

            }else if(!empty($_POST["nome"]) && !empty($_POST["email"])) {   
                $dao->cadastroCliente();
                     
        }
    }
        if(isset($_GET['id_up']) && !empty($_GET['id_up']) ) {
            $idCliente = $_GET['id_up'];
            echo $idCliente;
            $res = $dao->chamaCliente($idCliente);
        }

    ?>
    <header class="cabecalho">
        <img src="img/Logo-DED-Tur-colorida%5B108%5D-150x150.png" class="navegacao-topo-logo">
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
        <fieldset>
            <legend>Cadastro de Cliente</legend>
            <form action="" name="meuForm" method="POST" class="cadastro">
                <label for="nome">Nome do Cliente</label>
                <input type="text" id="nome" name="nome" value="<?php if (isset($res)) {
                                                                echo $res['nome_cliente'];
                                                            } ?>" required>
                <label for="tel">Telefone</label>
                <input type="tel" id="tel" name="tel" value="<?php if (isset($res)) {
                                                                echo $res['tel_cliente'];
                                                            } ?>">
                <label for="end">Endereço</label>
                <input type="text" id="end" name="end" value="<?php if (isset($res)) {
                                                                echo $res['end_cliente'];
                                                            } ?>">
                <label for="email">Email do Cliente</label>
                <input type="email" id="email" name="email" placeholder="exemplo@yahoo.com.br" value="<?php if (isset($res)) {
                                                                echo $res['email_cliente'];
                                                            } ?>">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" maxlength="11" minlength="11" value="<?php if (isset($res)) {
                                                                echo $res['cpf_cliente'];
                                                            } ?>">
                <label for="rg">R.G:</label>
                <input type="text" id="rg" name="rg" value="<?php if (isset($res)) {
                                                                echo $res['rg_cliente'];
                                                            } ?>" required>
                <label for="data_nasc">Data Nacimento</label>
                <input type="date" id="data_nasc" name="data_nasc" value="<?php if (isset($res)) {
                                                                echo $res['data_nasc'];
                                                            } ?>" required>

                <input type="submit" value="<?php if (isset($res)) {
                                            echo "Atualizar";
                                        } else {
                                            echo "Cadastrar";
                                        }  ?>" onclick="validaEmail()">
            </form>
        </fieldset>
    </section>

    <footer class="rodape clearfix">
        <div class="rodape-coluna ">
            <h2 class="rodape-titulo">Midias Sociais</h2>
            <ul class="navegacao-lista">
                <li><a class="rodape-links" href="https://www.instagram.com/dtur_turismo/" target="_blanck">Instagram
                    </a></li>
                <li><a class="rodape-links" href="#">YouTube</a></li>
                <li><a class="rodape-links" href="#">Facebook</a></li>
                <li><a class="rodape-links" href="#">WhatsApp</a></li>
            </ul>

        </div>

        <div class="rodape-coluna ">
            <div>
                <img src="img/Logo-DED-Tur-colorida%5B108%5D-150x150.png" class="navegacao-topo-logo">
                <p>Somos uma agência de viagens, com o objetivo de proporcionar experiências incríveis através de
                    excursões personalizadas e completas. </p>
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