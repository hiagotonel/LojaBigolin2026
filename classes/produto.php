<?php
require "../conexao.php";
class Produto{
    private $id_produto;
    private $nome;
    private $preco;
    private $descricao;
    private $status;
    private $pdo;

    public function __construct(){
        $this->pdo = getConexao();
    }

    //getters e setters
    public function getID(){ return $this->id_produto;}
    public function getNome(){ return $this->nome;}
    public function getPreco(){ return $this->preco;}
    public function getDescricao(){ return $this->descricao;}
    public function getStatus(){ return $this->status;}

    public function setID($id_produto){ $this->id_produto = $id_produto;}
    public function setNome($nome){ $this->nome = $nome;}
    public function setPreco($preco){ $this->preco = $preco;}
    public function setDescricao($descricao){ $this->descricao = $descricao;}
    public function setStatus($status){ $this->status = $status;}
}