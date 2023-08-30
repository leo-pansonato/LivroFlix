<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="shortcut icon" href="../../../../Recursos/book_image2.png">
        <title>Leitura</title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	    <link href="style.css"	rel="stylesheet">

        <?php
            if(session_status()==PHP_SESSION_NONE){
                session_start();
            }
        
            // Verifica se o usuário está conectado
            if (!isset($_SESSION['nome'])) {
                // Se não estiver conectado, redireciona para a página de login
                echo "<script>window.open('../../Sign-in/Sign-in.php','_self')</script>";
            }

            $_SESSION['tema'] = "dark";

            if(isset($_POST['switchTema'])){   
                $_SESSION['tema'] = "light";
            }

            if($_SESSION['tema'] == "escuro"){
                $bgcolorprimary="black";
                $bgcolorsecundary="black";
                $txtcolor="white";
                $btncolor="white";
            }
            else if($_SESSION['tema'] == "claro"){
                $bgcolorprimary="white";
                $bgcolorsecundary="white";
                $txtcolor="black";
                $btncolor="black";
            }
            
            // Conexão com o banco de dados
            $sv_nome = "localhost";
            $sv_usuario = "root";
            $sv_senha = "";
            $bd_name = "LIVRO";

            $conexao = mysqli_connect($sv_nome, $sv_usuario, $sv_senha, $bd_name);
            if (!$conexao) {
                die("Conexão falhou: " . mysqli_connect_error());
            }

            $livroid = $_GET['id'];
            $resultadoexecutado = mysqli_query($conexao, "SELECT `conteudo` FROM `livros` WHERE ID = '$livroid'");

            while ($livro = mysqli_fetch_assoc($resultadoexecutado)) {
                $conteudo = $livro['conteudo'];
            }
            mysqli_close($conexao);
            $linhas_por_pagina = 33;
            $caracteres_por_linha = 170;
            $linhas_total = substr_count($conteudo, "\n");
            $ultima_pagina = ceil($linhas_total / $linhas_por_pagina);

            if (isset($_GET['page'])) {
                $pagina_atual = $_GET['page'];
            } else {
                $pagina_atual = 1;
            }

            $inicio = ($pagina_atual - 1) * $linhas_por_pagina;
            $linhas_pagina = array_slice(explode("\n", wordwrap($conteudo, $caracteres_por_linha)), $inicio, $linhas_por_pagina);
        ?>

    </head>
<body style="background-color:<?php echo $bgcolorprimary;?>; color:<?php echo $txtcolor;?>;">
    
       
            <input type="checkbox" id="theme-switcher">
            <div id="app-container">
                <div class="theme-switcher-area">
                    <label for="theme-switcher" class="theme-switcher-button"></label>
                </div>
                
                <div class="container text-center titlepage">
                
            <a href="../../Livro/livro.php?id=<?php $livroid = $_GET['id']; echo $livroid;?>"><input type='button' class="btn btn-outline-secondary btnHome" value="Voltar"></a>
                 
        <form action="" method="get">
            <input type=hidden name='id' value='<?php echo $livroid;?>'>
            <h2>Página <input type="text" name='page' class="pagecont text-center" value="<?php echo $pagina_atual;?>"> de <?php echo $ultima_pagina;?></h2>
        </form>
    </div>
    <div class="container conteudo">
        <?php echo '<p>' . nl2br(implode("\n", $linhas_pagina)) . '</p>'; ?>
    </div>
        <br>
        <div class = "text-center navegacao container pt-4">
            <a href="?id=<?php echo $livroid; ?>&page=<?php if($pagina_atual == 1){ echo $pagina_atual;}else{ echo $pagina_atual - 1;} ;?>"><input type="button" class="btn btn-outline-secondary back"></a>
            <a href="?id=<?php echo $livroid; ?>&page=<?php if($pagina_atual == $ultima_pagina){echo $pagina_atual;}else{ echo $pagina_atual + 1;};?>"><input type="button" class="btn btn-outline-secondary next"></a>
            
        </div> 
            </div>
        
</body>