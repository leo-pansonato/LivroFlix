<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_session = $_POST['id_session'];
    $id_livro = $_POST['id_livro'];
    $currentPage = $_POST['current_page'];

    // Inclua a conexão com o banco de dados e outras configurações necessárias
    include_once '../../../../conexao.php';

    $query = "UPDATE `lendo` SET `ultimaPagina` = $currentPage , `ultima_vez` = current_timestamp()  WHERE `id_user` = $id_session and `id_livro` = $id_livro";
    $result = mysqli_query($conexao, $query);

    if (!$result) {
        // Erro na atualização do banco de dados
        die('Erro no MySQL: ' . mysqli_error($conexao));
    }

    // A atualização foi concluída com sucesso
    echo 'Atualização concluída com sucesso!';
}
?>
