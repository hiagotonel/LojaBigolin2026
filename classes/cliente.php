<?php
require_once __DIR__ . "/../conexao.php";

class Cliente {
    private $id_cliente;
    private $nome;
    private $cpf;
    private $telefone;
    private $email;
    private $pdo;

    public function __construct() {
        $this->pdo = getConexao();
    }

    // Getters
    public function getID() { return $this->id_cliente; }
    public function getNome() { return $this->nome; }
    public function getCpf() { return $this->cpf; }
    public function getTelefone() { return $this->telefone; }
    public function getEmail() { return $this->email; }

    // Setters
    public function setID($id_cliente) { $this->id_cliente = $id_cliente; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setCpf($cpf) { $this->cpf = $cpf; }
    public function setTelefone($telefone) { $this->telefone = $telefone; }
    public function setEmail($email) { $this->email = $email; }

    // Inserir novo cliente
    public function insert() {
        $stmt = $this->pdo->prepare("INSERT INTO cliente (nome, cpf, telefone, email) VALUES (:nome, :cpf, :telefone, :email)");
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        return $stmt->execute();
    }

    // Atualizar cliente existente
    public function update() {
        $stmt = $this->pdo->prepare("UPDATE cliente SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email WHERE id_cliente = :id");
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id", $this->id_cliente);
        return $stmt->execute();
    }

    // Deletar cliente
    public function delete() {
        $stmt = $this->pdo->prepare("DELETE FROM cliente WHERE id_cliente = :id");
        $stmt->bindParam(":id", $this->id_cliente);
        return $stmt->execute();
    }

    // Buscar 1 cliente pelo ID
    public function select() {
        $stmt = $this->pdo->prepare("SELECT * FROM cliente WHERE id_cliente = :id");
        $stmt->bindParam(":id", $this->id_cliente);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar todos os clientes
    public static function selectAll() {
        $stmt = getConexao()->query("SELECT * FROM cliente ORDER BY id_cliente DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}