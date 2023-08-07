<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cadastrar-se</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    

    <link rel="stylesheet" href="Style-Cadastro.css">

  </head>

  <?php
    if(session_status()==PHP_SESSION_NONE){
        session_start();
    }

    // Inicia as variaveis e define o valor digitado nos campos de texto a elas.
    $reescrever_nome = '';
    if (isset($_POST['nome'])) {
        $reescrever_nome = $_POST['nome'];
    }
    $reescrever_email = '';
    if (isset($_POST['email'])) {
        $reescrever_email = $_POST['email'];
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

<body background="../Recursos/background2.png">

<div class="principal" id="principal">
      <div class="voltar">
        <a class="link-voltar" href="../index.html">
          <img class="seta" src="../Recursos/esquerda_dark.png" alt="Voltar">
        </a>
      </div>
                <!-- FORMULÁRIO -->
                <form method="post">
                    <img class="mb-2 rounded-circle" src="../Recursos/book_image2.png" alt="" width="132" height="132">
                    <p class="mb-4 fs-1">Cadastrar-se</p>

                        <!-- Campo de texto NOME -->
                        <div class="form-floating">    
                            <input name="nome" type="text" class="form-control  rounded-2" placeholder="Nome" value="<?php echo $reescrever_nome;?>">
                            <label>Nome completo</label>
                        </div>
                        <div class="text-start errorInfo rounded-2 lead" id="errorNome">*Nome Obrigatório</div>

                        <!-- Campo de texto EMAIL -->
                        <div class="form-floating">
                            <input name="email" type="email" class="form-control mt-2" placeholder="Endereço de Email" value="<?php echo $reescrever_email;?>">
                            <label>Endereço de Email</label>
                        </div>
                        <div class="text-start errorInfo rounded-2 lead" id="errorEmail">*Email Obrigatório</div>

                        <!-- Campo de texto SENHA -->
                        <div class="form-floating">
                            <input name="senha" type="password" class="form-control rounded-2 mb-0 mt-2" placeholder="Senha" value="<?php echo $reescrever_senha;?>">
                            <label>Senha</label>
                        </div>
                        <div class="text-start errorInfo rounded-2 lead" id="errorSenha">*Senha Obrigatória</div>

                        <!-- Campo de texto CONFIRMAR SENHA -->
                        <div class="form-floating">
                            <input name="confirmarsenha" type="password" class="form-control rounded-2 mb-0 mt-2" placeholder="Confirmar Senha" value="<?php echo $reescrever_confirmarsenha;?>">
                            <label>Confirmar Senha</label>
                        </div>
                        <div class="text-start errorInfo rounded-2 lead" id="errorConfirmarSenha">*Senhas não correspondem</div> 
                            
                        <!-- Aviso de TERMOS -->
                        <div class="form-group mt-2 mb-3">
                            <label class="label-agree-term"> Ao concluir, você concorda com os <a href="https://imageproxy.ifunny.co/crop:x-20,resize:640x,quality:90x75/images/e125ced5455fb710b79746cdac25c428b9247a6a8442fb64a774eba719c1eac2_1.jpg" target="_blank" class="term-service">Termos de Serviço</a></label>
                        </div>

                        <!-- BOTÃO com valor submit -->
                        <input type="submit" name="submit" class="submit" value="Cadastrar">
                        <div class="text-start errorInfo lead" id="errorInfo">*Email já cadastrado</div>
                
                <!-- Texto avisando sobre o LOGIN -->
                <p class="loginhere">Já possui uma conta? <a href="../Sign-in/Sign-in.php" class="loginhere-link"> Entrar</a></p>
                </form>
            </div>
        </div>
    </div>

</body>
</html>