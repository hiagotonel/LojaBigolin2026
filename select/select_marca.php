<?php
require_once "../classes/marcas.php";

$marcaObj = new Marcas();
$listaMarcas = Marcas::selectAll();
$tituloForm = "Dados Marca";
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
                <td>Nome</td>
                <td>País</td>
            </tr>
            <?php foreach ($listaMarcas as $m): ?>
            <tr>
                <td><?= $m['id_marca'] ?></td>
                <td><?= htmlspecialchars($m['nome']) ?></td>
                <td><?= htmlspecialchars($m['pais']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>
