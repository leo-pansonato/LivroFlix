<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../../../Recursos/book_image2.png">
    <title>Pesquisar</title>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

	<link href="style.css" rel="stylesheet">

<?php 
//Inicia sessão apenas se não estiver iniciada para evitar inumeros erros
if(session_status()==PHP_SESSION_NONE){
session_start();
}
// Verifica se o usuário está conectado
if (!isset($_SESSION['nome'])) {
// Se não estiver conectado, redireciona para a página de login
header('Location: ../../../Sign-in/Sign-in.php');
exit();
}

include_once '../../../conexao.php';

// Inicia as variaveis e define o valor digitado nos campos de texto a elas.
$reescrever_pesquisa = '';
if (isset($_GET['pesquisalivro'])) {
    $reescrever_pesquisa = $_GET['pesquisalivro'];
}

$livroid = $_GET["id"]; //Obtém o ID do livro presente no endereço da página

if(isset($_POST['btnler'])){
  ler($livroid, $conexao);
}

function ler($id, $conn){
  mysqli_query($conn,"UPDATE livros SET views = views + 1 WHERE ID = '$id'");
  echo "<script>window.open('../Livro/Leitura/leitura.php?id=$id','_self')</script>";
  
}

$resultadoexecutado = mysqli_query($conexao, "SELECT `titulo`, `autor`, `descricao`, `capa`, `data`, `rating`, `votos`, `views` FROM `livros` WHERE ID = '$livroid'");
?>

</head>
<body>

<div class="principal">
  <div class="navegacao">
    <a href="../pagina_protegida.php">
      <img class="return" id='return_dark' src="../../../Recursos/esquerda_dark.png" alt="Voltar">
    </a>
  </div>
  <div class='informacoes'>

<?php
while ($livro = mysqli_fetch_assoc($resultadoexecutado)) {
    echo "
        <img title='".$livro['titulo']."' onerror='".'this.src="../../../Recursos/erro.png";'."' class='capa' src='../../../Recursos/Capas/".$livro['capa']."'>
        <div class='detalhes'>
          <h5 class='titulo'>".$livro['titulo']."</h5>
          <p class='fw-light autor'>".$livro['autor']."</p>
          <p class='fw-light data'>".$livro['data']."</p>
          <div class='estats'>
            <div class='rating'>";
            if($livro['rating']!=0 || $livro['votos']!=0){
              $rating = intval($livro['rating']/$livro['votos']);
            }
            else{
              $rating=0;
            }
            if($rating>5){
              $rating=5;
            }	
            for ($i=0; $i < $rating; $i++) { 
              echo"
                <img class='star' src='../../../Recursos/star.png'>";
            }
            for ($i=$rating; $i < 5; $i++) {
              echo"
                <img class='star graystar' src='../../../Recursos/star-gray.png'>";
            }
          echo "
            </div>
            <p class='views'>".$livro['views']." visualizações</p>
          </div>
        </div>
      </div>
      <div class='descricao'>
        <p class='paragrafo'>".$livro['descricao']."</p>";
}
?>
  </div>
  <div class='botoes'>
    <form method="post">
      <input type="submit" name="btnler" class="btn btn-lg btn-outline-secondary botao" value="Ler">
    </form>
  </div>
</div>

</body>
</html>