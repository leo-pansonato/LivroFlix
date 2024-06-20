<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../../../Recursos/book_image2.png">
    <title>Pesquisar</title>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>	
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

include_once '../../../conexao.php'; //Incluir o arquivo de conexão com o banco de dados


$user_id = $_SESSION['id_user']; //Obtém o ID do cliente
$livro_id = $_GET["id"]; //Obtém o ID do livro presente no endereço da página

//Verifica se o usuario já avaliou o livro
$result_rating= mysqli_query($conexao , "SELECT `rating` FROM `opiniao` WHERE fk_idLivro = $livro_id and fk_idCliente = $user_id");
if ($result_rating -> num_rows == 0) {
  mysqli_query($conexao, "INSERT INTO `opiniao`(`fk_idCliente`, `fk_idLivro`) VALUES ('$user_id','$livro_id')");
}
$user_rating = $result_rating -> fetch_array()[0] ?? '';

//Botão de leitura
if(isset($_POST['btnler'])){
  ler($livro_id, $conexao);
}

//Abre o livro e acrescenta nas visualizações
function ler($id, $conexao){
  mysqli_query($conexao,"UPDATE livros SET views = views + 1 WHERE ID = '$id'");
  echo "<script>window.open('../Livro/Leitura/leitura.php?id=$id','_self')</script>"; 
}

//Obtém as informações do livro
$query = "
    SELECT livros.titulo, livros.descricao, livros.capa, livros.ID, cadastro.nome AS nome_autor
    FROM livros 
    JOIN cadastro ON livros.autor = cadastro.ID ORDER BY (rating/votos) DESC
    ";

