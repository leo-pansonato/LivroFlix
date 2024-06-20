<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../../../Recursos/book_image2.png">

    <title>Pesquisar</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

	<link href="style.css" rel="stylesheet">

  </head>


<body>

<?php

//Inicia sessão apenas se não estiver iniciada para evitar inumeros erros
if(session_status()==PHP_SESSION_NONE){
	session_start();
}

// Verifica se o usuário está conectado
if (!isset($_SESSION['nome'])) {
	// Se não estiver conectado, redireciona para a página de login
	echo "<script>window.open('../../Sign-in/Sign-in.php','_self')</script>";
}

include_once '../../../conexao.php';


$userName = $_SESSION['nome'];
$imgPerfil = "../../../Recursos/Perfis/".trim($_SESSION['email']).".jpg";
$imgErro = "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Windows_10_Default_Profile_Picture.svg/512px-Windows_10_Default_Profile_Picture.svg.png?20221210150350";

if (isset($_POST["sair"])) {
	session_destroy();
	echo "<script>window.open('../../../Index.html','_self')</script>";
	exit();
}
// Voltar para a HOME
if (isset($_POST["voltar"])) {
	echo "<script>window.open('../pagina_protegida.php','_self')</script>";
}
if (isset($_POST["perfil"])) {
	echo "<script>window.open('../../Perfil/perfil.php','_self')</script>";
}
if (isset($_POST["opcoes"])) {
	echo "<script>window.open('#','_self')</script>";
}

// Inicia as variaveis e define o valor digitado nos campos de texto a elas.
$reescrever_pesquisa = '';
$reescrever_genero = '';
$reescrever_classificacao = '';
if (isset($_GET['pesquisa'])) {
    $reescrever_pesquisa = $_GET['pesquisa'];
}
if (isset($_GET['genero'])) {
  $reescrever_genero = $_GET['genero'];
}
if (isset($_GET['classificacao'])) {
  $reescrever_classificacao = $_GET['classificacao'];
}
?>

<!-- Barra de Navegação -->
<header class="p-1" style="background-color:var(--cor-amarela); width: 110vw; height:80px;">
		<div style="margin-left:3%; margin-right: 3%;">
		  	<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="../pagina_protegida.php" class="nav-link px-2 pt-2"><img src="../../../Recursos/logo2.png" alt="Logo" height="50"></a>
                <aside id="menuOculto" class="menuOculto">
          <button href="javascript:void(0)" class="btnFechar" onclick="fecharNav()">&times;</button>
          <div class="navegacao">
            <form method="POST">
            <div class="navbaritens">
                <i class='bx-fw bx bx-arrow-back'></i>
                <input type="submit" name="voltar" value="Voltar">   
              </div>
              <div class="navbaritens">
                <i class='bx-fw bx bx-slider-alt'></i>
                <input type="submit" name="opcoes" value="Opções">   
              </div>
              <div class="navbaritens">
                <i class='bx-fw bx bx-exit'></i>
                <input type="submit" name="sair" value="Sair">   
              </div>
            </form>
          </div>
        </aside>
        <section id="primario">
          <span style="font-size:40px;cursor:pointer;" onclick="abrirNav()">&#9776;</span>
        </section>
        <script type="text/javascript">
          function abrirNav() {
            document.getElementById("menuOculto").style.width = "250px";
            document.getElementById("menuOculto").style.opacity = "1";
          }
          function fecharNav() {
            document.getElementById("menuOculto").style.width = "0";
            document.getElementById("menuOculto").style.opacity = "0.5";
          }
        </script>
	
		  	</div>
		</div>
	</header>

