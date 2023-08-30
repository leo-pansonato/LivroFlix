<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Entrar</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
      <link rel="stylesheet" type="text/css" href="Style-Sign.css">


  </head>
  

  <?php
      // Inicia as variaveis e define o valor digitado nos campos de texto a elas.
      $reescrever_email = '';
      if (isset($_POST['email'])) {
        $reescrever_email = $_POST['email'];
      }
      $reescrever_senha = '';
      if (isset($_POST['senha'])) {
        $reescrever_senha = $_POST['senha'];
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
        <p class="mb-4 fs-1">Entrar</p>

        <!-- Campo de texto EMAIL -->
        <div class="form-floating">
          <input name="email" type="email" class="form-control rounded-2" placeholder="Endereço de Email" value="<?php echo $reescrever_email; ?>">
          <label>Endereço de Email</label>
        </div>
        <div class="text-start errorInfo rounded-2 lead" id="errorEmail">*Email Obrigatório</div>

        <!-- Campo de texto SENHA -->
        <div class="form-floating">
          <input name="senha" type="password" class="form-control rounded-2 mb-0 mt-2" placeholder="Senha" value="<?php echo $reescrever_senha; ?>">
          <label>Senha</label>
        </div>
        <div class="text-start errorInfo rounded-2 lead" id="errorSenha">*Senha Obrigatória</div>

        <!-- CheckBox de manter logado -->
        <div class="checkbox mb-3 mt-2">
          <label>
            <input type="checkbox" name="lembrar" value="lembrar-me"> Lembrar-me
          </label>
        </div>

        <!-- BOTÃO tipo submit -->
        <input type="submit" name="submit" class="submit" value="Entrar">
        <div class="text-start errorInfo" id="errorInfo">*Informações incorretas</div>

        <!-- Texto avisando sobre o CADASTRO -->
        <div class="col align-self-center mt-5 mb-0">
          <p style="color: grey; margin-bottom: 0;">Não possui uma conta? <a href="../Cadastro/cadastro.php" class="cad-link">Cadastre-se</a></p>
        </div>
      </form>
  </div>

</body>
</html>