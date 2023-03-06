<?php
session_start();
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
    <header>
        <img src="img/logo.png" alt="Logo">
        <nav>
            <div class="navbox">
                <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample">
                    Categorias

                </a>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                    aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Categorias</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div>
                            Aqui você pode filtrar pela categoria que deseja
                        </div>

                        <?php

                        include 'dao/connection.php';
                        $sql = "SELECT distinct categoria FROM livro;";
                        $busca = mysqli_query($conexao, $sql);
                        $resultados = mysqli_fetch_all($busca, MYSQLI_ASSOC);

                        foreach ($resultados as $array):
                            ?>

                            <a href="listarCategoria.php?categoria=<?php echo $array['categoria']; ?>"> <?php echo $array['categoria']; ?> </a><br>



                        <?php endforeach ?>
                    </div>
                </div>
                <div class="navbox">
                    <?php if (isset($_SESSION['adm']))
                        echo '<a href="admin.php">Administrador</a>'; ?>
                </div>
                <form>
                    <input type="text">
                    <button type="submit">Pesquisar</button>
                </form>
        </nav>
        <section id="login">
            <?php
            if (!isset($_SESSION['id'])) {
                echo '<a href="login.php">Entrar</a>';
                echo '<a href="register.php">Register</a>';
            } else {
                echo '<a href="profile.php">Olá, ' . $_SESSION['nome'] . '</a>';
            }
            ?>

        </section>
    </header>
    <main class="box-livros">

        <?php

        include 'dao/connection.php';
        $sql = "SELECT * FROM livro";
        $busca = mysqli_query($conexao, $sql);
        $resultados = mysqli_fetch_all($busca, MYSQLI_ASSOC);

        $limiteLivros = 5;
        $contador = 0;
        foreach ($resultados as $array):
            ?>

            <?php if ($contador < $limiteLivros): ?>

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
                $contador++;
            endif;
        endforeach;
        ?>


</main>

<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
                <div class="container">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Ver Mais
                </button>
                </div>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                    data-bs-parent="#accordionFlushExample">

                    <div class="box-livros">
                        <?php

                        include 'dao/connection.php';
                        $sql = "SELECT * FROM livro";
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
                    </div>
                </div>
            </div>

        <footer>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</body>

</html>