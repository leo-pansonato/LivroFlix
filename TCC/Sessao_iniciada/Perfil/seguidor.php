<?php

include_once '../../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['type'])) {
        
        $id_usuario_seguiu = $_POST['id_usuario_seguiu'];
        $id_usuario_seguido = $_POST['id_usuario_seguido'];

        if ($_POST['type'] === 'seguir') {
            $query = "INSERT INTO seguidor (id_usuario_seguidor, id_usuario_seguido) VALUES ($id_usuario_seguiu,$id_usuario_seguido)";
            if ($conexao->query($query) === TRUE && $conexao->affected_rows > 0) {
                $response = "success";
            }
            else{
                $response = "error";
            }
        } elseif ($_POST['type'] === 'deixardeseguir') {
            $query = "DELETE FROM seguidor WHERE id_usuario_seguidor = $id_usuario_seguiu AND id_usuario_seguido = $id_usuario_seguido";
            if ($conexao->query($query) === TRUE && $conexao->affected_rows > 0) {
                $response = "success";
            }
            else{
                $response = "error";
            }
        }
        echo $response;
    }
}
?>