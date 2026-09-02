<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cardápio</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; color: #333; padding: 20px; }
        .container { max-width: 700px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h1 { color: #d9534f; border-bottom: 2px solid #d9534f; padding-bottom: 10px; }
        form { display: flex; gap: 10px; align-items: flex-end; margin-top: 20px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type=text] { padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 9px 18px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 25px; }
        th { background-color: #d9534f; color: white; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #ddd; }
        tr:hover { background-color: #f1f1f1; }
        .btn { padding: 6px 12px; border-radius: 4px; text-decoration: none; color: white; font-size: 0.9em; margin-right: 5px; }
        .btn-editar { background-color: #337ab7; }
        .btn-apagar { background-color: #d9534f; }
    </style>
</head>
<body>

<div class="container">
    <h1>Cardápio</h1>

    <?php
        // Mesmo form serve pra cadastro e edição: se $usuarioEditando existe,
        // é edição (preenche o campo e manda pra "atualizar"); senão é cadastro.
        $acaoForm_produto = isset($cardapioEditando) ? 'cadastrar_produto' : 'atualizar_produto';
    ?>
    <form method="POST" action="index.php?acao=<?= $acaoForm_produto ?><?= isset($cardapioEditando) ? '&id=' . isset($cardapioEditando['id']) : '' ?>">
        <div>
            <label for="nome"><?= isset($cardapioEditando) ? 'Editar cardápio' : 'Novo cardápio' ?></label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($cardapioEditando['nome'] ?? '') ?>" required>
            <label for="preco">Preço</label>
            <input type="text" id="preco" name="preco" value="<?= htmlspecialchars($cardapioEditando['preco'] ?? '') ?>" required>
            <label for="categoria">Categoria</label>
            <input type="text" id="categoria" name="categoria" value="<?= htmlspecialchars($cardapioEditando['categoria'] ?? '') ?>" required>
        </div>
        <button type="submit">Salvar</button>
        <?php if (isset($cardapioEditando)): ?>
            <a href="index.php"><button type="button">Cancelar</button></a>
        <?php endif; ?>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (isset($cardapios) ? $cardapios : [] as $cardapio): ?>
                <tr>
                    <td><?= htmlspecialchars($cardapio['nome']) ?></td>
                    <td><?= htmlspecialchars($cardapio['preco']) ?></td>
                    <td><?= htmlspecialchars($cardapio['categoria']) ?></td>
                    <td>
                        <a class="btn btn-editar" href="index.php?id=<?= $cardapio['id'] ?>">Editar</a>
                        <a class="btn btn-apagar" href="index.php?acao=excluir&id=<?= $cardapio['id'] ?>"
                           onclick="return confirm('Apagar este cardápio?')">Apagar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>