<?php
    require "../conexao.php";
        $pdo = getConexao();
        $estoque = new Estoque();
        
        $estoque->setQuantidade($_POST['quantidade']);
        $estoque->setPavilhao($_POST['pavilhao']);

        $estoque->insert();

    header("Location: ../index.php");