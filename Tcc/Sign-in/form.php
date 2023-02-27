<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Entrar</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>
      <link rel="stylesheet" type="text/css" href="Style-Sign.css">


  </head>
  

  <?php
      // Inicia as variaveis e define o valor digitado nos campos de texto a elas.
      $email2 = '';
      if (isset($_POST['email'])) {
        $email2 = $_POST['email'];
      }
      $senha2 = '';
      if (isset($_POST['senha'])) {
        $senha2 = $_POST['senha'];
      }
  ?>


<body class="text-center" background="../Recursos/background2.png">

  <div class="container bg-white rounded-3 font-type shadow-lg m-auto"style="width: 520px;">
    <main class="form-signin m-auto">

      <!-- FORMULÁRIO -->
      <form action="" method="post">
        <img class="mb-2 rounded-circle" src="../Recursos/book_image2.png" alt="" width="132" height="132">
        <p class="mb-4 fs-1">Entrar</p>

        <!-- Campo de texto EMAIL -->
        <div class="form-floating">
          <input name="email" type="email" class="form-control rounded-2" id="floatingInput" placeholder="Endereço de Email" value="<?php echo $email2; ?>">
          <label for="floatingInput">Endereço de Email</label>
        </div>
        <div class="text-start errorInfo rounded-2 lead" id="errorEmail">*Email Obrigatório</div>

        <!-- Campo de texto SENHA -->
        <div class="form-floating">
          <input name="senha" type="password" class="form-control rounded-2 mb-0 mt-2" id="floatingPassword" placeholder="Senha" value="<?php echo $senha2; ?>">
          <label for="floatingPassword">Senha</label>
        </div>
        <div class="text-start errorInfo rounded-2 lead" id="errorSenha">*Senha Obrigatória</div>

        <!-- CheckBox de manter logado -->
        <div class="checkbox mb-3 mt-2">
          <label>
            <input type="checkbox" name="lembrar" value="lembrar-me"> Lembrar-me
          </label>
        </div>

        <!-- BOTÃO tipo submit -->
        <input type="submit" name="submit" class="submit" value="Entrar" style="font-family: sans-serif; font-size: medium;">
        <div class="text-start errorInfo" id="errorInfo">*Informações incorretas</div>

        <!-- Texto avisando sobre o CADASTRO -->
        <div class="col align-self-center mt-5">
          <p style="color: grey;">Não possui uma conta? <a href="../Cadastro/cadastro.php" class="cad-link">Cadastre-se</a></p>
        </div>
      
      </form>
    </main>
  </div>

</body>
</html>