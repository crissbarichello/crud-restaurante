<?php
class UsuarioModel {
    private $db;

    public function __construct($conexao) {
        $this->db = $conexao;
    }

    // INSERT dentro da classe UsuarioModel
    public function inserir($nome, $email, $senha) {
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        
        // Criptografa a senha por segurança
        $senhaCripto = password_hash($senha, PASSWORD_DEFAULT);
        
        return $stmt->execute([$nome, $email, $senhaCripto]);
    }

    // SELECT dentro da classe UsuarioModel
    public function ler() {
        $sql = "SELECT id, nome, email, criado_em FROM usuarios";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        // Retorna uma matriz com todos os usuários encontrados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE dentro da classe UsuarioModel
    public function atualizar($id, $nome, $email) {
        // Atualiza apenas o usuário que possui o ID correspondente
        $sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        
        // Retorna true se a atualização deu certo, ou false se falhou
        return $stmt->execute([$nome, $email, $id]);
    }

    // DELETE dentro da classe UsuarioModel
    public function deletar($id) {
        // Apaga apenas o usuário com o ID correspondente
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        
        // Retorna true em caso de sucesso ou false em caso de falha
        return $stmt->execute([$id]);
    }
}