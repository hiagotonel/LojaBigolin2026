<?php
    require "../conexao.php";
        $pdo = getConexao();
        $pedido = new Pedido();

        $pedido->setPreco($_POST['preco']);
        $pedido->setQuantidade($_POST['quantidade']);
        $pedido->setData($_POST['data']);
        $pedido->setStatus($_POST['status']);

        $pedido->insert();

    header("Location: ../index.php");