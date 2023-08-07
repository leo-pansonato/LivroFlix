<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../../Recursos/book_image2.png">


    <title>Perfil</title>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	
	<link href="style.css"	rel="stylesheet">

<?php
	include_once '../../conexao.php';

	if(session_status()==PHP_SESSION_NONE){
    	session_start();
	}

	$imgPerfil = "../../Recursos/Perfis/".trim($_SESSION['email']).".jpg";
	$imgErro = "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Windows_10_Default_Profile_Picture.svg/512px-Windows_10_Default_Profile_Picture.svg.png?20221210150350";
?>

  </head>


<body>




	<div class="principal container bg-white rounded-3 font-type shadow-lg m-auto text-center"style="width: 900px;">
	<div class="mt-3 mb-4"> 
			<a href="../Pagina_Protegida/pagina_protegida.php"><button type="button" class="btn btn-sm btn-outline-secondary">Voltar</button></a>
    	</div>
    
		<div class="fs-4 mt-4">
			<b><?php echo $_SESSION['nome'];?></b>
			<p class="fw-light"><?php echo $_SESSION['email'];?></p>
		</div>
    
		<div class="imgperfil">
			<img src="<?php echo $imgPerfil;?>" onerror="this.src='<?php echo $imgErro;?>';" alt="Perfil">
        </div>

		<form method="POST" enctype="multipart/form-data">
			<input type="file" name="upload" accept="image/*">
			<input type="submit" class="btn btn-sm btn-outline-secondary" value="Enviar Imagem">
			<div class="errorInfo lead" id="avisoClear">*Selecione uma Imagem!</div>
			<div class="errorInfo lead" id="avisoExtension">*Formato de Imagem não suportado, apenas ".JPG"!</div>
			<div class="text-success lead" id="avisoSuccess">Imagem enviada com Sucesso!</div>
		</form>
		<br><br><br>
		<div class="mt-2"> 
			<a href="Alterar_Dados/alterar.php"><button type="button" class="btn btn-sm btn-outline-secondary">Alterar Dados Pessoais</button></a>
    	</div>
		
		<div class="skill">
			<div class="outer">
				<div class="inner">
					<div id="number">
					</div>
				</div>
			</div>
			<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="160px" height="160px">
         		<defs>
            		<linearGradient id="GradientColor">
               			<stop offset="0%" stop-color="#e91e63"/>
               			<stop offset="100%" stop-color="#673ab7"/>
            		</linearGradient>
         		</defs>
         		<circle cx="80" cy="80" r="70" stroke-linecap="round"/>
 			</svg>
		</div>
		<script>
			let number = document.getElementById("number");
			let conter = 0;
			setInterval(() => {
				if(conter == 65){
					clearInterval();
				}
				else{
					conter++;
					number.innerHTML = conter + "%";
				}
			}, 30)
		</script>
<div class="minhasLeituras">
		<?php
    //Recebe do banco de dados os livros referentes a classe RECOMENDADOS(futuro)
    $resultadoexecutado = mysqli_query($conexao, "SELECT titulo, autor, descricao, capa, ID FROM livros");
    
    //Costrói o html principal da página com os livros já incluidos
    while ($livro = mysqli_fetch_assoc($resultadoexecutado)) {
      echo "
      <div class='col py-3'>
      	<a href='../Pagina_Protegida/Livro/livro.php?id=".$livro['ID']."'>
	  		<picture>
              <img title='".$livro['titulo']."' onerror='".'this.src="../../Recursos/erro.png";'."' class='imagens' src='../../Recursos/Capas/".$livro['capa']."'>
          	</picture>
		</a>
		<div class='informacoes'>
			<div class='titulo'>
				".$livro['titulo']."
			</div>
			<div class='skill'>
			<div class='outer'>
				<div class='inner'>
					<div id='number'>
					</div>
				</div>
			</div>
			<svg xmlns='http://www.w3.org/2000/svg' version='1.1' width='160px' height='160px'>
         		<defs>
            		<linearGradient id='GradientColor'>
               			<stop offset='0%'' stop-color='#e91e63'/>
               			<stop offset='100%' stop-color='#673ab7'/>
            		</linearGradient>
         		</defs>
         		<circle cx='80' cy='80' r='70' stroke-linecap='round'/>
 			</svg>
		</div>
		</div>
      </div>
      ";
    }
?>
		</div>
	</div>


	<?php

if(session_status()==PHP_SESSION_NONE){
    session_start();
}

if (!isset($_SESSION['nome'])) {
	header('Location: ../../Sign-in/Sign-in.php');
	exit();
}
	
//upload
if(isset($_FILES['upload'])){
    $extensao = strtolower(substr($_FILES['upload']['name'],-4));
    if($extensao==".jpg"){
        $novo_name = $_SESSION['email'] . $extensao; 
        $caminho_pasta = '../../Recursos/Perfis/'; 
        move_uploaded_file($_FILES['upload']['tmp_name'], $caminho_pasta.$novo_name); 
        header('Location: perfil.php');
    }else if($extensao==""){
        echo "<script>document.getElementById('avisoClear').style.display='block';</script>";
    }
    else{
        echo "<script>document.getElementById('avisoExtension').style.display='block';</script>";
    }
} 
?>


</body>
</html>