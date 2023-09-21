<?php
require "src/controller/user.php";
$user_obj = new User();
// Se o usuario requisitar o Cadastro
if(isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['nome']) && isset($_POST['idUsuario'])){
  $user_obj->cadastroUser($_POST['nome'],$_POST['email'],$_POST['senha'],$_POST['idUsuario']);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Cadastro</title>
</head>
<body>
<nav class="navbar navbar-expand-lg nav-color">
        <div class="container-fluid">
            <a class="navbar-brand" href="admDashboard.php">SGEP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admDashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro.php">Cadastrar cliente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <form action="" method="POST">
        <div class="mb-3">
                <label for="nomeUsuario" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nomeUsuario" name="nome">
            </div>
            <div class="mb-3">
                <label for="emailUsuario" class="form-label">Email:</label>
                <input type="text" class="form-control" id="emailUsuario" name="email">
            </div>
            <div class="mb-3">
                <label for="senhaUsuario" class="form-label">Senha:</label>
                <input type="password" class="form-control" id="senhaUsuario" name="senha">
            </div>            
            <div class="mb-3">
                <label for="emailUsuario" class="form-label">Codigo:</label>
                <input type="text" class="form-control" id="idUsuario" name="idUsuario">
                <button type="submit" class="btn btn-primary" name="logar">Cadastrar

                </button>
            </div>
        </form>
    </div>

</body>
</html>