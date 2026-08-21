<?php
require_once "../classes/estoque.php";

$estoqueObj = new Estoque();
$listaEstoque = Estoque::selectAll();
$tituloForm = "Dados Estoque";
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
                <td>ID Produto</td>
                <td>Quantidade</td>
                <td>Pavilhão</td>
            </tr>
            <?php foreach ($listaEstoque as $e): ?>
            <tr>
                <td><?= $e['id_estoque'] ?></td>
                <td><?= htmlspecialchars($e['id_produto']) ?></td>
                <td><?= htmlspecialchars($e['quantidade']) ?></td>
                <td><?= htmlspecialchars($e['pavilhao']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>
