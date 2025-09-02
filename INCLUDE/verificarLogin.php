<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id']) || !isset($_SESSION['email']) || !isset($_SESSION['tipo'])) {
    header("Location: ../paginas-iniciais/pagina-de-login.php");
    exit();
}

$paginaAtual = basename($_SERVER['PHP_SELF']);

if (strpos($paginaAtual, 'adm/') !== false && $_SESSION['tipo'] !== 'admin') {
    header("Location: acesso_nao_autorizado.php");
    exit();
}

if (strpos($paginaAtual, 'vend/') !== false && $_SESSION['tipo'] !== 'vendedor') {
    header("Location: acesso_nao_autorizado.php");
    exit();
}

?>