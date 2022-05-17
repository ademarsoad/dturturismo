<?php
include_once("DAOExcursao.php");
include_once("DAOCliente_excursao.php");
include_once("DAOCliente.php");
include_once("DAOPagamento.php");

$dao = new DAOExcursao;
$cl = new DAOCliente;
$ce = new DAOCliente_excursao;
$pag = new DAOPagamento;

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
    <link rel="stylesheet" media="print" href="css/print.css">
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

        .circulo {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 1px solid black;
        }
    </style>

</head>

<body>
    <?php
   
    if (isset($_GET['id_pe']) && !empty($_GET['id_pe'])) {
        $idexcursao = $_GET['id_pe'];
        $res = $dao->chamaExcursao($idexcursao);
        
    }
    if(isset($_POST['ascento'])) {
            if(isset($_GET['id_upcli']) && !empty($_GET['id_upcli'])) {
                echo "Atualizar <br>";
                $iddopagamento = $_POST['idpagamento'];
                $idDoCliente = $_GET['id_upcli'];
                $idDaExcursao = $_GET['id_upexc'];
                $forma = $_POST["forma_pagamento"];
                $total = $_POST["valor_total"];
                $parcela = $_POST["quant_parcela"];
                $ascento = $_POST['ascento'];
                $quarto = $_POST['quarto'];

                $pag->alterarPagameto($iddopagamento, $parcela, $total, $forma); 
                $ce->editarPasseio($idDoCliente, $idDaExcursao, $ascento, $quarto);
                
            } else {
                echo "Cadastrar";
               
                $idDoCliente = $_POST['id_cliente'];
                $idDaExcursao = $_GET['id_pe'];
                $ascento = $_POST['ascento'];
                $quarto = $_POST['quarto'];
                $forma = $_POST["forma_pagamento"];
                $total = $_POST["valor_total"];
                $parcela = $_POST["quant_parcela"];
                $pag->pagarExcursao($forma, $total, $parcela, $idDaExcursao, $idDoCliente);
                $ce->cadastraClientePasseio($idDoCliente, $idDaExcursao, $ascento, $quarto);
                header("Refresh:0"); 
    }
}
    if (isset($_GET['id_upcli']) && isset($_GET['id_upexc'])) {
        $clienteidcliente = $_GET['id_upcli'];
        $excursaoidexcursao = $_GET['id_upexc'];
        $ret = $ce->chamarPasseio($clienteidcliente, $excursaoidexcursao);
        $retorno = $pag->todosPagamentos($clienteidcliente, $excursaoidexcursao);
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
            <form action="" method="POST" class="cadastro">
                <p>Cliente:</p>
                <input type="text" list="minha-lista" name="id_cliente">
                <datalist id="minha-lista">
                    <?php
                    if (isset($_GET['id_pe'])) {
                        $rows = $cl->todosClientes();

                        foreach ($rows as $row) {
                    ?>

                            <option value="<?php printf("$row[id_cliente]"); ?>"><?php printf("$row[nome_cliente]");
                                                                                }
                                                                            } ?></option>

                </datalist>

                <p>Assento</p>
                <input type="text" name="ascento" value="<?php if (isset($ret)) {
                                                                echo $ret['ascento'];
                                                            } ?>">
                <p>Quarto</p>
                <input type="text" name="quarto" value="<?php if (isset($ret)) {
                                                            echo $ret['quarto'];
                                                        } ?>">
                <fieldset>
                    <legend>Formas de pagamentos</legend>
                    <label for="forma">Forma de Pagamento</label>
                    <select id="forma_pagamento" name="forma_pagamento">
                        <option></option>
                        <option value="dinheiro">Dinheiro</option>
                        <option value="cartao">Cartão</option>
                        <option value="pix">PIX</option>
                        <option value="boleto">Boleto</option>
                    </select>
                    <input type="hidden" name="idpagamento" value="<?php if (isset($retorno)) {
                                                                                echo $retorno['idpagamento'];
                                                                            } ?>" >
                    <label for="val">Valor Total</label>
                    <input type="text" id="val" name="valor_total" value="<?php if (isset($retorno)) {
                                                                                echo $retorno['valor_total'];
                                                                            } ?>">
                    <label for="parcela">Quantidade de Parcelas</label>
                    <input type="text" id="parcela" name="quant_parcela" value="<?php if (isset($retorno)) {
                                                                                    echo $retorno['quant_parcelas'];
                                                                                } ?>">
                </fieldset>
                <input type="submit" value="<?php if (isset($ret)) {
                                                echo "Atualizar";
                                            } else {
                                                echo "Cadastrar";
                                            } ?>">
            </form>
        </div>

        <div>
            <table class="clienteTabela">
                <thead>
                    <tr>
                        <th>Quantidade</th>
                        <th>Cliente</th>
                        <th>R.G</th>
                        <th>Assento</th>
                        <th>Quarto</th>
                        <th></th>
                        <th class="tabela_campo">Pagamentos</th>
                        

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['id_pe'])) {
                       
                        $rows = $ce->clientePasseio($idexcursao);
                        foreach ($rows as $row) {
                            $pegaidcliente = $row['id_cliente'];
                            $n = $n + 1;
                            $fundo = $pag->tudoPago($pegaidcliente, $_GET['id_pe']);

                    ?>
                            <tr>
                            
                                <td><?php echo $n; ?> </td>
                                <td><?php printf("$row[nome_cliente]");  ?></td>
                                <td><?php printf("$row[rg_cliente]");  ?></td>
                                <td><?php printf("$row[ascento]");  ?></td>
                                <td><?php printf("$row[quarto] "); ?></td>
                                <td class="tabela_campo"><a href="paginaexcursao.php?id_pe=<?php echo $_GET['id_pe'] ?> && id_upcli=<?php echo $row["id_cliente"] ?> && id_upexc=<?php echo $row["id_excursao"] ?> ">Editar</a> </td>
                                <td class="tabela_campo">
                                    <!-- <a href="recebidos.php?id_paga=<?php echo $row["id_cliente"] ?> && id_exc=<?php echo $row["id_excursao"] ?> "> Pagamentos</a> -->
                                    <button class="circulo" onclick="location.href='recebidos.php?id_paga=<?php echo $row["id_cliente"] ?> && id_exc=<?php echo $row["id_excursao"] ?>' " style="background-color: <?php echo $fundo ?>;">
                                </td>
                                
                            </tr>

                    <?php } }  ?>

                </tbody>

            </table>
            <input type="submit" onclick="window.print()" value="Imprimir Tabela" class="btn-imprimi">
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