<?php
require_once "../classes/pedido.php";

$pedidoObj = new Pedido();
$listaPedidos = Pedido::selectAll();
$tituloForm = "Dados Pedido";
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
                <td>ID Cliente</td>
                <td>Data</td>
                <td>Preço</td>
                <td>Quantidade</td>
                <td>Status</td>
            </tr>
            <?php foreach ($listaPedidos as $p): ?>
            <tr>
                <td><?= $p['id_pedido'] ?></td>
                <td><?= htmlspecialchars($p['id_produto']) ?></td>
                <td><?= htmlspecialchars($p['id_cliente']) ?></td>
                <td><?= htmlspecialchars($p['data']) ?></td>
                <td><?= htmlspecialchars($p['preco']) ?></td>
                <td><?= htmlspecialchars($p['quantidade']) ?></td>
                <td><?= htmlspecialchars($p['status']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>
