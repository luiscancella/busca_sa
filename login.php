<?php
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION["user_id"])) {
  header('Location: index.php');
  exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Conecta ao banco de dados
  $db = new mysqli('localhost', 'root', '', 'thxavier');
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }
  // Obtém os dados do formulário
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Verifica se o email e a senha estão corretos
  $query = "SELECT idcliente FROM cliente WHERE email = ? AND senha = ?";
  $stmt = $db->prepare($query);
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    // O usuário foi autenticado com sucesso
    $row = $result->fetch_assoc();
    $_SESSION['id'] = $row['idcliente'];
    if($row['idcliente'] == 1){
      $_SESSION['adm'] = true;
    };

    // Consulta o banco de dados para obter os dados do usuário
    $query = "SELECT nome, email, telefone FROM cliente WHERE idcliente = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Obtém os dados do usuário
    $user = $result->fetch_assoc();
    $_SESSION['nome'] = $user['nome'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['telefone'] = $user['telefone'];
    header('Location: index.php');
    exit();
  } else {
    // As credenciais de login estão incorretas
    $error = 'Email ou senha incorretos';
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
</head>

<body>

  <h1>Login</h1>

  <?php if (isset($error)) { ?>
    <p>
      <?php echo $error; ?>
    </p>
  <?php } ?>

  <form method="post">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>
    <label>Senha:</label><br>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Entrar">
  </form>

</body>

</html>