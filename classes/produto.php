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
    public function insert(){
        if($this->id_produto){
            $this->update();
        }
        else{
            $stmt = $this->pdo->prepare("INSERT INTO produto (nome, preco, descricao, status) VALUES (:nome, :preco, :descricao, :status)");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":descricao", $this->descricao);
            $stmt->bindParam(":status", $this->status);
        }
        return $stmt->execute();
    }

    public function delete(){
        $stmt = $this->pdo->prepare("DELETE FROM produto WHERE id_produto = :id");
        $stmt->bindParam(":id", $this->id_produto);
        return $stmt->execute();
    }
    public function update(){
        $stmt = $this->pdo->prepare("UPDATE produto SET nome = :nome, preco = :preco, descricao = :descricao, status = :status WHERE id_produto = :id");
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id_produto);
        return $stmt->execute();
    }
    public function select(){
        $stmt = $this->pdo->prepare("SELECT * FROM produto WHERE id_produto = :id");
        $stmt->bindParam(":id", $this->id_produto);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function selectAll(){
        $stmt = getConexao()->query("SELECT * FROM produto");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}