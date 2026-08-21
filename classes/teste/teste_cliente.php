<?php
require_once '../cliente.php';

$cliente = new Cliente();
$cliente->setCpf('07120961109');
$cliente->setNome('hiago teste da silva');
$cliente->setEmail('hiagoscheltz@gmail.com');
$cliente->setTelefone('99367990');
// $cliente->insert();

// var_dump($cliente);

//select()

$cliente2 = new Cliente();
$cliente2->setID(1);
$dados = $cliente2->select();

var_dump($dados);