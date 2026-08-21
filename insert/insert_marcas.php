<?php
    require "../conexao.php";
        $pdo = getConexao();
        $marca = new Marcas();

        $marca->setNome($_POST['nome']);
        $marca->setPais($_POST['pais']);

        $marca->insert();
        
    header("Location: ../index.php");