<?php
require_once "../classes/estoque.php";

$estoqueObj = new Estoque();
$listaEstoque = Estoque::selectAll();
$dadosEstoque = ['id_estoque' => '', 'id_produto' => '', 'quantidade' => '', 'pavilhao' => ''];
$tituloForm = "Cadastrar Estoque";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['acao']) && $_POST['acao'] === 'deletar' && !empty($_POST['id_estoque'])) {
        $estoqueObj->setID($_POST['id_estoque']);
        $estoqueObj->delete();
        header("Location: form_estoque.php");
        exit;
    }

    else if (isset($_POST['acao']) && $_POST['acao'] === 'carregar_edicao' && !empty($_POST['id_estoque'])) {
        $estoqueObj->setID($_POST['id_estoque']);
        $registro = $estoqueObj->select();
        if ($registro) {
            $dadosEstoque = $registro;
            $tituloForm = "Atualizar Estoque";
        }
    }

    else if (isset($_POST['id_produto'])) {
        $estoqueObj->setIdProduto($_POST['id_produto']);
        $estoqueObj->setQuantidade($_POST['quantidade']);
        $estoqueObj->setPavilhao($_POST['pavilhao']);

        if (!empty($_POST['id_estoque'])) {
            $estoqueObj->setID($_POST['id_estoque']);
            $estoqueObj->update();
        } else {
            $estoqueObj->insert();
        }

        header("Location: form_estoque.php");
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

        <form action="form_estoque.php" method="POST">
            <input type="hidden" name="id_estoque" value="<?= $dadosEstoque['id_estoque'] ?>">

            <label>
                ID Produto
                <input type="number" name="id_produto" value="<?= htmlspecialchars($dadosEstoque['id_produto']) ?>" required>
            </label>

            <label>
                Quantidade
                <input type="number" name="quantidade" value="<?= htmlspecialchars($dadosEstoque['quantidade']) ?>" required>
            </label>

            <label>
                Pavilhão
                <input type="text" name="pavilhao" value="<?= htmlspecialchars($dadosEstoque['pavilhao']) ?>">
            </label>

            <button type="submit">Salvar</button>
            <?php if (!empty($dadosEstoque['id_estoque'])): ?>
                <a href="form_estoque.php" class="botao" style="background-color: var(--fundo-destaque); color: var(--texto-principal); margin-top: 6px;">Cancelar Edição</a>
            <?php endif; ?>
        </form>

        <table>
            <tr>
                <td>ID</td>
                <td>ID Produto</td>
                <td>Quantidade</td>
                <td>Pavilhão</td>
                <td>Ações</td>
            </tr>
            <?php foreach ($listaEstoque as $e): ?>
            <tr>
                <td><?= $e['id_estoque'] ?></td>
                <td><?= htmlspecialchars($e['id_produto']) ?></td>
                <td><?= htmlspecialchars($e['quantidade']) ?></td>
                <td><?= htmlspecialchars($e['pavilhao']) ?></td>
                <td>
                    <form action="form_estoque.php" method="POST" style="display:inline; margin:0; padding:0;" onsubmit="return confirm('Deseja excluir este estoque?')">
                        <input type="hidden" name="acao" value="deletar">
                        <input type="hidden" name="id_estoque" value="<?= $e['id_estoque'] ?>">
                        <button type="submit" style="display:inline-block; padding:4px 8px; font-size:0.8rem; margin:0; cursor:pointer; background-color:#3b181a; color:#f87171; border:1px solid #7f1d1d; border-radius:4px; font-weight:700;">[X]</button>
                    </form>

                    <form action="form_estoque.php" method="POST" style="display:inline; margin:0; padding:0;">
                        <input type="hidden" name="acao" value="carregar_edicao">
                        <input type="hidden" name="id_estoque" value="<?= $e['id_estoque'] ?>">
                        <button type="submit" style="display:inline-block; padding:4px 8px; font-size:0.8rem; margin:0; cursor:pointer; background-color:#1e293b; color:#93c5fd; border:1px solid #334155; border-radius:4px; font-weight:600;">Editar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>