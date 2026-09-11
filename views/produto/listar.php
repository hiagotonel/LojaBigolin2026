<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Bigolin 2026</title>
</head>
<body>
    <h1>Produtos</h1>
    <a href="index.php?modulo=cliente$acao=criar">Novo Cliente</a>

    <ul>
        <?php foreach ($produto as $p): ?>
            <li>
                <?= htmlspecialchars($p['nome'])?>
                R$ <?= htmlspecialchars($p['preco'])?>

            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>