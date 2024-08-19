<?php
session_start();
require_once __DIR__ . '/conexao.php';

// Verifica se o carrinho existe na sessão
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "Seu carrinho está vazio.";
    exit;
}

// Obtém os IDs dos produtos do carrinho
$ids_produtos = array_keys($_SESSION['carrinho']);
$quantidades = $_SESSION['carrinho'];

// Prepara a consulta para obter detalhes dos produtos
$placeholders = implode(',', array_fill(0, count($ids_produtos), '?'));
$sql = "SELECT id, nome, preco FROM produtos WHERE id IN ($placeholders)";
$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat('i', count($ids_produtos)), ...$ids_produtos);
$stmt->execute();
$result = $stmt->get_result();

// Cria um array associativo com os dados dos produtos
$produtos = [];
while ($produto = $result->fetch_assoc()) {
    $produtos[$produto['id']] = $produto;
}

// Exibe o carrinho
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho de Compras</title>
</head>
<body>
    <h1>Seu Carrinho</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quantidades as $produto_id => $quantidade): ?>
                <?php if (isset($produtos[$produto_id])): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($produtos[$produto_id]['nome']); ?></td>
                        <td>R$<?php echo number_format($produtos[$produto_id]['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo intval($quantidade); ?></td>
                        <td>R$<?php echo number_format($produtos[$produto_id]['preco'] * $quantidade, 2, ',', '.'); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total:</td>
                <td>
                    R$<?php
                    $total = 0;
                    foreach ($quantidades as $produto_id => $quantidade) {
                        if (isset($produtos[$produto_id])) {
                            $total += $produtos[$produto_id]['preco'] * $quantidade;
                        }
                    }
                    echo number_format($total, 2, ',', '.');
                    ?>
                </td>
            </tr>
        </tfoot>
    </table>
    <a href="index.php">Voltar para a Página Inicial</a>
</body>
</html>