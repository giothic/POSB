<?php
session_start();

if (isset($_GET['remover'])) {
    $id = $_GET['remover'];
    unset($_SESSION['carrinho'][$id]);
}

if (isset($_GET['limpar_tudo'])) {
    unset($_SESSION['carrinho']);
}

header("Location: carrinho.php");
exit();