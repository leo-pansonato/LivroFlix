<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPage = $_POST['currentPage'];

    // Inclua a conexão com o banco de dados e outras configurações necessárias
    include_once '../../../../conexao.php';

    $id_user = $_SESSION['id_user'];
    $livroid = $_GET['id'];

    $query = "UPDATE `lendo` SET `ultimaPagina` = $currentPage WHERE `id_user` = $id_user and `id_livro` = $livroid";
    $result = mysqli_query($conexao, $query);

    if (!$result) {
        // Em caso de erro na atualização do banco de dados, exiba uma mensagem de erro ou realize alguma ação apropriada
        die('Erro no MySQL: ' . mysqli_error($conexao));
    }

    // A atualização foi concluída com sucesso
    echo 'Atualização concluída com sucesso!';
}
?>
