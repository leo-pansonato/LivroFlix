<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../../Recursos/book_image2.png">

    <title>Página Principal</title>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>	
  <link href="style.css"	rel="stylesheet">
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

include_once '../../conexao.php';


$userName = $_SESSION['nome'];
$imgPerfil = "../../Recursos/Perfis/".trim($_SESSION['email']).".jpg";
$imgErro = "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Windows_10_Default_Profile_Picture.svg/512px-Windows_10_Default_Profile_Picture.svg.png?20221210150350";
	

// SAIR da Conta
if (isset($_POST["sair"])) {
	session_destroy();
	echo "<script>window.open('../../Index.html','_self')</script>";
	exit();
}
// Voltar para a HOME
if (isset($_POST["home"])) {
	echo "<script>window.open('../../Index.html','_self')</script>";
}
if (isset($_POST["perfil"])) {
	echo "<script>window.open('../Perfil/perfil.php','_self')</script>";
}
if (isset($_POST["pesquisa"])) {
	echo "<script>window.open('Pesquisa_resultados/pesquisa_resultados.php?pesquisa=','_self')</script>";
}
?>
	
<div class="p-1 shadow-lg header"style="background-color:var(--cor-secundaria);">
  <div style="margin-left:3%; margin-right: 3%;">
		  <div class="cabecalho">
				<a href="pagina_protegida.php" class="d-flex align-items-center">
					<img title="LivroFlix" src="../../Recursos/book_image2.png" height="60" style="padding-left: 20px; padding-right: 10px;">
				</a>
          <div class="nav me-lg-auto justify-content-center" style="margin-right: auto;">
            <h2><a href="pagina_protegida.php" class="nav-link px-2 pt-3 link-light">LivroFlix</a></h2>
          </div>
          <form method="get" action="Pesquisa_resultados/pesquisa_resultados.php">
            <div class="search-box">
			  	    <input type="text" name="pesquisa" class="search-text" placeholder="Pesquisar..." autocomplete="off">
              <button type="submit" class="search-btn" title="Pesquisar">
                <img class="loupe-yellow" src="../../Recursos/loupe-yellow.svg" alt="">
                <img class="loupe-white" src="../../Recursos/loupe-white.svg" alt="">
              </button>
            </div>
				  </form>
        <div class="mx-2 pt-3 nome">
          <p style="font-size:17px;">Bem-vindo(a), <b style="color:white;"><?php echo $userName;?></b></p>
        </div>

        <div class="dropdown text-end">
			  	<a href="#" class="d-flex d-block link-dark text-decoration-none dropdown-toggle align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="imgperfil">
						  <img src="<?php echo $imgPerfil;?>" onerror="this.src='<?php echo $imgErro;?>';" alt="Perfil">
            </div>
			  	</a>
			  	<ul class="dropdown-menu text-small">
          <form method="post">
            <li><input type="submit" class="dropdown-item" name="perfil" value="Perfil"></li>
						<li><hr class="dropdown-divider"></li>
            <li><input type="submit" class="dropdown-item" name="home" value="Home"></li>
						<li><input type="submit" class="dropdown-item" name="sair" value="Sair"></li>
            </form>
			  	</ul>
				</div>
      
				<aside id="menuOculto" class="menuOculto">
          <div class="imgPerfilMenu">
					  <img src="<?php echo $imgPerfil;?>" onerror="this.src='<?php echo $imgErro;?>';" alt="Perfil">
          </div>
          <div class="navNome">
            <p>Bem-vindo(a), <b><?php echo $userName;?></b></p>
          </div>
          <button href="javascript:void(0)" class="btnFechar" onclick="fecharNav()">&times;</button>
          <div class="navegacao">
            <form method="POST">
              <input type="submit" name="pesquisa" value="Pesquisar...">
              <input type="submit" name="perfil" value="Perfil">
              <input type="submit" name="home" value="Home">
              <input type="submit" name="sair" value="Sair">
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
            document.getElementById("primario").style.marginLeft = "250px";
          }
          function fecharNav() {
            document.getElementById("menuOculto").style.width = "0";
            document.getElementById("menuOculto").style.opacity = "0.5";
            document.getElementById("primario").style.marginLeft = "0";
          }
        </script>
    </div>
  </div>
