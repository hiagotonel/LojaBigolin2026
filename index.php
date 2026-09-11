<?php 
    require_once "confih.php";

    $modulo = $_GET['modulo'] ?? 'cliente';
    $acao = $_GET['acao'] ?? 'listar';

    $controllerNome = ucfirst($modulo) . "Controller";
    $arquivoController = "controllers/{$controllerNome}.php";

    if (file_exists($arquivoController)){
        require_once $arquivoController;
        $controller = new $controllerNome($db);
        if(method_exists($controller, $acao)){
            $controller->$acao;
        }
        else{
            echo "Ação não encontrada!";
        }
    } else {
        echo "Página não encontrada";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Loja Bigolin</title>
</head>
<body>
    <?php require "pages/header.php"; ?>
    <main>
        <h1>Bem-vindo a Loja Bigolin!</h1>
        <h3>O que deseja fazer hoje?</h3>
        <ul>
            <li><a href="pages/insert.php">CRUD Completo</a></li>
            <li><a href="pages/select.php">Ver Dados</a></li>
        </ul>
    </main>
</body>
</html>