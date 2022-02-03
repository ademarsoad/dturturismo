<?php

include_once("DAOUsuario.php");

$u = new DAOUsuario;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/logar.css">
    <link rel="stylesheet" href="css/normalize.css">


</head>

<body>

    <section class="logar">
        <form method="POST">
            <img>
            <fieldset>
                <legend>Logar no Site</legend>
                <input type="text" id="log" name="email" placeholder="Usúario" />
                <input type="password" id="senha" name="senha" placeholder="Senha" />
                <input type="submit" value="Entrar" />
            </fieldset>
        </form>
    </section>
    <?php
    if (isset($_POST['email'])) {
        $usuario = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        if (!empty($usuario) && !empty($senha)) {

            if ($u->logar($usuario, $senha)) {
                header("location: cadastrocliente.php");
            } else {
    ?>
                <div class="msg-erro">
                    Email e/ou senha estão incorretos!
                </div>

            <?php
            }
        } else {
            ?>
            <div class="msg-erro">
                Preencha todos os campos
            </div>

    <?php
        }
    }

    ?>
</body>

</html>