<?php

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
    $email = $_POST["email"];
    $senha = $_POST["senha"];


    // Verifica SE os campos estão vazios e exibe um aviso OU executa o sistema de cadastro.
    if(($nome=="")||($email=="")||($senha=="")){
      
      if($nome==""){
        echo "<script>document.getElementById('errorNome').style.display='block';</script>";
      }
      if($email==""){
        echo "<script>document.getElementById('errorEmail').style.display='block';</script>";
      }
      if($senha==""){
        echo "<script>document.getElementById('errorSenha').style.display='block';</script>";
      }
    
    } else{
        // Prepara e executa o comando no banco de dados depois de verificar se o email já está cadastrado.
        $sql = "SELECT * FROM cadastro WHERE email ='$email'";
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
          echo "<script>document.getElementById('errorInfo').style.display='block';</script>";

        // Se o email não estiver cadastrado, será cadastrada uma nova conta.
        } else {
          $sql = "INSERT INTO cadastro(nome,email,senha) VALUES ('$nome','$email','$senha')"; 
          mysqli_query($conexao,$sql);
          echo "<script>window.open('../Index.html','_self')</script>";
        }
      }
      
  }
  
?>