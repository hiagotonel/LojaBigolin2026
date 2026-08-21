<?php
require_once __DIR__ . "/../conexao.php";

class Setor {
    private $id_setor;
    private $nome;
    private $descricao;
    private $pdo;

    public function __construct() {
        $this->pdo = getConexao();
    }

    public function getID() { return $this->id_setor; }
    public function getNome() { return $this->nome; }
    public function getDescricao() { return $this->descricao; }

    public function setID($id_setor) { $this->id_setor = $id_setor; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setDescricao($descricao) { $this->descricao = $descricao; }

    public function insert() {
        $stmt = $this->pdo->prepare("INSERT INTO setor (nome, descricao) VALUES (:nome, :descricao)");
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);
        $ok = $stmt->execute();
        if($ok){
            $this->id_setor = $this->pdo->lastInsertId();
        }
        return $ok;
    }

    public function update() {
        $stmt = $this->pdo->prepare("UPDATE setor SET nome = :nome, descricao = :descricao WHERE id_setor = :id");
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":id", $this->id_setor);
        $ok = $stmt->execute();
        if($ok){
            $this->id_setor = $this->pdo->lastInsertId();
        }
        return $ok;
    }

    public function delete() {
        $stmt = $this->pdo->prepare("DELETE FROM setor WHERE id_setor = :id");
        $stmt->bindParam(":id", $this->id_setor);
        return $stmt->execute();
    }

    public function select() {
        $stmt = $this->pdo->prepare("SELECT * FROM setor WHERE id_setor = :id");
        $stmt->bindParam(":id", $this->id_setor);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->setNome($dados['nome']);
        $this->setDescricao($dados['descricao']);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function selectAll() {
        $stmt = getConexao()->query("SELECT * FROM setor ORDER BY id_setor DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}