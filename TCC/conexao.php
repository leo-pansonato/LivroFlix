<?php 
$sv_nome = "localhost";
$sv_usuario = "root";
$sv_senha = "";
$bd_name = "LIVRO";
  
$conexao = mysqli_connect($sv_nome, $sv_usuario, $sv_senha, $bd_name);
if (!$conexao) {
    die("Conexão falhou");
}
?>