<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../../Recursos/book_image2.png">
    <title>Leitura</title>

    <link href="newstyle.css" rel="stylesheet">
    <?php
        //Inicia sessão apenas se não estiver iniciada para evitar inumeros erros
        if(session_status()==PHP_SESSION_NONE){
	        session_start();
        }

        // Verifica se o usuário está conectado
        if (!isset($_SESSION['nome'])) {
	        // Se não estiver conectado, redireciona para a página de login
	        echo "<script>window.open('../../../../Sign-in/Sign-in.php','_self')</script>";
        }

        include_once '../../../../conexao.php';

        $id_user = $_SESSION['id_user'];
        $livroid = $_GET['id'];
        $resultadoexecutado = mysqli_query($conexao, "SELECT `conteudo` FROM `livros` WHERE ID = $livroid");

        while ($data = mysqli_fetch_assoc($resultadoexecutado)) {
            $conteudo = $data['conteudo'];
            
        }

        function getLastPage($conn, $id_user, $id_livro) {
            $resultado = mysqli_query($conn, "SELECT * FROM `lendo` WHERE `id_user` = $id_user and `id_livro` = $id_livro");
            if (mysqli_num_rows($resultado) > 0) {
                $data = mysqli_fetch_assoc($resultado);
                return $data['ultimaPagina'];
            } else {
                return 1;
            }
        }
        
        $lastPage = getLastPage($conexao, $id_user, $livroid) - 1;

        function setLastPage($conn, $id_user, $id_livro, $lastPage) {
            mysqli_query($conn, "UPDATE `lendo` SET `ultimaPagina` = $lastPage + 1 WHERE `id_user` = $id_user and `id_livro` = $id_livro");
        }

    ?>
</head>
<body>
    <input type="checkbox" id="theme-switcher">
    <div id="app-container">
        <div class="theme-switcher-area">
            <label for="theme-switcher" class="theme-switcher-button"></label>
        </div>
        <a href="../../Livro/livro.php?id=<?php echo $livroid;?>">
            <img class="return" id='return_light' src="../../../../Recursos/esquerda_light.png" alt="Voltar">
            <img class="return" id='return_dark' src="../../../../Recursos/esquerda_dark.png" alt="Voltar">
        </a>
        <div id="pages-container">
            <h2 id="pagesText">Página </h2>
        </div>
        <div id="text-container"></div>
        <div id="button-container">
            <button id="previous-button" class="navButton" disabled>Anterior</button>
            <button id="next-button" class="navButton">Próximo</button>
        </div>
    </div>

    <script>
        const themeSwitcher = document.getElementById("theme-switcher");
        const returnDark = document.getElementById("return_dark");
        const returnLight = document.getElementById("return_light");
        var textContainer = document.getElementById("text-container");
        var previousButton = document.getElementById("previous-button");
        var nextButton = document.getElementById("next-button");
        var contadorInput = document.getElementById("contadorInput");
        var pagesText = document.getElementById("pagesText");

        themeSwitcher.addEventListener("change", function() {
        if (this.checked) {
            returnDark.style.opacity = "0";
            returnLight.style.opacity = "1";
        } else {
            returnDark.style.opacity = "1";
            returnLight.style.opacity = "0";
        }
        });

        var text = <?php echo json_encode($conteudo);?>;
        var textParts = [];
        var linesPerPart = 29;
        var currentPart = <?php echo $lastPage;?>;
        var totalParts = Math.ceil(text.split('\n').length / linesPerPart);

        var lines = text.split('\n');
        for (var i = 0; i < lines.length; i += linesPerPart) {
            var part = lines.slice(i, i + linesPerPart);
            textParts.push(part.join('\n'));
        }

        function updateText() {
            textContainer.textContent = textParts[currentPart];
            var currentPage = currentPart + 1;
            pagesText.textContent = "Página " + currentPage + " de " + totalParts;

            previousButton.disabled = currentPart === 0;
            nextButton.disabled = currentPart === totalParts - 1;
        }

        function nextPart() {
            if (currentPart < totalParts - 1) {
                currentPart++;
                updateText();
            }
        }

        function previousPart() {
            if (currentPart > 0) {
                currentPart--;
                updateText();
            }
        }

        nextButton.addEventListener("click", nextPart);
        previousButton.addEventListener("click", previousPart);

        updateText();
    </script>
</body>
</html>
