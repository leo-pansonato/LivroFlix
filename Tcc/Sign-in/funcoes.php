<?php
  if(session_status()==PHP_SESSION_NONE){
    session_start();
  }
  
  // conecta ao banco de dados.
  $sv_nome = "localhost";
  $sv_usuario = "root";
  $sv_senha = "";
  $bd_name = "LIVRO";

  $conexao = mysqli_connect($sv_nome, $sv_usuario, $sv_senha, $bd_name);
  if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
  }

  // checa se o botao foi pressionado.
  if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // verifica SE os campos estão vazios e exibe um aviso OU executa o sistema de verificação de login caso falso.
    if(($email=="")||($senha=="")){

      if($email==""){
        echo "<script>document.getElementById('errorEmail').style.display='block';</script>";
      }
      if($senha==""){
        echo "<script>document.getElementById('errorSenha').style.display='block';</script>";
      }

    } else{
      // prepara e executa os comandos no banco de dados
      $sql = "SELECT * FROM cadastro WHERE email ='$email' AND senha ='$senha'";
      $resultado = mysqli_query($conexao, $sql);
      $sql2 = "SELECT nome from cadastro where email = '$email'";
      $resultado2 = mysqli_query($conexao, $sql2);
    
      $resultado2String = $resultado2->fetch_array()[0] ?? ''; // <-- peguei do google, sla como isso ta funcinando



    // checa SE o email e senha foram encontrados e loga OU exibe um aviso de informações incorretas.
      if (mysqli_num_rows($resultado) > 0) {
        $_SESSION['nome'] = $resultado2String;
        $_SESSION['email'] = $email;
        // verificação do Lembrar-me
        if(isset($_POST['lembrar'])) {
          session_set_cookie_params(604800);
          session_regenerate_id(true);
        }
        else{
          //else para o lembrar-me
        }
        header('Location: ../Sessao_iniciada/Pagina_Protegida/pagina_protegida.php');
        exit();

      } else {
        // mensagem de email ou senha incorreto.
        echo "<script>document.getElementById('errorInfo').style.display='block';</script>";
      }
    }

  }

?>