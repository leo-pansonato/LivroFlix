<?php
if(session_status()==PHP_SESSION_NONE){
	session_start();
}

// Verifica se o usuário está conectado
if (!isset($_SESSION['nome'])) {
	// Se não estiver conectado, redireciona para a página de login
	header('Location: ../../Sign-in/Sign-in.php');
	exit();
}
	
	$userName = $_SESSION['nome'];

if (isset($_POST["sair"])) {
	session_destroy();
	echo "<script>window.open('../../Index.html','_self')</script>";
	exit();
}

if (isset($_POST["voltar"])) {
	echo "<script>window.open('../../Index.html','_self')</script>";
}
?>