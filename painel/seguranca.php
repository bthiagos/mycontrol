<?php
include '../admin/db_connect.php';
// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['login_resp_id'])) {
    echo "<script type='javascript'>alert('Você não tem permissão para acessar esta área!');";
    // echo "javascript:window.location='../index.php';</script>";
    // Destrói a sessão por segurança
    // session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: 404.php");
    exit;
}