</div>
<div class="conteudo">
  <div class="tipo">
    <div class='classe text-start mt-5'>
      <h2 class='fw-bold'>RECOMENDADOS
      <div class='barra'></h2>
    </div>
  </div> 
    
    <div class='mb-3 mt-1' style='font-size:25px; width:79%; position: relative; left: 50%; transform: translate(-50%, 0%);'>
      <div class='principal rounded-4 row align-items-center mt-3'>

<?php
    //Recebe do banco de dados os livros referentes a classe RECOMENDADOS(futuro)
    $resultadoexecutado = mysqli_query($conexao, "SELECT titulo, autor, descricao, capa, ID FROM livros ORDER BY (rating/votos) DESC");
    
    //Costrói o html principal da página com os livros já incluidos
    while ($livro = mysqli_fetch_assoc($resultadoexecutado)) {
      echo "
      <div class='col py-3'>
      <a href='Livro/livro.php?id=".$livro['ID']."'><picture>
              <img title='".$livro['titulo']."' onerror='".'this.src="../../Recursos/erro.png";'."' class='imagens' src='../../Recursos/Capas/".$livro['capa']."'>
                  <figcaption>
                      <span>
                          <h5>".$livro['titulo']."</h5>
                          <p class='fw-light'>".$livro['autor']."</p>
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
  
<div class="tipo">
  <div class='classe text-start mt-5'>
    <h2 class='fw-bold'>POPULARES
    <div class='barra'></h2>
  </div>
</div> 
    <div class='mb-3 mt-1' style='font-size:25px; width:79%; position: relative; left: 50%; transform: translate(-50%, 0%);'>
      <div class='principal rounded-4 row align-items-center mt-3'>

<?php 
    //Recebe do banco de dados os livros referentes a classe POPULARES(futuro)
    $resultadoexecutado = mysqli_query($conexao, "SELECT titulo, autor, descricao, capa, ID FROM livros ORDER BY views DESC");
    
    //Costrói o html principal da página com os livros já incluidos
    while ($livro = mysqli_fetch_assoc($resultadoexecutado)) {
      echo "
      <div class='col py-3'>
      <a href='Livro/livro.php?id=".$livro['ID']."'><picture>
              <img title='".$livro['titulo']."' onerror='".'this.src="../../Recursos/erro.png";'."' class='imagens' src='../../Recursos/Capas/".$livro['capa']."'>
                  <figcaption>
                      <span>
                          <h5>".$livro['titulo']."</h5>
                          <p class='fw-light'>".$livro['autor']."</p>
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


  <footer class="shadow-lg">
        <div class="container-footer">
            <div class="row-footer">
                <!-- footer col-->
                <div class="footer-col">
                    <h4>Empresa</h4>
                    <ul>
                        <li><a href="#"> Quem somos </a></li>
                        <li><a href=""> Nossos serviços </a></li>
                        <li><a href=""> Política de privacidade </a></li>
                    </ul>
                </div>
                <!--end footer col-->
                <!-- footer col-->
                <div class="footer-col">
                    <h4>Obter ajuda</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Suporte Online</a></li>
                    </ul>
                </div>
                <!--end footer col-->
                <!-- footer col-->
                <div class="footer-col">
                    <h4>Funcionalidades</h4>
                    <ul>
                        <li><a href="../../Index.html">Home</a></li>
                        <li><a href="Pesquisa_resultados/pesquisa_resultados.php?pesquisa=">Pesquisar</a></li>
                        <li><a href="../Perfil/perfil.php">Perfil</a></li>
                        <li><a href="../Opções/opcoes.php">Configurações</a></li>
                    </ul>
                </div>
                <!--end footer col-->
                <!-- footer col-->
                <div class="footer-col">
                    <div class="medias-socias">
                        <a href="#"> <i class='bx bxl-facebook' ></i> </a>
                        <a href="#"> <i class='bx bxl-instagram' ></i> </a>
                        <a href="#"> <i class='bx bxl-twitter' ></i> </a>
                        <a href="#"> <i class='bx bxl-linkedin'></i> </a>
                    </div>
                </div>
                <!--end footer col-->
            </div>
        </div>
    </footer>

</body>
</html>