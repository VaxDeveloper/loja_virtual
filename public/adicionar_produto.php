<?php
require_once __DIR__ . '/conexao.php';

// Adicionar produto ao banco de dados
if (isset($_POST['adicionar_produto'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    $categoria_id = $_POST['categoria_id'];

    $sql = "INSERT INTO produtos (nome, descricao, preco, estoque, categoria_id) 
            VALUES ('$nome', '$descricao', '$preco', '$estoque', '$categoria_id')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Produto adicionado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
</head>
<body>
    <h1>Adicionar Novo Produto</h1>
    <!-- Especifica que o formulário deve enviar dados para a própria página -->
    <form method="post">
        <input type="text" name="nome" placeholder="Nome do Produto" required>
        <textarea name="descricao" placeholder="Descrição" required></textarea>
        <input type="number" name="preco" placeholder="Preço" step="0.01" required>
        <input type="number" name="estoque" placeholder="Estoque" required>
        <select name="categoria_id" required>
            <?php
            $categorias = $conn->query("SELECT id, nome FROM categorias");
            while ($cat = $categorias->fetch_assoc()) {
                echo "<option value='{$cat['id']}'>{$cat['nome']}</option>";
            }
            ?>
        </select>
        <button type="submit" name="adicionar_produto">Adicionar Produto</button>
    </form>
    <a href="index.php">Voltar para a Página Inicial</a>
</body>
</html>