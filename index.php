<?php
require "src/controller/user.php";
$user_obj = new User();
// Se o usuario requisitar o login
if(isset($_POST['email']) && isset($_POST['password'])){
  $user_obj->loginUser($_POST['email'],$_POST['password']);
}

$user_obj->listarUsuarios();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>

    <div class="container-fluid">
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="emailUsuario" class="form-label">Email:</label>
                <input type="text" class="form-control" id="emailUsuario" name="email">
            </div>
            <div class="mb-3">
                <label for="senhaUsuario" class="form-label">Senha:</label>
                <input type="text" class="form-control" id="senhaUsuario" name="senha">
                <button type="submit" class="btn btn-primary" name="logar">Login</button>
            </div>
        </form>
    </div>

</body>
</html>