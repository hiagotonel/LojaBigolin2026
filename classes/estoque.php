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
    public function insert(){
        if($this->id_estoque){
            $this->update();
        }
        else{
            $stmt = $this->pdo->prepare("INSERT INTO estoque (quantidade, pavilhao) VALUES (:quantidade, :pavilhao)");
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":pavilhao", $this->pavilhao);
        }
        return $stmt->execute();
    }
    public function delete(){
        $stmt = $this->pdo->prepare("DELETE FROM estoque WHERE id_estoque = :id");
        $stmt->bindParam(":id", $this->id_estoque);
        return $stmt->execute();
    }
    public function update(){
        $stmt = $this->pdo->prepare("UPDATE estoque SET quantidade = :quantidade, pavilhao = :pavilhao WHERE id_estoque = :id");
        $stmt->bindParam(":quantidade", $this->quantidade);
        $stmt->bindParam(":pavilhao", $this->pavilhao);
        $stmt->bindParam(":id", $this->id_estoque);
        return $stmt->execute();
    }
    public function select(){
        $stmt = $this->pdo->prepare("SELECT * FROM estoque WHERE id_estoque = :id");
        $stmt->bindParam(":id", $this->id_estoque);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function selectAll(){
        $stmt = getConexao()->query("SELECT * FROM estoque");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}