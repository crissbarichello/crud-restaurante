<?php

class ProdutoModel {
    private $db;

    public function __construct($conexao) {
        $this->db = $conexao;
    }

    // INSERT dentro da classe ProdutoModel
    public function inserir($nome, $preco, $categoria) {
        $sql = "INSERT INTO produtos (nome, preco, categoria) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([$nome, $preco, $categoria]);
    }

    // SELECT dentro da classe ProdutoModel
    public function ler() {
        $sql = "SELECT id, nome, preco, categoria FROM produtos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        // Retorna uma matriz com todos os produtos encontrados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE dentro da classe ProdutoModel
    public function atualizar($id, $nome, $preco, $categoria) {
        // Atualiza apenas o produto que possui o ID correspondente
        $sql = "UPDATE produtos SET nome = ?, preco = ?, categoria = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        
        // Retorna true se a atualização deu certo, ou false se falhou
        return $stmt->execute([$nome, $preco, $categoria, $id]);
    }

    // DELETE dentro da classe ProdutoModel
    public function deletar($id) {
        // Apaga apenas o produto com o ID correspondente
        $sql = "DELETE FROM produtos WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        
        // Retorna true em caso de sucesso ou false em caso de falha
        return $stmt->execute([$id]);
    }
}