<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['codproduto'];
    
    $item = [
        'nome'  => $_POST['nome'],
        'preco' => floatval($_POST['preco']),
        'qtd'   => intval($_POST['qtd'])
    ];

    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]['qtd'] += $item['qtd'];
    } else {
        $_SESSION['carrinho'][$id] = $item;
    }

    header("Location: carrinho.php");
    exit();
}