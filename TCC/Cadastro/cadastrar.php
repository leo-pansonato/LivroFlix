<?php
    if(session_status()==PHP_SESSION_NONE){
        session_start();
    }

    include_once '../conexao.php';

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $response = "";

    // Prepara e executa o comando no banco de dados depois de verificar se o email já está cadastrado.
    $query = "SELECT * FROM cadastro WHERE email ='$email'";
    $resultado = mysqli_query($conexao, $query);

    if (mysqli_num_rows($resultado) > 0) {
        $response = "email ja cadastrado";

    // Se o email não estiver cadastrado, será cadastrada uma nova conta.
    } else {
        mysqli_query($conexao,"INSERT INTO cadastro(nome,email,senha) VALUES ('$nome','$email','$senha')");
        $_SESSION['nome'] = $nome;
        $_SESSION['id_user'] = mysqli_query($conexao, "SELECT id FROM cadastro WHERE email ='$email'")->fetch_array()[0] ?? '';
        $_SESSION['email'] = $email;

        $response = "success";
    }
    echo $response;
?>