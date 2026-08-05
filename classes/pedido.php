<?php
require "../conexao.php";
class pedido{
    private $id_pedido;
    private $data;
    private $preco;
    private $quantidade;
    private $status;
    private $pdo;

    public function __construct(){
        $this->pdo = getConexao();
    }

    //getters e setters
    public function getID(){ return $this->id_pedido;}
    public function getData(){ return $this->data;}
    public function getPreco(){ return $this->preco;}
    public function getQuantidade(){ return $this->quantidade;}
    public function getStatus(){ return $this->status;}
    public function setID($id_pedido){ $this->id_pedido = $id_pedido;}
    public function setData($data){ $this->data = $data;}
    public function setPreco($preco){ $this->preco = $preco;}
    public function setQuantidade($quantidade){ $this->quantidade = $quantidade;}
    public function setStatus($status){ $this->status = $status;}
    public function salvar(){
        $stmt = $this->pdo->prepare("INSERT INTO pedido (data, preco, quantidade, status) VALUES (:data, :preco, :quantidade, :status)");
        $stmt->bindParam(":data", $this->data);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":quantidade", $this->quantidade);
        $stmt->bindParam(":status", $this->status);
        return $stmt->execute();
    }
}