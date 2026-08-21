<?php
require_once __DIR__ . "/../conexao.php";

class Estoque {
    private $id_estoque;
    private $id_produto;
    private $quantidade;
    private $pavilhao;
    private $pdo;

    public function __construct() {
        $this->pdo = getConexao();
    }

    public function getID() { return $this->id_estoque; }
    public function getIdProduto() { return $this->id_produto; }
    public function getQuantidade() { return $this->quantidade; }
    public function getPavilhao() { return $this->pavilhao; }

    public function setID($id_estoque) { $this->id_estoque = $id_estoque; }
    public function setIdProduto($id_produto) { $this->id_produto = $id_produto; }
    public function setQuantidade($quantidade) { $this->quantidade = $quantidade; }
    public function setPavilhao($pavilhao) { $this->pavilhao = $pavilhao; }

    public function insert() {
        $stmt = $this->pdo->prepare("INSERT INTO estoque (id_produto, quantidade, pavilhao) VALUES (:id_produto, :quantidade, :pavilhao)");
        $stmt->bindParam(":id_produto", $this->id_produto);
        $stmt->bindParam(":quantidade", $this->quantidade);
        $stmt->bindParam(":pavilhao", $this->pavilhao);
        return $stmt->execute();
    }

    public function update() {
        $stmt = $this->pdo->prepare("UPDATE estoque SET id_produto = :id_produto, quantidade = :quantidade, pavilhao = :pavilhao WHERE id_estoque = :id");
        $stmt->bindParam(":id_produto", $this->id_produto);
        $stmt->bindParam(":quantidade", $this->quantidade);
        $stmt->bindParam(":pavilhao", $this->pavilhao);
        $stmt->bindParam(":id", $this->id_estoque);
        return $stmt->execute();
    }

    public function delete() {
        $stmt = $this->pdo->prepare("DELETE FROM estoque WHERE id_estoque = :id");
        $stmt->bindParam(":id", $this->id_estoque);
        return $stmt->execute();
    }

    public function select() {
        $stmt = $this->pdo->prepare("SELECT * FROM estoque WHERE id_estoque = :id");
        $stmt->bindParam(":id", $this->id_estoque);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function selectAll() {
        $stmt = getConexao()->query("SELECT * FROM estoque ORDER BY id_estoque DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}