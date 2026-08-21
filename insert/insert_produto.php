<?php
    require "../conexao.php";
        $pdo = getConexao();
        $produto = new Produto();

        $produto->setNome($_POST['nome']);
        $produto->setPreco($_POST['preco']);
        $produto->setDescricao($_POST['descricao']);
        $produto->setStatus($_POST['status']);

        $produto->insert();

    header("Location: ../index.php");