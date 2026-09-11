<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Bigolin 2026</title>
</head>
<body>
    <h1>Clientes</h1>
    <a href="index.php?modulo=cliente$acao=criar">Novo Cliente</a>

    <ul>
        <?php foreach ($cliente as $c): ?>
            <li>
                <?= htmlspecialchars($c['nome'])?>

            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>