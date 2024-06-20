<?php
include_once '../../../conexao.php';

$type = $_POST['type'];
$livro_id = $_POST['livro_id'];
$user_id = $_POST['user_id'];
$response = "";

if($type == "add"){
    $query = "INSERT INTO favoritos(fk_idCliente, fk_idLivro) VALUES ($user_id,$livro_id)";
    $resultfav = mysqli_query($conexao, $query);
    $response = "success favAdd";
}
else if($type == "remove"){
    $query = "DELETE FROM favoritos WHERE fk_idCliente = $user_id AND fk_idLivro = $livro_id";
    $resultfav = mysqli_query($conexao, $query);
    $response = "success favRemove";
}
/*
if ($resultrating) {
    $response = "success";
} else {
    $response = "error: " . mysqli_error($conexao);
}
*/

echo $response;



?>