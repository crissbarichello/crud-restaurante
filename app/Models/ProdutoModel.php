<?php

class ProdutoModel {
    private $db;

    public function __construct($conexao) {
        $this->db = $conexao;
    }

    public function buscarTodos() {
        $sql = "SELECT * FROM produtos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // SELECT dentro da classe ProdutoModel
    public function buscarPorId($id) {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     public function criar($dados) {
        $sql = "INSERT INTO produtos (nome, preco, categoria) VALUES (:nome, :preco, :categoria)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['nome' => $dados['nome'], 'preco' => $dados['preco'], 'categoria' => $dados['categoria']]);
        return $this->db->lastInsertId();
    }
    // UPDATE dentro da classe ProdutoModel
    public function atualizar($id, $dados) {
        // Atualiza apenas o produto que possui o ID correspondente
        $sql = "UPDATE produtos SET nome = :nome, preco = :preco, categoria = :categoria WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['nome' => $dados['nome'], 'preco' => $dados['preco'], 'categoria' => $dados['categoria'], 'id' => $id]);
        return $stmt->rowCount() > 0;
    }

    // DELETE dentro da classe ProdutoModel
    public function excluir($id) {
        // Apaga apenas o produto com o ID correspondente
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}