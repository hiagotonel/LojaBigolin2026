<?php
require "../conexao.php";
class estoque{
    private $id_estoque;
    private $quantidade;
    private $pavilhao;
    private $pdo;

    public function __construct(){
        $this->pdo = getConexao();
    }

    //getters e setters
    public function getID(){ return $this->id_estoque;}
    public function getQuantidade(){ return $this->quantidade;}
    public function getPavilhao(){ return $this->pavilhao;}
    public function setID($id_estoque){ $this->id_estoque = $id_estoque;}
    public function setQuantidade($quantidade){ $this->quantidade = $quantidade;}
    public function setPavilhao($pavilhao){ $this->pavilhao = $pavilhao;}
    public function salvar(){
        $stmt = $this->pdo->prepare("INSERT INTO estoque (quantidade, pavilhao) VALUES (:quantidade, :pavilhao)");
        $stmt->bindParam(":quantidade", $this->quantidade);
        $stmt->bindParam(":pavilhao", $this->pavilhao);
        return $stmt->execute();
    }
}