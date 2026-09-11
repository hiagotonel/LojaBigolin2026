<?php
require_once __DIR__ . "/../conexao.php";

class Marcas {
    private $id_marca;
    private $nome;
    private $pais;
    private $pdo;

    public function __construct() {
        $this->pdo = getConexao();
    }

    public function getID() { return $this->id_marca; }
    public function getNome() { return $this->nome; }
    public function getPais() { return $this->pais; }

    public function setID($id_marca) { $this->id_marca = $id_marca; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setPais($pais) { $this->pais = $pais; }

    public function insert() {
        $stmt = $this->pdo->prepare("INSERT INTO marcas (nome, pais) VALUES (:nome, :pais)");
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":pais", $this->pais);
        $ok = $stmt->execute();
        if($ok){
            $this->id_marca = $this->pdo->lastInsertId();
        }
        return $ok;
    }

    public function update() {
        $stmt = $this->pdo->prepare("UPDATE marcas SET nome = :nome, pais = :pais WHERE id_marca = :id");
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":pais", $this->pais);
        $stmt->bindParam(":id", $this->id_marca);
        $ok = $stmt->execute();
        if($ok){
            $this->id_marca = $this->pdo->lastInsertId();
        }
        return $ok;
    }

    public function delete() {
        $stmt = $this->pdo->prepare("DELETE FROM marcas WHERE id_marca = :id");
        $stmt->bindParam(":id", $this->id_marca);
        return $stmt->execute();
    }

    public function select() {
        $stmt = $this->pdo->prepare("SELECT * FROM marcas WHERE id_marca = :id");
        $stmt->bindParam(":id", $this->id_marca);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->setNome($dados['nome']);
        $this->setPais($dados['pais']);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function selectAll() {
        $stmt = getConexao()->query("SELECT * FROM marcas ORDER BY id_marca DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}