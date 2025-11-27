<?php
// Dados da conexão
$dsn = "mysql:host=127.0.0.1;dbname=minha_app;charset=utf8mb4";
$usuario = "root";
$senha = "";

try {
    // Cria uma nova conexão PDO
    $pdo = new PDO($dsn, $usuario, $senha);

    // Define o modo de erro para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta simples: selecionar todos os usuários
    $sql = "SELECT id, name, email FROM users";
    $stmt = $pdo->query($sql);

    // Exibe os resultados
    while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: {$usuario['id']} - Nome: {$usuario['name']} - E-mail: {$usuario['email']} <br>";
    }

} catch (PDOException $e) {
    // Caso ocorra um erro de conexão ou consulta
    echo "Erro ao conectar ou consultar o banco: " . $e->getMessage();
}