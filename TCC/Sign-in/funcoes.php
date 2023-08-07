<?php
  if(session_status()==PHP_SESSION_NONE){
    session_start();
  }
  
  include_once '../conexao.php';


  // checa se o botao foi pressionado.
  if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $maxAltura = 610;

    // verifica SE os campos estão vazios e exibe um aviso OU executa o sistema de verificação de login caso falso.
    if(($email=="")||($senha=="")){

      if($email==""){
        echo "<script>document.getElementById('errorEmail').style.display='block';</script>";
        $maxAltura += 20;
      }
      if($senha==""){
        echo "<script>document.getElementById('errorSenha').style.display='block';</script>";
        $maxAltura += 20;
      }
    
    echo "<script>document.getElementById('principal').style.maxHeight='".$maxAltura."px';</script>";

    } else{

      function sqlexec($conexao, $sql){
        $result = mysqli_query($conexao, $sql);
        return $result;
      }

    // checa SE o email e senha foram encontrados e loga OU exibe um aviso de informações incorretas.
      if (mysqli_num_rows(sqlexec($conexao, "SELECT * FROM cadastro WHERE email ='$email' AND senha ='$senha'")) > 0) {
        $_SESSION['nome'] = sqlexec($conexao, "SELECT nome FROM cadastro WHERE email ='$email'")->fetch_array()[0] ?? '';
        $_SESSION['id_user'] = sqlexec($conexao, "SELECT id FROM cadastro WHERE email ='$email'")->fetch_array()[0] ?? '';
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
        header('Location: ../Sessao_iniciada/Pagina_Protegida/pagina_protegida.php');
        exit();

      } else {
        // mensagem de email ou senha incorreto.
        echo "<script>document.getElementById('errorInfo').style.display='block';</script>";
        $maxAltura += 20;
        echo "<script>document.getElementById('principal').style.maxHeight='".$maxAltura."px';</script>";
      }
    }

  }

?>