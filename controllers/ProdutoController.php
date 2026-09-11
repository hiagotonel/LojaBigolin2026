<?php
require_once "models/produto.php";
class ProdutoController{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function listar(){
        $model = new Produto($this->db);
        $produtos = $model->selectAll(); 

        require_once "views/produto/listar.php";
    }
}