<?php
require_once "../classes/produto.php";

$produtoObj = new Produto();
$listaProdutos = Produto::selectAll();
$tituloForm = "Dados Produto";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Loja Bigolin</title>
</head>
<body>
    <?php require "../pages/header.php"; ?>

    <main>
        <h1><?= $tituloForm ?></h1>

        <table>
            <tr>
                <td>ID</td>
                <td>Marca</td>
                <td>Setor</td>
                <td>Nome</td>
                <td>Preço</td>
                <td>Descrição</td>
                <td>Status</td>
            </tr>
            <?php foreach ($listaProdutos as $p): ?>
            <tr>
                <td><?= $p['id_produto'] ?></td>
                <td><?= htmlspecialchars($p['id_marca']) ?></td>
                <td><?= htmlspecialchars($p['id_setor']) ?></td>
                <td><?= htmlspecialchars($p['nome']) ?></td>
                <td><?= htmlspecialchars($p['preco']) ?></td>
                <td><?= htmlspecialchars($p['descricao']) ?></td>
                <td><?= htmlspecialchars($p['status']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>
