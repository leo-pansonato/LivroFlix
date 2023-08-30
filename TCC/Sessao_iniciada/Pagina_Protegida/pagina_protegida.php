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
	echo "<script>window.open('../../Sign-in/sign-in.html','_self')</script>";
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
	echo "<script>window.open('../Perfil/perfil.php?id=".$_SESSION['id_user']."','_self')</script>";
}
if (isset($_POST["pesquisa"])) {
	echo "<script>window.open('Pesquisa_resultados/pesquisa_resultados.php?pesquisa=','_self')</script>";
}
?>
	
<div class="p-2 shadow-lg header">
  <div style="margin-left:3%; margin-right: 3%;">
		  <div class="cabecalho">
				
          <div class="nav me-lg-auto justify-content-center" style="margin-right: auto;">
            <a href="pagina_protegida.php" class="nav-link px-2 pt-2"><img src="../../Recursos/logo2.png" alt="Logo" height="50"></a>
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
          <p style="font-size:17px;">Bem-vindo(a), <b style="color:black;"><?php echo $userName;?></b></p>
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
              <div class="navbaritens">
                <i class='bx-fw bx bx-search'></i>
                <input type="submit" name="pesquisa" value="Pesquisar">   
              </div>
              <div class="navbaritens">
                <i class='bx-fw bx bx-user'></i>
                <input type="submit" name="perfil" value="Perfil">   
              </div>
              <div class="navbaritens">
                <i class='bx-fw bx bx-home'></i>
                <input type="submit" name="home" value="Home">   
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
<a href="Livro/livro.php?id=1" class="btn-destaque">
<div class="destaque">
  <div class="destaque-texto">
    <div class="informacoes">
      <div class="titulo">
        NEYMAR - O SONHO BRASILEIRO
      </div>
      <div class="infos">
         <div class="popularidade">
            96% relevante
         </div>
         <div class="data">
            2023
         </div>
         <div class="paginas">
            132 páginas
         </div>
      </div>
      <div class="descricao">
      Se você tivesse de citar o nome do jogador de futebol brasileiro mais famoso hoje em dia, sem dúvida pensaria imediatamente em Neymar.
      </div>
      <div class="autor">
        Peter Banke
      </div>
      <div class="genero">
        Biografia
      </div>
    </div>
  </div>
  <div class="imagem-destaque">
    <img src="https://besthqwallpapers.com/Uploads/12-11-2017/28299/thumb2-neymar-psg-paris-saint-germain-brazilian-football-player-soccer-star.jpg">
    <div class="overlay"></div>
  </div>
</div>
        </a>
<div class="conteudo">

    <div class='caixa mb-3 mt-1' style='font-size:25px; width:95%; position: relative; left: 50%; transform: translate(-50%, 0%);'>
      <div class="titulo">
        <h2>Recomendados</h2>
        <div class="divider"></div>
      </div>
      <div class='principal rounded-3 row align-items-center'>
        
<?php
    //Recebe do banco de dados os livros referentes a classe RECOMENDADOS(futuro)
    $query = "
    SELECT livros.titulo, livros.descricao, livros.capa, livros.ID, cadastro.nome AS nome_autor
    FROM livros 
    JOIN cadastro ON livros.autor = cadastro.ID ORDER BY (rating/votos) DESC
    ";

    $resultadoexecutado = mysqli_query($conexao, $query);
    
    
    //Costrói o html principal da página com os livros já incluidos
    while ($livro = mysqli_fetch_assoc($resultadoexecutado)) {
      echo "
      <div class='col py-3'>
      <a href='Livro/livro.php?id=".$livro['ID']."'><picture>
              <img title='".$livro['titulo']."' onerror='".'this.src="../../Recursos/erro.png";'."' class='imagens' src='../../Recursos/Capas/".$livro['capa']."'>
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
    <div class='caixa mb-3 mt-5' style='font-size:25px; width:95%; position: relative; left: 50%; transform: translate(-50%, 0%);'>
      <div class="titulo">
        <h2>Populares</h2>
        <div class="divider"></div>
      </div>
      <div class='principal rounded-3 row align-items-center'>
        
<?php
    //Recebe do banco de dados os livros referentes a classe RECOMENDADOS(futuro)
    $query = "
    SELECT livros.titulo, livros.descricao, livros.capa, livros.ID, cadastro.nome AS nome_autor
    FROM livros 
    JOIN cadastro ON livros.autor = cadastro.ID ORDER BY views DESC
    ";

    $resultadoexecutado = mysqli_query($conexao, $query);
    
    //Costrói o html principal da página com os livros já incluidos
    while ($livro = mysqli_fetch_assoc($resultadoexecutado)) {
      echo "
      <div class='col py-3'>
      <a href='Livro/livro.php?id=".$livro['ID']."'><picture>
              <img title='".$livro['titulo']."' onerror='".'this.src="../../Recursos/erro.png";'."' class='imagens' src='../../Recursos/Capas/".$livro['capa']."'>
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

  <footer class="shadow-lg">
        <div class="container-footer">
            <div class="row-footer">
                <div class="footer-col">
                    <h4>Empresa</h4>
                    <ul>
                        <li><a href="#"> Quem somos </a></li>
                        <li><a href=""> Nossos serviços </a></li>
                        <li><a href=""> Política de privacidade </a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Obter ajuda</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Suporte Online</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Funcionalidades</h4>
                    <ul>
                        <li><a href="../../Index.html">Home</a></li>
                        <li><a href="Pesquisa_resultados/pesquisa_resultados.php?pesquisa=">Pesquisar</a></li>
                        <li><a href="../Perfil/perfil.php">Perfil</a></li>
                        <li><a href="../Opções/opcoes.php">Configurações</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <div class="medias-socias">
                        <a href="#"> <i class='bx bxl-facebook' ></i> </a>
                        <a href="#"> <i class='bx bxl-instagram' ></i> </a>
                        <a href="#"> <i class='bx bxl-twitter' ></i> </a>
                        <a href="#"> <i class='bx bxl-linkedin'></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>