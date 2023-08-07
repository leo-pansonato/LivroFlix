<?php
  


  include_once '../conexao.php';

  // Checa se o botão foi pressionado.
  if (isset($_POST["submit"])) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmsenha = $_POST["confirmarsenha"];
    $maxAltura = 750;

    // Verifica SE os campos estão vazios e exibe um aviso OU executa o sistema de cadastro.
    if(($nome=="")||($email=="")||($senha=="")||($confirmsenha=="")){
      
      if($nome==""){
        echo "<script>document.getElementById('errorNome').style.display='block';</script>";
        $maxAltura += 20;
      }
      if($email==""){
        echo "<script>document.getElementById('errorEmail').style.display='block';</script>";
        $maxAltura += 20;
      }
      if($senha==""){
        echo "<script>document.getElementById('errorSenha').style.display='block';</script>";
        $maxAltura += 20;
      }
      if($confirmsenha==""){
        echo "<script>document.getElementById('errorConfirmarSenha').style.display='block';</script>";
        $maxAltura += 20;
      }
      echo "<script>document.getElementById('principal').style.maxHeight='".$maxAltura."px';</script>";
    
    } else{
        if($senha == $confirmsenha){
          // Prepara e executa o comando no banco de dados depois de verificar se o email já está cadastrado.
          $sql = "SELECT * FROM cadastro WHERE email ='$email'";
          $resultado = mysqli_query($conexao, $sql);

          if (mysqli_num_rows($resultado) > 0) {
            echo "<script>document.getElementById('errorInfo').style.display='block';</script>";
            $maxAltura += 20;
            echo "<script>document.getElementById('principal').style.maxHeight='".$maxAltura."px';</script>";

          // Se o email não estiver cadastrado, será cadastrada uma nova conta.
          } else {
            mysqli_query($conexao,"INSERT INTO cadastro(nome,email,senha) VALUES ('$nome','$email','$senha')");
            $_SESSION['nome'] = mysqli_query($conexao, "SELECT nome FROM cadastro WHERE email ='$email'")->fetch_array()[0] ?? '';
            $_SESSION['id_user'] = mysqli_query($conexao, "SELECT id FROM cadastro WHERE email ='$email'")->fetch_array()[0] ?? '';
            $_SESSION['email'] = $email;
            echo "<script>window.open('../Sessao_iniciada/Pagina_Protegida/pagina_protegida.php','_self')</script>";
            exit();
          }
        }
        else{
          echo "<script>document.getElementById('errorConfirmarSenha').style.display='block';</script>";
          $maxAltura += 20;
          echo "<script>document.getElementById('principal').style.maxHeight='".$maxAltura."px';</script>";
        }
      }
  }
  
?>