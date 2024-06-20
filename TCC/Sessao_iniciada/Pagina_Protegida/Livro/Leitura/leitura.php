<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../../Recursos/book_image2.png">
    <title>Leitura</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="style.css" rel="stylesheet">

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

        if(mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM `lendo` WHERE `id_user`=$id_user and `id_livro`=$livroid")) == 0){
            $query = "INSERT INTO `lendo`(`id_user`, `id_livro`, `ultimaPagina`, `ultima_vez`) VALUES ('$id_user','$livroid', '1', current_timestamp())";
            mysqli_query($conexao, $query);
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
        $(document).ready(function() {
            const themeSwitcher = $("#theme-switcher");
            const returnDark = $("#return_dark");
            const returnLight = $("#return_light");
            const textContainer = $("#text-container");
            
            const previousButton = $("#previous-button");
            const nextButton = $("#next-button");
            const contadorInput = $("#contadorInput");
            const pagesText = $("#pagesText");

            themeSwitcher.on("change", function() {
                if (this.checked) {
                    returnDark.css("opacity", "0");
                    returnLight.css("opacity", "1");
                } else {
                    returnDark.css("opacity", "1");
                    returnLight.css("opacity", "0");
                }
            });
            
            //var ContainerHeight = textContainer.clientHeight;
            //console.log(ContainerHeight);
            var maxLinesHeight = 630/28.125;
            console.log(maxLinesHeight);
            var text = <?php echo json_encode($conteudo);?>;
            var textParts = [];
            var linesPerPart = maxLinesHeight;
            var currentPart = <?php echo $lastPage;?>;
            var totalParts = Math.ceil(text.split('\n').length / linesPerPart);

            var lines = text.split('\n');
            for (var i = 0; i < lines.length; i += linesPerPart) {
                var part = lines.slice(i, i + linesPerPart);
                textParts.push(part.join('\n'));
            }

            function updateText() {
                textContainer.text(textParts[currentPart]);
                var currentPage = currentPart + 1;
                pagesText.text("Página " + currentPage + " de " + totalParts);

                previousButton.prop("disabled", currentPart === 0);
                nextButton.prop("disabled", currentPart === totalParts - 1);

                const Data = new FormData();
                Data.append("id_session", "<?php echo $id_user;?>");
                Data.append("id_livro", "<?php echo $livroid;?>");
                Data.append("current_page", currentPart+1);

                $.ajax({
                    url: "setlastpage.php",
                    type: "POST",
                    data: Data,
                    processData: false,
            		contentType: false,

                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.log("Error:", error);
                    }
                });
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

            nextButton.on("click", nextPart);
            previousButton.on("click", previousPart);

            updateText();
        });
    </script>
</body>
</html>

</body>
</html>