$resultLivro = mysqli_query($conexao, "SELECT livros.titulo, livros.autor, livros.descricao, livros.capa, data, livros.rating, livros.votos, livros.views, cadastro.nome AS nome_autor
  FROM livros
  JOIN cadastro ON livros.autor = cadastro.ID
  WHERE livros.ID = '$livro_id'");
  $livro = mysqli_fetch_assoc($resultLivro);
  $livrorating = ($livro['votos'] != 0) ? intval($livro['rating'] / $livro['votos']) : 0;
  $livrorating = min(5, $livrorating);
  $queryFav = "SELECT * FROM favoritos WHERE fk_idCliente = $user_id AND fk_idLivro = $livro_id";
  $resultFav = mysqli_query($conexao, $queryFav);
  $row = $resultFav->fetch_assoc();

  if(mysqli_num_rows($resultFav) > 0){
    $isFav = "true";
  }
  else{
    $isFav = "false";
  }
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

        <img title="<?php echo $livro['titulo'];?>" onerror="this.src=\'../../../Recursos/erro.png\'" class="capa" src="../../../Recursos/Capas/<?php echo $livro['capa']?>">
        <div class="detalhes">
          <h5 class="titulo"><?php echo $livro['titulo']?></h5>
          <p class="fw-light autor">
            <a href="../../Perfil/perfil.php?id=<?php echo $livro['autor']?>">
              <?php echo $livro['nome_autor']?>
            </a>
          </p>
          <p class="fw-light data"><?php echo date("d/m/Y", strtotime($livro['data']));?></p>
          <div class="estats">
            <div class="rating">
              <form method="POST">
  <?php
    for ($i = 0; $i < 5; $i++) {
        $value = $i + 1;
        $starClass = ($i < $livrorating) ? '' : ' graystar';
        echo '
                <button type="submit" class="btn-star" name="rating' . $value . '" id="rating' . $value . '">
                  <img class="star' . $starClass . '" src="../../../Recursos/star' . ($starClass ? '-gray' : '') . '.png">
                </button>';
    }
  ?>
              </form>
            </div>
            <p class="views"><?php echo $livro['views']?> visualizações</p>
          </div>
          <div class="btns-navegacao">
            <button class="btn-review" id="btn-review" style="margin-right: 12px;">
              <i class="bx-fw bx bxs-star"></i>
              <p>Ler reviews</p>
            </button>
            <div id="fav-btn">
              <?php
              if($isFav == "false"){
                echo '<button class="btn-fav fav-desactive" id="btn-fav-add">
                        <i class="bx-fw bx bxs-heart"></i>
                      </button>';
              }else if ($isFav == "true"){
                echo '<button class="btn-fav fav-active" id="btn-fav-remove">
                        <i class="bx-fw bx bxs-heart"></i>
                      </button>';
              }            
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="descricao">
        <p class="paragrafo"><?php echo $livro['descricao']?></p>
<script> 
  // Destacar em qual estrela foi votada
  document.getElementById("rating<?php echo $user_rating ?>").classList.add("star-active"); 
</script>

  </div>
  <div class='botoes'>
    <form method="post">
      <input type="submit" name="btnler" class="btn btn-lg btn-outline-secondary botao" value="Ler">
    </form>
  </div>
<!--
  <div class="divisor"></div>
  <div class="reviews">
    comentarios
  </div>
</div>

<script>
  $(document).ready(function(){
    botaoReview = $("#btn-review");
    pageReview = $(".reviews");

    botaoReview.click(function(){
      pageReview.toggleClass("toggle-flex");
      pageReview.toggleClass("toggle-opacity");
    });
  });
</script>
-->

<script>
  $(document).ready(function(){

  btn_fav_add = $("#btn-fav-add");
  btn_fav_remove = $("#btn-fav-remove");

  for (let i = 1; i <= 5; i++) {

    let estrela = $(`#rating${i}`);
    
    estrela.click(function(){
      event.preventDefault();
      let Data = new FormData();
      Data.append('rating', i);
      Data.append('livro_id', <?php echo $livro_id ?>);
      Data.append('user_id', <?php echo $user_id ?>);
      
      $.ajax({
        type: "POST",
        url: "rating.php",
        data: Data,
        processData: false,
        contentType: false,

        success: function (response) {
          if (response == 'success') {
            $('.btn-star').removeClass('star-active'); // Remove destaque de todas as estrelas
            estrela.addClass('star-active'); // Adiciona destaque a estrela clicada
            for (let j = 1; j <= i; j++) {
              
              $(`#rating${j} img`).attr('src', '../../../Recursos/star.png'); // Atualiza a imagem das estrela amarelas
            }
            for (let j = i + 1; j <= 5; j++) {
              $(`#rating${j} img`).attr('src', '../../../Recursos/star-gray.png'); // Define as estrelas restantes como cinza
            }
          }
        }
      });
    });
  }

  $(document).on("click", "#btn-fav-add", function(){ //Click do botão Adicionar aos Favoritos
    event.preventDefault();
    let Data = new FormData();
    Data.append('type', 'add');
    Data.append('livro_id', <?php echo $livro_id ?>);
    Data.append('user_id', <?php echo $user_id ?>);

    $.ajax({
      type: "POST",
      url: "favoritar.php",
      data: Data,
      processData: false,
      contentType: false,

      success: function (response) {
        $("#fav-btn").html('<button class="btn-fav fav-active" id="btn-fav-remove"><i class="bx-fw bx bxs-heart"></i></button>');
      }
    });
  });

  $(document).on("click", "#btn-fav-remove", function(){ //Click do botão Remover dos Favoritos
    event.preventDefault();
    let Data = new FormData();
    Data.append('type', 'remove');
    Data.append('livro_id', <?php echo $livro_id ?>);
    Data.append('user_id', <?php echo $user_id ?>);


    $.ajax({
      type: "POST",
      url: "favoritar.php",
      data: Data,
      processData: false,
      contentType: false,

      success: function (response) {
        $("#fav-btn").html('<button class="btn-fav fav-desactive" id="btn-fav-add"><i class="bx-fw bx bxs-heart"></i></button>');
      }
    });

  });

});
</script>

</body>
</html>