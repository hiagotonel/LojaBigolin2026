<?php
    require "../conexao.php";
        $pdo = getConexao();
        $cliente = new Cliente();
        
        $cliente->setNome($_POST['nome']);
        $cliente->setCpf($_POST['cpf']);
        $cliente->setTelefone($_POST['telefone']);
        $cliente->setEmail($_POST['email']);

        $cliente->insert();

    header("Location: ../index.php");