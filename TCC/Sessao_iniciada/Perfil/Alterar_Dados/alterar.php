<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../../Recursos/book_image2.png">

    <title>Alterar Dados</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    

    <link rel="stylesheet" href="style.css">


    <style>
        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

  </head>

<?php
    // Inicia as variaveis e define o valor digitado nos campos de texto a elas.
    $reescrever_nome = '';
    if (isset($_POST['nome'])) {
        $reescrever_nome = $_POST['nome'];
    }

    $reescrever_senha = '';
    if (isset($_POST['senha'])) {
        $reescrever_senha = $_POST['senha'];
    }

    $reescrever_confirmarsenha = '';
    if (isset($_POST['confirmarsenha'])) {
        $reescrever_confirmarsenha = $_POST['confirmarsenha'];
    }
?>



<body background="../../../Recursos/background3.png">

    <div class="main centered">
        <div class="container shadow-lg">
            <div class="sign-up-content text-center font-type">

                <!-- FORMULÁRIO -->
                <form method="post" class="signup-form">
                    <img class="mb-2" src="../../../Recursos/book_image2.png" alt="" width="132" height="132">
                    <p class="mb-4 fs-1">Alterar Dados</p>

                        <!-- Campo de texto NOME -->
                        <div class="form-floating">    
                            <input name="nome" type="text" class="form-control" id="floatingInput" placeholder=" " value="<?php echo $reescrever_nome; ?>">
                            <label for="floatingInput">Novo Nome</label>
                        </div>
                        
                        <!-- Campo de texto SENHA -->
                        <div class="form-floating">
                            <input name="senha" type="password" class="form-control mt-3" id="floatingPassword" placeholder=" " value="<?php echo $reescrever_senha; ?>">
                            <label for="floatingInput">Nova Senha</label>
                        </div>
                        <div class="text-start errorInfo rounded-2 lead" id="errorsenha">*Senhas não correspondem</div>
    
                        <!-- Campo de texto CONFIRMAR SENHA -->
                        <div class="form-floating">
                            <input name="confirmarsenha" type="password" class="form-control mt-3" id="floatingPassword" placeholder=" " value="<?php echo $reescrever_confirmarsenha; ?>">
                            <label for="floatingInput">Confirmar Senha</label>
                        </div>
                        <div class="text-start errorInfo rounded-2 lead" id="errorconfirmarsenha">*Senhas não correspondem</div> 

                        <!-- BOTÃO do tipo submit -->
                        <div class="form-textbox mt-4 pt-3">
                            <input type="submit" name="submit" id="submit" class="submit" value="Alterar" style="font-family: sans-serif; font-size: medium;">
                        </div>
                        <div class="text-start lead mt-1 mb-1 info">Não obrigatório preencher nome e senha simultaneamente</div>
                        <div class="text-start errorInfoVazio lead mt-1 mb-4" id="errorInfo">*Preencha ao menos um campo para alterar</div>
                </form>

            </div>
        </div>
    </div>


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
    $confirmsenha = $_POST["confirmarsenha"];

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
            if($senha == $confirmsenha){
            update("UPDATE cadastro SET senha = '$senha' WHERE email = '$userEmail'");
            }
            else{
              echo "<script>document.getElementById('errorsenha').style.display='block';</script>";
              echo "<script>document.getElementById('errorconfirmarsenha').style.display='block';</script>";
            }
          }
        }else{
          if($senha == $confirmsenha){
          update("UPDATE cadastro SET nome = '$nome' , senha ='$senha' WHERE email = '$userEmail'");
          $_SESSION['nome'] = $nome;
          }
          else{
            echo "<script>document.getElementById('errorsenha').style.display='block';</script>";
            echo "<script>document.getElementById('errorconfirmarsenha').style.display='block';</script>";
          }
        }

        if(($nome=="")&&($senha=="")){
          echo "<script>document.getElementById('errorInfo').style.display='block';</script>";
        }
  }
  
?>


</body>
</html>