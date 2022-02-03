<?php
include_once("DAOExcursao.php");

$dao = new DAOExcursao;

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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <title>DED Turismo</title>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/adapters/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('textarea#descricao').ckeditor();
        });
    </script>
    <script src="js/validandoExcursao.js" defer></script>
    <style>
        input[type="radio"] {
            width: 40px;
            display: inline;
            right: 100%;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST["titulo"])) {
        if (isset($_GET['id_up']) && !empty($_GET['id_up'])) {
            $tituloExcursao = $_POST["titulo"];
            $desc_excursao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
            $valorExcursao = $_POST["valor"];
            $dataIda = $_POST["dataIda"];
            $dataVolta = $_POST["dataVolta"];
            $check = $excursao_valida = $_POST["checkValido"];
            $introExcursao = $_POST["intro"];
            $dao->atualizaExcursao($_GET['id_up'], $tituloExcursao, $desc_excursao, $valorExcursao, $dataIda, $dataVolta, $check, $introExcursao);
        } else if (!empty($_POST["titulo"]) && !empty($_POST["descricao"])) {
            $dao->cadastroExcursao();
        }
    }
    if (isset($_GET['id_up']) && !empty($_GET['id_up'])) {
        $idExcursao = $_GET['id_up'];
        echo $idExcursao;
        $res = $dao->chamaExcursao($idExcursao);
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
            <legend>Cadastro de Excursão</legend>
            <form action="" method="POST" class="cadastro">
                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" value="<?php if (isset($res)) {
                                                                        echo $res['titulo_excursao'];
                                                                    } ?>" autofocus required>
                <label for="intro">Introdução</label>
                <input type="text" id="intro" name="intro" value="<?php if (isset($res)) {
                                                                        echo $res['intro_excursao'];
                                                                    } ?>">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" style="width: 100%;" placeholder="Descrição da excursão">
            <?php if (isset($res)) {
                echo $res['desc_excursao'];
            } ?>
            </textarea>
                <label for="dataIda">Data de Ida:</label>
                <input type="date" id="dataIda" name="dataIda" value="<?php if (isset($res)) {
                                                                            echo $res['data_excursao_ida'];
                                                                        } ?>">
                <label for="dataVolta">Data de Volta:</label>
                <input type="date" id="dataVolta" name="dataVolta" value="<?php if (isset($res)) {
                                                                                echo $res['data_excursao_volta'];
                                                                            } ?>">
                <label for="valor">Valor:</label>
                <input type="text" id="valor" name="valor" value="<?php if (isset($res)) {
                                                                        echo $res['valor_excursao'];
                                                                    } ?>">
                <label for="valido">Ativo</label>
                <input type="radio" id="valido" name="checkValido" value="1" <?php if (isset($res['excursao_valida'])) {
                                                                                    echo ($res['excursao_valida']) == 1 ? 'checked' : '';
                                                                                }   ?> />
                <label for="finalizado">Finalizado</label>
                <input type="radio" id="finalizado" name="checkValido" value="0" <?php if (isset($res['excursao_valida'])) {
                                                                                        echo ($res['excursao_valida']) == 0 ? 'checked' : '';
                                                                                    }  ?>>


                <input type="submit" value="<?php if (isset($res)) {
                                                echo "Atualizar";
                                            } else {
                                                echo "Cadastrar";
                                            }  ?>">
            </form>
        </fieldset>
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