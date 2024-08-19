<?php
session_start();

if (isset($_POST['adicionar_carrinho'])) {
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    if (isset($_SESSION['carrinho'][$produto_id])) {
        $_SESSION['carrinho'][$produto_id] += $quantidade;
    } else {
        $_SESSION['carrinho'][$produto_id] = $quantidade;
    }

    echo "Produto adicionado ao carrinho!";
} else {
    echo "Erro: Dados do produto não fornecidos.";
}
?>