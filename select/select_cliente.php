<?php
require_once "../classes/cliente.php";

$clienteObj = new Cliente();
$listaClientes = Cliente::selectAll();
$dadosCliente = ['id_cliente' => '', 'nome' => '', 'cpf' => '', 'telefone' => '', 'email' => ''];
$tituloForm = "Dados Cliente";

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
                <td>CPF</td>
                <td>Telefone</td>
                <td>Email</td>
            </tr>
            <?php foreach ($listaClientes as $c): ?>
            <tr>
                <td><?= $c['id_cliente'] ?></td>
                <td><?= htmlspecialchars($c['nome']) ?></td>
                <td><?= htmlspecialchars($c['cpf']) ?></td>
                <td><?= htmlspecialchars($c['telefone']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>