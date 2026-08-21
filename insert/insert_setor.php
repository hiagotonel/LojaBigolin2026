<?php
    require "../conexao.php";
        $pdo = getConexao();
        $setor = new Setor();

        $setor->setNome($_POST['nome']);
        $setor->setDescricao($_POST['descricao']);

        $setor->insert();

    header("Location: ../index.php");