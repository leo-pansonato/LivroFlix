<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Página Principal</title>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  </head>


<body>
	<?php
		include 'funcoes.php';
	?>

<!-- Barra de Navegação -->
<header class="p-1 text-bg-warning">
		<div style="margin-left:3%; margin-right: 3%;">
		  	<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
				<a href="pagina_protegida.php" class="d-flex align-items-center mb-2 mb-lg-1 text-dark text-decoration-none">
					<img src="../../Recursos/book_image2.png" height="60" style="padding-left: 20px; padding-right: 20px;">
				</a>
	
				<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
			  		<h2><a href="pagina_protegida.php" class="nav-link px-2 pt-2 link-dark">LivroFlix</a></h2>
				</ul>
	
				<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-5" role="search">
			  		<input type="search" class="form-control" placeholder="Pesquisar..." aria-label="Search" style="width: 240px; height: 45px;">
				</form>

        <div class="mx-2 pt-3">
          <p style="font-size:17px;">Bem-vindo(a), <b><?php echo $userName;?></b></p>
        </div>


				<div class="dropdown text-end">
			  		<a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
						<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Windows_10_Default_Profile_Picture.svg/512px-Windows_10_Default_Profile_Picture.svg.png?20221210150350" alt="mdo" width="52" height="52" class="rounded-circle">
			  		</a>
			  		<ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="../Perfil/perfil.php">Perfil</a></li>
						<li><a class="dropdown-item" href="#">Opções</a></li>
						<li><hr class="dropdown-divider"></li>
            <form method="post">
            <li><input type="submit" class="dropdown-item" name="voltar" id="submit" class="submit" value="Home"></li>
						<li><input type="submit" class="dropdown-item" name="sair" id="submit" class="submit" value="Sair"></li>
            </form>
			  		</ul>
				</div>
		  	</div>
		</div>
	</header>





</body>
</html>