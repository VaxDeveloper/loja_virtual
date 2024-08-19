<?php
session_start();
require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/adicionar_carrinho.php';

// Consultar produtos
$sql = "SELECT id, nome, preco FROM produtos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Loja Virtual</title>
</head>
<body>
    <h1>Loja Virtual</h1>
    <h2>Produtos</h2>
    <ul>
        <?php while ($produto = $result->fetch_assoc()): ?>
            <li>
                <?php echo htmlspecialchars($produto['nome']); ?> - R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                <form method="post" action="">
                    <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                    <input type="number" name="quantidade" value="1" min="1">
                    <button type="submit" name="adicionar_carrinho">Adicionar ao Carrinho</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
    <a href="adicionar_produto.php">Adicionar Novo Produto</a>
    <a href="carrinho.php">Ver Carrinho</a>

</body>
</html>