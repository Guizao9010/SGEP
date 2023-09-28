<?php
require "src/controller/user.php";
$user_obj = new User();
// Se o usuario requisitar o login
if (isset($_POST['email']) && isset($_POST['senha'])) {
  $user_obj->loginUser($_POST['email'], $_POST['senha']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="src/css/style.css">
  <title>Login</title>
</head>

<body>
  <main>
    <figure>
      <picture>
        <img src="src/img/treinador-de-futebol-ensinando-vista-lateral-para-criancas.jpg" alt="ferramenta esportiva" class="bg-form">
      </picture>
    </figure>
    <div class="headline">
      <h2 class="text-headline">SGEP</h2>
      <h3 class="text-subheadline">Sistema de Gerenciamento Esportivo Público</h2>
    </div>
    <form class="form-content" action="" method="POST">
      <h1 class="text-headline">Login</h1>
      <span>
        <label for="email" class="text-small-uppercase">Email</label>
        <input class="text-body" id="email" name="email" type="email" required>
      </span>
      <span>
        <label for="senha" class="text-small-uppercase">Senha</label>
        <input class="text-body" id="senha" name="senha" type="password" required>
      </span>
      <input class="text-small-uppercase" id="submit" type="submit" value="Entrar">
      <a href="recuperarSenha.php" class="link" style="font-size: 12px;">Não consigo iniciar a sessão</a>
    </form>
  </main>
  <script src="src/js/form.js"></script>
</body>
</html>