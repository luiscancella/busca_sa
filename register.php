<?php

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Conecta ao banco de dados
    $db = new mysqli('localhost', 'root', '', 'thxavier');
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];

    // Verifica se o email já existe no banco de dados
    $query = "SELECT * FROM cliente WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        die("Este email já foi registrado.");
    }
    // Insere os dados no banco de dados
    $query = "INSERT INTO cliente (nome, email, senha, telefone) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssss", $nome, $email, $senha, $telefone);
    $stmt->execute();

    // Redireciona para a página de login
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Registrar</title>
</head>

<body>

    <h1>Registrar</h1>

    <form method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label>Senha:</label><br>
        <input type="senha" name="senha" required><br><br>
        <label>Telefone:</label><br>
        <input type="text" name="telefone" required><br><br>
        <input type="submit" value="Registrar">
    </form>

</body>

</html>