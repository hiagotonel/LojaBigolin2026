<?php
require_once '../../conexao.php';
require_once '../cliente.php';
$pdo = getConexao();
$pdo->exec('delete from pedido; ');

$pdo->exec("delete from  cliente where email = 'hiagoscheltz@gmail.com'");


$cliente = new Cliente();
$cliente->setCpf('071209611');
$cliente->setNome('hiago teste da silva');
$cliente->setEmail('hiagoscheltz@gmail.com');
$cliente->setTelefone('9936798');
$cliente->insert();
var_dump($cliente);

echo '<hr>';
$cliente2 = new Cliente();
$cliente2->setID(25);
var_dump($cliente2->select());
echo '<hr>';
var_dump($cliente2);