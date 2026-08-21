<?php
require_once "../classes/pedido.php";

$pedidoObj = new Pedido();
$listaPedidos = Pedido::selectAll();
$dadosPedido = ['id_pedido' => '', 'id_produto' => '', 'id_cliente' => '', 'data' => '', 'preco' => '', 'quantidade' => '', 'status' => ''];
$tituloForm = "Cadastrar Pedido";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['acao']) && $_POST['acao'] === 'deletar' && !empty($_POST['id_pedido'])) {
        $pedidoObj->setID($_POST['id_pedido']);
        $pedidoObj->delete();
        header("Location: form_pedido.php");
        exit;
    }

    else if (isset($_POST['acao']) && $_POST['acao'] === 'carregar_edicao' && !empty($_POST['id_pedido'])) {
        $pedidoObj->setID($_POST['id_pedido']);
        $registro = $pedidoObj->select();
        if ($registro) {
            $dadosPedido = $registro;
            $tituloForm = "Atualizar Pedido";
        }
    }

    else if (isset($_POST['id_produto'])) {
        $pedidoObj->setIdProduto($_POST['id_produto']);
        $pedidoObj->setIdCliente($_POST['id_cliente']);
        $pedidoObj->setData($_POST['data']);
        $pedidoObj->setPreco($_POST['preco']);
        $pedidoObj->setQuantidade($_POST['quantidade']);
        $pedidoObj->setStatus($_POST['status']);

        if (!empty($_POST['id_pedido'])) {
            $pedidoObj->setID($_POST['id_pedido']);
            $pedidoObj->update();
        } else {
            $pedidoObj->insert();
        }

        header("Location: form_pedido.php");
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

        <form action="form_pedido.php" method="POST">
            <input type="hidden" name="id_pedido" value="<?= $dadosPedido['id_pedido'] ?>">

            <label>
                ID Produto
                <input type="number" name="id_produto" value="<?= htmlspecialchars($dadosPedido['id_produto']) ?>" required>
            </label>

            <label>
                ID Cliente
                <input type="number" name="id_cliente" value="<?= htmlspecialchars($dadosPedido['id_cliente']) ?>" required>
            </label>

            <label>
                Data
                <input type="date" name="data" value="<?= htmlspecialchars($dadosPedido['data']) ?>" required>
            </label>

            <label>
                Preço
                <input type="text" name="preco" value="<?= htmlspecialchars($dadosPedido['preco']) ?>" required>
            </label>

            <label>
                Quantidade
                <input type="number" name="quantidade" value="<?= htmlspecialchars($dadosPedido['quantidade']) ?>" required>
            </label>

            <label>
                Status
                <input type="text" name="status" value="<?= htmlspecialchars($dadosPedido['status']) ?>">
            </label>

            <button type="submit">Salvar</button>
            <?php if (!empty($dadosPedido['id_pedido'])): ?>
                <a href="form_pedido.php" class="botao" style="background-color: var(--fundo-destaque); color: var(--texto-principal); margin-top: 6px;">Cancelar Edição</a>
            <?php endif; ?>
        </form>

        <table>
            <tr>
                <td>ID</td>
                <td>ID Produto</td>
                <td>ID Cliente</td>
                <td>Data</td>
                <td>Preço</td>
                <td>Quantidade</td>
                <td>Status</td>
                <td>Ações</td>
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
                <td>
                    <form action="form_pedido.php" method="POST" style="display:inline; margin:0; padding:0;" onsubmit="return confirm('Deseja excluir este pedido?')">
                        <input type="hidden" name="acao" value="deletar">
                        <input type="hidden" name="id_pedido" value="<?= $p['id_pedido'] ?>">
                        <button type="submit" style="display:inline-block; padding:4px 8px; font-size:0.8rem; margin:0; cursor:pointer; background-color:#3b181a; color:#f87171; border:1px solid #7f1d1d; border-radius:4px; font-weight:700;">[X]</button>
                    </form>

                    <form action="form_pedido.php" method="POST" style="display:inline; margin:0; padding:0;">
                        <input type="hidden" name="acao" value="carregar_edicao">
                        <input type="hidden" name="id_pedido" value="<?= $p['id_pedido'] ?>">
                        <button type="submit" style="display:inline-block; padding:4px 8px; font-size:0.8rem; margin:0; cursor:pointer; background-color:#1e293b; color:#93c5fd; border:1px solid #334155; border-radius:4px; font-weight:600;">Editar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>