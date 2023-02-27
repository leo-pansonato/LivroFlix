<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Alterar Dados</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    

    <link rel="stylesheet" href="Style-Alterar.css">


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

    $reescrever_email = '';
    if (isset($_POST['email'])) {
        $reescrever_email = $_POST['email'];
    }

    $reescrever_senha = '';
    if (isset($_POST['senha'])) {
        $reescrever_senha = $_POST['senha'];
    }
?>



<body background="../../../Recursos/background2.png">

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
                        <div class="text-start errorInfo rounded-2 lead">(Não Obrigatório)</div>


                        <!-- Campo de texto SENHA -->
                        <div class="form-floating">
                            <input name="senha" type="password" class="form-control mt-3" id="floatingPassword" placeholder=" " value="<?php echo $reescrever_senha; ?>">
                            <label for="floatingInput">Nova Senha</label>
                        </div>
                        <div class="text-start errorInfo rounded-2 lead">(Não Obrigatório)</div>

                        <!-- BOTÃO com valor submit -->
                        <div class="form-textbox mt-4 pt-3">
                            <input type="submit" name="submit" id="submit" class="submit" value="Alterar" style="font-family: sans-serif; font-size: medium;">
                        </div>
                        <div class="text-start errorInfoVazio lead mt-1 mb-4" id="errorInfo">*Preencha ao menos um campo para alterar</div>
                </form>

            </div>
        </div>
    </div>

</body>
</html>