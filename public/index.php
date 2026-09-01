<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bona Comida</title>
    <?php
    include "../config/conexao.php"; // Puxa a conexão pronta

    require '../app/Models/UsuarioModel.php';
    require '../app/Models/ProdutoModel.php';

    $usuarioModel = new UsuarioModel($pdo);

    $produtos = new ProdutoModel($pdo);

    // // // insert no banco
    //     $usuario = $usuarioModel->inserir("Fabio", "fabio@email.com", "senha123");
    //     print_r($usuario);


    // // select no banco 
    $usuarios = $usuarioModel->ler();
    $produtos = $produtos->ler();


    // Agora você já pode usar a variável $pdo aqui embaixo...
    ?>

</head>

<body>
    <?php

    echo "<h1>Bem-vindo ao Restaurante Bona Comida</h1>";
    //echo "<p>Aqui você encontra suas notas e frequências.</p>";

    echo "Conectando ao banco: " . $host . " user: " . $user;
    echo "<h2>Painel Administrativo</h2>";

    echo "<h3>Lista de tabelas</h3>";
    $tabelas = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo '<ol>';
    foreach ($tabelas as $tabela) {
        echo '<li><a href="./' . $tabela . '.php">' . $tabela . '</a></li>';
    }
    echo '</ol>';

    if (count($produtos) > 0) {

    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Categoria</th>
          </tr>";

    foreach ($produtos as $row) {

        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['preco'] . "</td>";
        echo "<td>" . $row['categoria'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} else {
    echo "0 resultados";
}


    //     // Exibe a lista completa de usuários formatada na tela
    echo "<pre>";
    print_r($usuarios);
    echo "</pre>";


    $pdo = null;
    ?>
</body>

</html>