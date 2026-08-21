<?php
require_once "../classes/produto.php";

$produtoObj = new Produto();
$listaProdutos = Produto::selectAll();
$dadosProduto = ['id_produto' => '', 'id_marca' => '', 'id_setor' => '', 'nome' => '', 'preco' => '', 'descricao' => '', 'status' => ''];
$tituloForm = "Cadastrar Produto";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['acao']) && $_POST['acao'] === 'deletar' && !empty($_POST['id_produto'])) {
        $produtoObj->setID($_POST['id_produto']);
        $produtoObj->delete();
        header("Location: form_produto.php");
        exit;
    }

    else if (isset($_POST['acao']) && $_POST['acao'] === 'carregar_edicao' && !empty($_POST['id_produto'])) {
        $produtoObj->setID($_POST['id_produto']);
        $registro = $produtoObj->select();
        if ($registro) {
            $dadosProduto = $registro;
            $tituloForm = "Atualizar Produto";
        }
    }

    else if (isset($_POST['nome'])) {
        $produtoObj->setIdMarca($_POST['id_marca']);
        $produtoObj->setIdSetor($_POST['id_setor']);
        $produtoObj->setNome($_POST['nome']);
        $produtoObj->setPreco($_POST['preco']);
        $produtoObj->setDescricao($_POST['descricao']);
        $produtoObj->setStatus($_POST['status']);

        if (!empty($_POST['id_produto'])) {
            $produtoObj->setID($_POST['id_produto']);
            $produtoObj->update();
        } else {
            $produtoObj->insert();
        }

        header("Location: form_produto.php");
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

        <form action="form_produto.php" method="POST">
            <input type="hidden" name="id_produto" value="<?= $dadosProduto['id_produto'] ?>">

            <label>
                ID Marca
                <input type="number" name="id_marca" value="<?= htmlspecialchars($dadosProduto['id_marca']) ?>" required>
            </label>

            <label>
                ID Setor
                <input type="number" name="id_setor" value="<?= htmlspecialchars($dadosProduto['id_setor']) ?>" required>
            </label>

            <label>
                Nome
                <input type="text" name="nome" value="<?= htmlspecialchars($dadosProduto['nome']) ?>" required>
            </label>

            <label>
                Preço
                <input type="text" name="preco" value="<?= htmlspecialchars($dadosProduto['preco']) ?>" required>
            </label>

            <label>
                Descrição
                <input type="text" name="descricao" value="<?= htmlspecialchars($dadosProduto['descricao']) ?>">
            </label>

            <label>
                Status
                <input type="text" name="status" value="<?= htmlspecialchars($dadosProduto['status']) ?>">
            </label>

            <button type="submit">Salvar</button>
            <?php if (!empty($dadosProduto['id_produto'])): ?>
                <a href="form_produto.php" class="botao" style="background-color: var(--fundo-destaque); color: var(--texto-principal); margin-top: 6px;">Cancelar Edição</a>
            <?php endif; ?>
        </form>

        <table>
            <tr>
                <td>ID</td>
                <td>Marca</td>
                <td>Setor</td>
                <td>Nome</td>
                <td>Preço</td>
                <td>Descrição</td>
                <td>Status</td>
                <td>Ações</td>
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
                <td>
                    <form action="form_produto.php" method="POST" style="display:inline; margin:0; padding:0;" onsubmit="return confirm('Deseja excluir este produto?')">
                        <input type="hidden" name="acao" value="deletar">
                        <input type="hidden" name="id_produto" value="<?= $p['id_produto'] ?>">
                        <button type="submit" style="display:inline-block; padding:4px 8px; font-size:0.8rem; margin:0; cursor:pointer; background-color:#3b181a; color:#f87171; border:1px solid #7f1d1d; border-radius:4px; font-weight:700;">[X]</button>
                    </form>

                    <form action="form_produto.php" method="POST" style="display:inline; margin:0; padding:0;">
                        <input type="hidden" name="acao" value="carregar_edicao">
                        <input type="hidden" name="id_produto" value="<?= $p['id_produto'] ?>">
                        <button type="submit" style="display:inline-block; padding:4px 8px; font-size:0.8rem; margin:0; cursor:pointer; background-color:#1e293b; color:#93c5fd; border:1px solid #334155; border-radius:4px; font-weight:600;">Editar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>