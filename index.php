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
       
</head>

<body>
    <header class="cabecalho">
        <a href="index.php">
            <img src="img/Logo-DED-Tur-colorida%5B108%5D-150x150.png" class="navegacao-topo-logo">
        </a>
        <input type="checkbox" id="check">
        <label for="check" class="check-label">
            <img src="img/icone.png" class="check-img">
        </label>
        <nav class="navegacao">
            <ul class="navegacao-lista">
                <li><a href="index.php">Home</a></li>
                <li><a href="excursao.html">Excursões</a></li>
                <li><a href="bateevolta.html">Bate e Volta</a></li>
                <li><a href="sobrenos.html">Sobre Nós</a></li>

            </ul>
        </nav>
    </header>
    <section class="underslide">
        <!--<img class="imgcentral" src="img/imagens.php.png" alt="Porto de galinhas"> -->
        <div class="slideshow-container">

            <div class="mySlider fade">
                
                <img src="img/a22367_72555d2abcd547f290daff9e56b3b5f7~mv2.jpg_srz_1920_750_85_22_0.50_1.20_0.00_jpg_srz.jpg" style="width: 100%; border-radius: 10px;">
                <div class="text">Caption One</div>
            </div>

            <div class="mySlider fade">
                
                <img src="img/imagens.php.png" style="width: 100%; border-radius: 10px;">
                <div class="text">Caption Two</div>
            </div>

            <div class="mySlider fade">
                
                <img src="img/imagens2.png" style="width: 100%; border-radius: 10px;">
                <div class="text">Caption Three</div>
            </div>
        </div>
        <br>
        <div style="text-align: center">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>  

    </section>
    <section>
        <div class="sessaoprincipal">
            <?php

            include_once("class/Conexao.php");
            
            $query = $conn->prepare("SELECT * FROM excursao");

            $query->execute();
            
            $rows = $query->fetchAll();
            
            foreach ($rows as $row) {
                $link = $row['titulo_excursao'];
                    if($row['excursao_valida'] == 1){
            ?>
                <div class="sessaoprincipal-div ">
                    <img class="imagem-article" src="img/<?php printf("$row[titulo_excursao]") ?>.jpg">

                    <h2><?php printf("$row[titulo_excursao]") ?> </h2>
                    <h3>Data de Ida: <?php printf(date_format(date_create("$row[data_excursao_ida]"), 'd/m/Y')) ?> <br /> Data de Volta: <?php printf(date_format(date_create("$row[data_excursao_volta]"), 'd/m/Y')) ?></h3>
                    <p class="desc-inform">
                        <?php printf(html_entity_decode("$row[intro_excursao]")) ?>
                    </p>
                    
                    <a href="<?php printf (str_replace(" ", "", $link)) ?>.php">
                        <p>Continue Lendo...</p>
                    </a>
                </div>

            <?php }} ?>
        </div>
    </section>
    <hr>
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


    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlider");
            let dots = document.getElementsByClassName("dot");

            for(i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if(slideIndex > slides.length) {slideIndex = 1}
            for(i = 0; i< dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 2000);
        }

    </script>
</body>

</html>