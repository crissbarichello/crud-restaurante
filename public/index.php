<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bona Comida</title>
    <?php
    include "../app/Controllers/conexao.php"; // Puxa a conexão pronta

    require '../app/Controllers/UsuarioModel.php';

    $usuarioModel = new UsuarioModel($pdo);

    // // // insert no banco
    //     $usuario = $usuarioModel->inserir("Fabio", "fabio@email.com", "senha123");
    //     print_r($usuario);


    // // select no banco 
    $usuarios = $usuarioModel->ler();


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

    $podutos = $pdo->query("select p.id,p.nome,p.preco,p.categoria from produtos p ")->fetchAll(PDO::FETCH_ASSOC);

    if (count($podutos) > 0) {
        echo "<table><tr><th>ID</th><th>Name</th><th>Preco</th><th>Categoria</th></tr>";
        foreach ($podutos as $row) {

            echo "<tr><td>" . $row["id"] . "</td><td>" . $row['nome'] . "</td><td>" . $row['preco'] . "</td><td>" . $row['categoria'] . "</td></tr>";
        }
        echo "</table>";
    } else {

        echo "0 results";
    }

    //     // Exibe a lista completa de usuários formatada na tela
    echo "<pre>";
    print_r($usuarios);
    echo "</pre>";


    $pdo = null;
    ?>
</body>

</html>