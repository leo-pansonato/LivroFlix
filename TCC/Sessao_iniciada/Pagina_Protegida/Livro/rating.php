<?php
include_once '../../../conexao.php';

$rating = $_POST['rating'];
$livro_id = $_POST['livro_id'];
$user_id = $_POST['user_id'];
$response = "";

$query = "UPDATE opiniao SET rating = $rating WHERE fk_idLivro = $livro_id AND fk_idCliente = $user_id";
$resultrating = mysqli_query($conexao, $query);

if ($resultrating) {
    $response = "success";
} else {
    $response = "error: " . mysqli_error($conexao);
}


echo $response;
?>