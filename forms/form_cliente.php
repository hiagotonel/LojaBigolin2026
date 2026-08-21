<?php
require_once "../classes/cliente.php";

$clienteObj = new Cliente();
$listaClientes = Cliente::selectAll();
$dadosCliente = ['id_cliente' => '', 'nome' => '', 'cpf' => '', 'telefone' => '', 'email' => ''];
$tituloForm = "Cadastrar Cliente";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['acao']) && $_POST['acao'] === 'deletar' && !empty($_POST['id_cliente'])) {
        $clienteObj->setID($_POST['id_cliente']);
        $clienteObj->delete();
        header("Location: form_cliente.php");
        exit;
    }

    else if (isset($_POST['acao']) && $_POST['acao'] === 'carregar_edicao' && !empty($_POST['id_cliente'])) {
        $clienteObj->setID($_POST['id_cliente']);
        $registro = $clienteObj->select();
        if ($registro) {
            $dadosCliente = $registro;
            $tituloForm = "Atualizar Cliente";
        }
    }

    else if (isset($_POST['nome'])) {
        $clienteObj->setNome($_POST['nome']);
        $clienteObj->setCpf($_POST['cpf']);
        $clienteObj->setTelefone($_POST['telefone']);
        $clienteObj->setEmail($_POST['email']);

        if (!empty($_POST['id_cliente'])) {
            $clienteObj->setID($_POST['id_cliente']);
            $clienteObj->update();
        } else {
            $clienteObj->insert();
        }

        header("Location: form_cliente.php");
        exit;
    }
}
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

        <form action="form_cliente.php" method="POST">
            <input type="hidden" name="id_cliente" value="<?= $dadosCliente['id_cliente'] ?>">

            <label>
                Nome
                <input type="text" name="nome" value="<?= htmlspecialchars($dadosCliente['nome']) ?>" required>
            </label>

            <label>
                CPF
                <input type="text" name="cpf" value="<?= htmlspecialchars($dadosCliente['cpf']) ?>">
            </label>

            <label>
                Telefone
                <input type="text" name="telefone" value="<?= htmlspecialchars($dadosCliente['telefone']) ?>">
            </label>

            <label>
                Email
                <input type="email" name="email" value="<?= htmlspecialchars($dadosCliente['email']) ?>">
            </label>

            <button type="submit">Salvar</button>
            <?php if (!empty($dadosCliente['id_cliente'])): ?>
                <a href="form_cliente.php" class="botao" style="background-color: var(--fundo-destaque); color: var(--texto-principal); margin-top: 6px;">Cancelar Edição</a>
            <?php endif; ?>
        </form>

        <table>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>CPF</td>
                <td>Telefone</td>
                <td>Email</td>
                <td>Ações</td>
            </tr>
            <?php foreach ($listaClientes as $c): ?>
            <tr>
                <td><?= $c['id_cliente'] ?></td>
                <td><?= htmlspecialchars($c['nome']) ?></td>
                <td><?= htmlspecialchars($c['cpf']) ?></td>
                <td><?= htmlspecialchars($c['telefone']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td>
                    
                    <form action="form_cliente.php" method="POST" style="display:inline; margin:0; padding:0;" onsubmit="return confirm('Deseja excluir este cliente?')">
                        <input type="hidden" name="acao" value="deletar">
                        <input type="hidden" name="id_cliente" value="<?= $c['id_cliente'] ?>">
                        <button type="submit" style="display:inline-block; padding:4px 8px; font-size:0.8rem; margin:0; cursor:pointer; background-color:#3b181a; color:#f87171; border:1px solid #7f1d1d; border-radius:4px; font-weight:700;">[X]</button>
                    </form>

                    <form action="form_cliente.php" method="POST" style="display:inline; margin:0; padding:0;">
                        <input type="hidden" name="acao" value="carregar_edicao">
                        <input type="hidden" name="id_cliente" value="<?= $c['id_cliente'] ?>">
                        <button type="submit" style="display:inline-block; padding:4px 8px; font-size:0.8rem; margin:0; cursor:pointer; background-color:#1e293b; color:#93c5fd; border:1px solid #334155; border-radius:4px; font-weight:600;">Editar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>