<div class="principal">
  <form method="GET">
  	<div class="pesquisa"> 
        <div class="search-box">
  	      <input type="text" name="pesquisa" class="search-text" placeholder="Pesquisar..." autocomplete="off" value="<?php echo $reescrever_pesquisa;?>">
            <button type="submit" class="search-btn" title="Pesquisar">
              <img class="loupe-yellow" src="../../../Recursos/loupe-yellow.svg" alt="">
              <img class="loupe-white" src="../../../Recursos/loupe-white.svg" alt="">
            </button>
        </div>
      <div class="filter-box">
  	      <div class="filter-dropdown">
            <div class="select-menu">
              <div class="select-btn">
                  <input type="hidden" class="generoText" name="genero" value="<?php if($reescrever_genero){echo$reescrever_genero;};?>">
                <span class="sBtn-text"><?php if($reescrever_genero){echo$reescrever_genero;}else{echo"Gêneros";};?></span>
                <i class="bx bx-chevron-down"></i>
              </div>
              <ul class="options">
                <?php
                  $generos = array(
                    "Todos","Fantasia", "Ficção", "Mistério", "Ação/Aventura", "Horror", "Romance",
                    "Conto", "Infantil", "Biografia", "Gatronomia", "Arte/Fotografia",
                    "Autoajuda", "História", "Viagem", "Humor", "Tecnologia");
                  
                  foreach ($generos as $genero) {
                    echo "<li class='option'>
                            <span class='option-text'>$genero</span>
                          </li>";
                  }
                ?>
              </ul>
            </div>
            <div class="select-menu">
              <div class="select-btn">
                  <input type="hidden" class="generoText" name="classificacao" value="<?php if($reescrever_classificacao){echo$reescrever_classificacao;};?>">
                <span class="sBtn-text"><?php if($reescrever_classificacao){echo$reescrever_classificacao;}else{echo"Classificação";};?></span>
                <i class="bx bx-chevron-down"></i>
              </div>
              <ul class="options">
                <?php
                  $classificacao = array(
                    "Mais recentes","Mais antigos", "Maior avaliação", "Mais populares");
                  
                  foreach ($classificacao as $classificacao) {
                    echo "<li class='option'>
                            <span class='option-text'>$classificacao</span>
                          </li>";
                  }
                ?>
              </ul>
            </div>
          </div>
          <script>
            const optionMenus = document.querySelectorAll(".select-menu");
                
            optionMenus.forEach(optionMenu => {
              const selectBtn = optionMenu.querySelector(".select-btn");
              const options = optionMenu.querySelectorAll(".option");
              const sBtnText = optionMenu.querySelector(".sBtn-text");
              const filterText = optionMenu.querySelector(".generoText");
            
              selectBtn.addEventListener("click", () => optionMenu.classList.toggle("active"));       
            
              options.forEach(option => {
                option.addEventListener("click", () => {
                  let selectedOption = option.querySelector(".option-text").innerText;
                  sBtnText.innerText = selectedOption;
                  filterText.value = selectedOption;
                  optionMenu.classList.remove("active");
                });
              });
            });
          </script>

            <a class="filter-btn">
              <img class="filter-yellow" src="../../../Recursos/filter-yellow.png" alt="">
              <img class="filter-white" src="../../../Recursos/filter-white.png" alt="">
              <p class="filter-btn-text">Filtro</p>
            </a>
        </div>

        <script type="text/javascript">
          const filterBtn = document.querySelector('.filter-btn');
          const filterDropdown = document.querySelector('.filter-dropdown');
          const filterYellow = document.querySelector(".filter-yellow");
          const filterWhite = document.querySelector(".filter-white");
          const filterBtnText = document.querySelector(".filter-btn-text");
          let pressionado = false;
          filterBtn.addEventListener('click', () => {
            pressionado = !pressionado;
            if (pressionado) {
              filterBtn.classList.toggle("filter-btn-actived");
              filterDropdown.classList.toggle("filter-dropdown-actived");
              filterYellow.style.opacity = "0";
              filterWhite.style.opacity = "1";
              filterBtnText.style.color = "white";
            } else {
              filterBtn.classList.remove("filter-btn-actived");
              filterDropdown.classList.remove("filter-dropdown-actived");
              filterYellow.style.opacity = "";
              filterWhite.style.opacity = "";
              filterBtnText.style.color = "";
            }
          });
        </script>
    </div>
  </form>
   
  
    <?php
    $pesquisa = "%" . trim($_GET['pesquisa']) . "%";
    $genero = isset($_GET['genero']) ? "%" . trim($_GET['genero']) . "%" : null;
    $classificacao = isset($_GET['classificacao']) ? trim($_GET['classificacao']) : null;

    if ($genero === "%%" || $genero === "%Todos%") {
      $genero = null;
    }

    if ($classificacao) {
      if ($classificacao === "Mais recentes") {
        $classificacao = "data DESC";
      } elseif ($classificacao === "Mais antigos") {
        $classificacao = "data ASC";
      } elseif ($classificacao === "Maior avaliação") {
        $classificacao = "(rating / votos) DESC";
      } elseif ($classificacao === "Mais populares") {
        $classificacao = "views DESC";
      } else {
        $classificacao = null;
      }
    }
    
    $query = "
      SELECT livros.titulo, livros.descricao, livros.capa, livros.ID, cadastro.nome AS nome_autor
      FROM livros 
      JOIN cadastro ON livros.autor = cadastro.ID
      WHERE (livros.titulo LIKE '$pesquisa' OR cadastro.nome LIKE '$pesquisa')
    ";

    if ($genero) {
      $query .= " AND livros.genero LIKE '$genero'";
    }
    if ($classificacao) {
      $query .= " ORDER BY $classificacao";
    }

    $resultadoexecutado = mysqli_query($conexao, $query);
    if(mysqli_num_rows($resultadoexecutado)==1){
      $msgresultados = strval(mysqli_num_rows($resultadoexecutado)) . " resultado encontrado";
    }
    else if(mysqli_num_rows($resultadoexecutado)>0){
      $msgresultados = strval(mysqli_num_rows($resultadoexecutado)) . " resultados encontrados";
    }
    else{
      $msgresultados = "Nenhum resultado encontrado";
    }
    echo "
    <div class='total'><i class='bx bx-info-circle'></i>$msgresultados</div>";
  echo"  
  <div class='caixa-resultados'>
    <div class='classe'>
      <p>Comédia</p>
    </div>
    <div class='resultados'>
  ";
    while ($livro = mysqli_fetch_assoc($resultadoexecutado)) {

        echo "
          <div class='py-3 m-3'>
          <a href='../Livro/livro.php?id=".$livro['ID']."'><picture>
                  <img title='".$livro['titulo']."' onerror='".'this.src="../../../Recursos/erro.png";'."' class='imagens' src='../../../Recursos/Capas/".$livro['capa']."'>
                      <figcaption>
                          <span>
                              <h5>".$livro['titulo']."</h5>
                              <p class='fw-light'>".$livro['nome_autor']."</p>
                              ".$livro['descricao']."
                          </span>
                      </figcaption>
              </picture></a>
          </div>
          ";
    }
    ?>
    </div>
  </div>



</div>

</body>
</html>