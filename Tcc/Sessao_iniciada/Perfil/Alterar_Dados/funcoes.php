<?php
  session_start();

  // Conecta ao banco de dados.
  $sv_nome = "localhost";
  $sv_usuario = "root";
  $sv_senha = "";
  $bd_name = "LIVRO";

  $conexao = mysqli_connect($sv_nome, $sv_usuario, $sv_senha, $bd_name);
  if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
  }

  // Checa se o botão foi pressionado.
  if (isset($_POST["submit"])) {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];

    function update($sql){
      global $conexao;
      mysqli_query($conexao,$sql);
      echo "<script>window.open('../perfil.php','_self')</script>";
    }

     
        // Prepara e executa o comando no banco de dados.
        $userEmail = $_SESSION['email'];

        if(($nome=="")||($senha=="")){

          if($nome!=""){
            update("UPDATE cadastro SET nome = '$nome' WHERE email = '$userEmail'");
            $_SESSION['nome'] = $nome;
          }
          if($senha!=""){
            update("UPDATE cadastro SET senha = '$senha' WHERE email = '$userEmail'");
          }
        }else{
          update("UPDATE cadastro SET nome = '$nome' , senha ='$senha' WHERE email = '$userEmail'");
          $_SESSION['nome'] = $nome;
        }

        if(($nome=="")&&($senha=="")){
          echo "<script>document.getElementById('errorInfo').style.display='block';</script>";
        }
  }
  
?>