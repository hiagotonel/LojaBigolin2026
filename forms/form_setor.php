<?php
require_once "../classes/setor.php";

$setorObj = new Setor();
$listaSetor = Setor::selectAll();
$dadosSetor = ['id_setor' => '', 'nome' => '', 'descricao' => ''];
$tituloForm = "Cadastrar Setor";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['acao']) && $_POST['acao'] === 'deletar' && !empty($_POST['id_setor'])) {
        $setorObj->setID($_POST['id_setor']);
        $setorObj->delete();
        header("Location: form_setor.php");
        exit;
    }

    else if (isset($_POST['acao']) && $_POST['acao'] === 'carregar_edicao' && !empty($_POST['id_setor'])) {
        $setorObj->setID($_POST['id_setor']);
        $registro = $setorObj->select();
        if ($registro) {
            $dadosSetor = $registro;
            $tituloForm = "Atualizar Setor";
        }
    }

    else if (isset($_POST['nome'])) {
        $setorObj->setNome($_POST['nome']);
        $setorObj->setDescricao($_POST['descricao']);

        if (!empty($_POST['id_setor'])) {
            $setorObj->setID($_POST['id_setor']);
            $setorObj->update();
        } else {
            $setorObj->insert();
        }

        header("Location: form_setor.php");
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

        <form action="form_setor.php" method="POST">
            <input type="hidden" name="id_setor" value="<?= $dadosSetor['id_setor'] ?>">

            <label>
                Nome
                <input type="text" name="nome" value="<?= htmlspecialchars($dadosSetor['nome']) ?>" required>
            </label>

            <label>
                Descrição
                <input type="text" name="descricao" value="<?= htmlspecialchars($dadosSetor['descricao']) ?>">
            </label>

            <button type="submit">Salvar</button>
            <?php if (!empty($dadosSetor['id_setor'])): ?>
                <a href="form_setor.php" class="botao" style="background-color: var(--fundo-destaque); color: var(--texto-principal); margin-top: 6px;">Cancelar Edição</a>
            <?php endif; ?>
        </form>

        <table>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>Descrição</td>
                <td>Ações</td>
            </tr>
            <?php foreach ($listaSetor as $s): ?>
            <tr>
                <td><?= $s['id_setor'] ?></td>
                <td><?= htmlspecialchars($s['nome']) ?></td>
                <td><?= htmlspecialchars($s['descricao']) ?></td>
                <td>
                    <form action="form_setor.php" method="POST" style="display:inline; margin:0; padding:0;" onsubmit="return confirm('Deseja excluir este setor?')">
                        <input type="hidden" name="acao" value="deletar">
                        <input type="hidden" name="id_setor" value="<?= $s['id_setor'] ?>">
                        <button type="submit" style="display:inline-block; padding:4px 8px; font-size:0.8rem; margin:0; cursor:pointer; background-color:#3b181a; color:#f87171; border:1px solid #7f1d1d; border-radius:4px; font-weight:700;">[X]</button>
                    </form>

                    <form action="form_setor.php" method="POST" style="display:inline; margin:0; padding:0;">
                        <input type="hidden" name="acao" value="carregar_edicao">
                        <input type="hidden" name="id_setor" value="<?= $s['id_setor'] ?>">
                        <button type="submit" style="display:inline-block; padding:4px 8px; font-size:0.8rem; margin:0; cursor:pointer; background-color:#1e293b; color:#93c5fd; border:1px solid #334155; border-radius:4px; font-weight:600;">Editar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>