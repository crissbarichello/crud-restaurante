<?php
// LOCAL: app/Controllers/ProdutoController.php

require "../app/Models/ProdutoModel.php";

class ProdutoController {

    // Mostra a página única: form (vazio ou preenchido) + lista
    public function home_produto($pdo, $id = null) {
        $model = new ProdutoModel($pdo);
        $produtos = $model->buscarTodos();
        $produtoEditando = $id ? $model->buscarPorId($id) : null;
        require "../Views/cardapio.php";
    }

    public function cadastrar_produto($pdo) {
        $model = new ProdutoModel($pdo);
        $model->criar($_POST);
        header("Location: index.php");
        exit;
    }

    public function atualizar_produto($pdo, $id) {
        $model = new ProdutoModel($pdo);
        $model->atualizar($id, $_POST);
        header("Location: index.php");
        exit;
    }

    public function excluir_produto($pdo, $id) {
        $model = new ProdutoModel($pdo);
        $model->excluir($id);
        header("Location: index.php");
        exit;
    }
}