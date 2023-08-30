<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(session_status()==PHP_SESSION_NONE){
    	session_start();
	}

    include_once '../../conexao.php';

    $id_user = $_SESSION['id_user'];
    $email_user = $_SESSION['email'];
    $response = "";

    if(isset($_POST['nome'])){
        $nome = $_POST["nome"];
        $query = "UPDATE cadastro SET nome = '$nome' WHERE ID='$id_user'";
        if ($conexao->query($query) === TRUE) {
            $_SESSION['nome'] = $nome;
            $response = "Nome alterado com sucesso!";
        }
    }

    //upload
    if(isset($_FILES['upload'])){
        $extensao = strtolower(substr($_FILES['upload']['name'],-4));
        if($extensao==".jpg"){
            $novo_name = $email_user . $extensao;
            $caminho_pasta = '../../Recursos/Perfis/'; 
            move_uploaded_file($_FILES['upload']['tmp_name'], $caminho_pasta.$novo_name);
            if($response != ""){
                $response = "Imagem e nome alterados com sucesso!";
            }
            else{
                $response = "Imagem alterada com sucesso!";
            }
        }
        else{
            $response = "Formato de arquivo inválido, APENAS .JPG";
        }
    }
    echo $response;
}
?>