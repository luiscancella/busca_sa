<?php

$categoria = $_GET['categoria'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="decoration/style-index.css">
    <title>Th Xavier</title>
    <script src="https://kit.fontawesome.com/9f9089eb41.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>


    <h2>Livros sobre <?= $categoria ?> </h2><br>
<main>

<?php

include 'dao/connection.php';
$sql = "SELECT * FROM livro WHERE categoria = '$categoria'";
$busca = mysqli_query($conexao, $sql);
$resultados = mysqli_fetch_all($busca, MYSQLI_ASSOC);

foreach ($resultados as $array):
    ?>

   

        <div class="box">
            <div class="livro">
                <i class="fa-solid fa-book"></i>
            </div>
            <p>Nome:
                <?= $array['nome']; ?>
            </p>
            <p>autor:
                <?= $array['autor']; ?>
            </p>
            <p>cetegoria:
                <?= $array['categoria']; ?>
            </p>
            <p>preço:
                <?= $array['preco']; ?>
            </p>
            <p>tipo de capa:
                <?= $array['tipo_capa']; ?>
            </p>
            <p>estoque:
                <?= $array['estoque']; ?>
            </p>
            <p>editora:
                <?= $array['editora']; ?>
            </p>
            <p>ano de publicação:
                <?= $array['ano_publicacao']; ?>
            </p>

        </div>
        <?php
endforeach;
?>


</main>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>