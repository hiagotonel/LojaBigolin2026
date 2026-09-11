<?php
require_once "models/cliente.php";
class ClienteController{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function listar(){
        $model = new Cliente($this->db);
        $cliente = $model->selectAll(); 

        require_once "views/cliente/listar.php";
    }
}