<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Livros</title>
</head>

<body>
    <?php
    // Cria a conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "thxavier";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se houve um erro na conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Pega os dados do formulário
        $nome = $_POST["nome"];
        $autor = $_POST["autor"];
        $categoria = $_POST["categoria"];
        $preco = $_POST["preco"];
        $tipo_capa = $_POST["tipo_capa"];
        $estoque = $_POST["estoque"];
        $editora = $_POST["editora"];
        $ano_publicacao = $_POST["ano_publicacao"];

        // Insere os dados na tabela 'livro'
        $sql = "INSERT INTO livro (nome, autor, categoria, preco, tipo_capa, estoque, editora, ano_publicacao)
  VALUES ('$nome', '$autor', '$categoria', '$preco', '$tipo_capa', '$estoque', '$editora', '$ano_publicacao')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . $conn->error;
        }
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
    ?>

    <h1>Adicionar livro</h1>

    <form method="post">
        Nome: <input type="text" name="nome" required><br>
        Autor: <input type="text" name="autor" required><br>
        Categoria: <input type="text" name="categoria" required><br>
        Preço: <input type="number" name="preco" required><br>
        Tipo de capa: <input type="text" name="tipo_capa" required><br>
        Estoque: <input type="number" name="estoque" required><br>
        Editora: <input type="text" name="editora" required><br>
        Ano de publicação: <input type="number" name="ano_publicacao" required><br>
        <input type="submit" value="Adicionar" required>
    </form>

</body>

</html>