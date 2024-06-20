<?php
    if(session_status()==PHP_SESSION_NONE){
        session_start();
    }
      
    include_once '../conexao.php';

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $response = "";

    // checa SE o email e senha foram encontrados e loga OU exibe um aviso de informações incorretas.
      if (mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM cadastro WHERE email ='$email' AND senha ='$senha'")) > 0) {
        $_SESSION['nome'] = mysqli_query($conexao, "SELECT nome FROM cadastro WHERE email ='$email'")->fetch_array()[0] ?? '';
        $_SESSION['id_user'] = mysqli_query($conexao, "SELECT id FROM cadastro WHERE email ='$email'")->fetch_array()[0] ?? '';
        $_SESSION['email'] = $email;
        // verificação do Lembrar-me
        /*
        if(isset($_POST['lembrar'])) {
          session_set_cookie_params(604800);
          session_regenerate_id(true);
        }
        else{
          //else para o lembrar-me
        }
        */
        $response = "success";

      } else {
        // mensagem de email ou senha incorreto.
        $response = "email ou senha incorretos";
      }

      echo $response;
?>