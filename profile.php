<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    session_unset();
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <?php
        echo '<div id="profile">';
        echo '<p>Nome: ' . $_SESSION['nome'] . '</p>';
        echo '<p>Email: ' . $_SESSION['email'] . '</p>';
        echo '<p>Telefone: ' . $_SESSION['telefone'] . '</p>';
        echo '</div>';
    ?>
    <form method="post">
    <input type="submit" value="Deslogar">
    </form>
</body>
</html>