<?php
require_once "../classes/setor.php";

$setorObj = new Setor();
$listaSetores = Setor::selectAll();
$tituloForm = "Dados Setor";
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
                <td>Descrição</td>
            </tr>
            <?php foreach ($listaSetores as $s): ?>
            <tr>
                <td><?= $s['id_setor'] ?></td>
                <td><?= htmlspecialchars($s['nome']) ?></td>
                <td><?= htmlspecialchars($s['descricao']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>
