<?php
include 'modalidade.php';
include 'noticias.php';
$modalidadesCadastradas = new Modalidade;
$modalidades = $modalidadesCadastradas->selecionarModalidades();

$noticiasCadastradas = new Noticia;
$noticias = $noticiasCadastradas->selecionarNoticias();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <title>MENU</title>
</head>

<body>
]
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="menu.php">NOTÍCIAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="eventos.php">EVENTOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MODALIDADES">MODALIDADES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MODALIDADES">UNIDADES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MODALIDADES">NOTÍCIAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MODALIDADES">USUÁRIO</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Barra de Pesquisa-->
    <div class="container-fluid">
        <div class="input-group mb-12">
            <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="basic-addon2">
            <span class="input-group-text nav-item dropdown" id="basic-addon2">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">MODALIDADES</a>
                <ul class="dropdown-menu">
                    <?php foreach($modalidades as $modalidade) :?>
                        <form action="" method="POST">
                        <?php $id_modalidade = $modalidade["id_modalidade"]; ?>
                        <li><a class="dropdown-item"><?=$modalidade["nm_modalidade"]?></a></li>
                        </form>
                    <?php endforeach; ?>
                </ul>
            </span>
        </div>
    </div>

        <!-- Notícias-->
    <div class="container-fluid">
        

    </div>
</body>

</html>