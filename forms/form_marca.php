<?php
require_once "../classes/marcas.php";

$marcaObj = new Marcas();
$listaMarcas = Marcas::selectAll();
$dadosMarca = ['id_marca' => '', 'nome' => '', 'pais' => ''];
$tituloForm = "Cadastrar Marca";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['acao']) && $_POST['acao'] === 'deletar' && !empty($_POST['id_marca'])) {
        $marcaObj->setID($_POST['id_marca']);
        $marcaObj->delete();
        header("Location: form_marca.php");
        exit;
    }

    else if (isset($_POST['acao']) && $_POST['acao'] === 'carregar_edicao' && !empty($_POST['id_marca'])) {
        $marcaObj->setID($_POST['id_marca']);
        $registro = $marcaObj->select();
        if ($registro) {
            $dadosMarca = $registro;
            $tituloForm = "Atualizar Marca";
        }
    }

    else if (isset($_POST['nome'])) {
        $marcaObj->setNome($_POST['nome']);
        $marcaObj->setPais($_POST['pais']);

        if (!empty($_POST['id_marca'])) {
            $marcaObj->setID($_POST['id_marca']);
            $marcaObj->update();
        } else {
            $marcaObj->insert();
        }

        header("Location: form_marca.php");
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

        <form action="form_marca.php" method="POST">
            <input type="hidden" name="id_marca" value="<?= $dadosMarca['id_marca'] ?>">

            <label>
                Nome
                <input type="text" name="nome" value="<?= htmlspecialchars($dadosMarca['nome']) ?>" required>
            </label>

            <label>
                País
                <input type="text" name="pais" value="<?= htmlspecialchars($dadosMarca['pais']) ?>">
            </label>

            <button type="submit">Salvar</button>
            <?php if (!empty($dadosMarca['id_marca'])): ?>
                <a href="form_marca.php" class="botao" style="background-color: var(--fundo-destaque); color: var(--texto-principal); margin-top: 6px;">Cancelar Edição</a>
            <?php endif; ?>
        </form>

        <table>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>País</td>
                <td>Ações</td>
            </tr>
            <?php foreach ($listaMarcas as $m): ?>
            <tr>
                <td><?= $m['id_marca'] ?></td>
                <td><?= htmlspecialchars($m['nome']) ?></td>
                <td><?= htmlspecialchars($m['pais']) ?></td>
                <td>
                    <form action="form_marca.php" method="POST" style="display:inline; margin:0; padding:0;" onsubmit="return confirm('Deseja excluir esta marca?')">
                        <input type="hidden" name="acao" value="deletar">
                        <input type="hidden" name="id_marca" value="<?= $m['id_marca'] ?>">
                        <button type="submit" style="display:inline-block; padding:4px 8px; font-size:0.8rem; margin:0; cursor:pointer; background-color:#3b181a; color:#f87171; border:1px solid #7f1d1d; border-radius:4px; font-weight:700;">[X]</button>
                    </form>

                    <form action="form_marca.php" method="POST" style="display:inline; margin:0; padding:0;">
                        <input type="hidden" name="acao" value="carregar_edicao">
                        <input type="hidden" name="id_marca" value="<?= $m['id_marca'] ?>">
                        <button type="submit" style="display:inline-block; padding:4px 8px; font-size:0.8rem; margin:0; cursor:pointer; background-color:#1e293b; color:#93c5fd; border:1px solid #334155; border-radius:4px; font-weight:600;">Editar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>