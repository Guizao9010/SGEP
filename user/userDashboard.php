<?php
require_once "../src/controller/user.php";
require_once "../src/controller/mod.php";
require_once "../src/controller/unit.php";
$unit_obj = new Unit();
$mod_obj = new Mod();
$user_obj = new User();
if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
  $user_data = $user_obj->procurar_user_por_id($_SESSION['user_id']);
  if ($user_data ===  false) {
    header('Location: ../../logout.php');
    exit;
  }
  $list_units = $unit_obj->listarUnidadesUsuario($_SESSION['user_id']);
  $list_mods = $mod_obj->listarModalidadeUsuarioLimitado($_SESSION['user_id']);
} else {
  header('Location: ../../logout.php');
  exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>

  <title>Esportes</title>
  <style>
    .custom-container {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      max-width: 800px;
      /* Definir uma largura máxima para o container */
      width: 100%;
    }

    .custom-list {
      flex: 1;
      padding-right: 20px;
    }

    .custom-image {
      flex: 1;
    }

    .unidade {
      margin: 0;
      /* Remover margens padrão do body */
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
</head>

<body>

  <nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="userDashboard.php" class="flex items-center">
        <img src="" class="h-8 mr-3" alt="" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">SGEP</span>
      </a>
      <div class="flex items-center md:order-2">
        <button type="button" class="flex mr-3 text-sm" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
          <span class="sr-only">Open user menu</span>
          <?php echo $user_data->nm_usuario ?>
        </button>
        <!-- Dropdown menu -->
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
          <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
              <a href="../logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sair</a>
            </li>
          </ul>
        </div>
        <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
          </svg>
        </button>
      </div>
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
        <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <a href="noticia/noticias.php" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Notícias</a>
          </li>
          <li>
            <a href="modalidade/modalidades.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Modalidade</a>
          </li>
          <li>
            <a href="evento/eventos.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Eventos</a>
          </li>
          <li>
            <a href="unidade/unidades.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Unidades</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div>
    <div>
      <img class="h-auto max-w-full" src="../src/img/close-de-um-atleta-jogando-futebol.jpg" alt="">
    </div>
    <div id="modalidades" class="flex-1 ml-64 p-2" style="display: flex; flex-direction: row; margin: 5px; flex-wrap: wrap; justify-content:center;">
      <h1 class="flex items-center text-5xl font-extrabold dark:text-white m-10">Notícias recentes</h1>
    </div>
    <div id="noticias" class="bg-white" style="display:flex; justify-content: center; grid-column: 2; margin-left:5px;">
      <div class="m-10 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
          <img class="rounded-t-lg" src="https://img.freepik.com/fotos-gratis/o-homem-idoso-esta-usando-o-telefone-movel_53876-30130.jpg?w=1380&t=st=1698343354~exp=1698343954~hmac=fa48e60536b16a3a6627d8e34b1e9de762444b9c503c60222d5ec0cb2a16dc36" alt="" />
        </a>
        <div class="p-5">
          <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Notícias</h5>
          </a>
          <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Nao sei ainda o que vai ser aqui</p>
          <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Saiba mais
            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
          </a>
        </div>
      </div>
      <div class="m-10 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
          <img class="rounded-t-lg" src="https://img.freepik.com/fotos-gratis/o-homem-idoso-esta-usando-o-telefone-movel_53876-30130.jpg?w=1380&t=st=1698343354~exp=1698343954~hmac=fa48e60536b16a3a6627d8e34b1e9de762444b9c503c60222d5ec0cb2a16dc36" alt="" />
        </a>
        <div class="p-5">
          <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Notícias</h5>
          </a>
          <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Nao sei ainda o que vai ser aqui</p>
          <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Saiba mais
            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
          </a>
        </div>
      </div>
      <div class="m-10 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
          <img class="rounded-t-lg" src="https://img.freepik.com/fotos-gratis/o-homem-idoso-esta-usando-o-telefone-movel_53876-30130.jpg?w=1380&t=st=1698343354~exp=1698343954~hmac=fa48e60536b16a3a6627d8e34b1e9de762444b9c503c60222d5ec0cb2a16dc36" alt="" />
        </a>
        <div class="p-5">
          <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Notícias</h5>
          </a>
          <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Nao sei ainda o que vai ser aqui</p>
          <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Saiba mais
            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
          </a>
        </div>
      </div>
    </div>
    <hr>
    <div id="modalidades" class="flex-1 ml-64 p-2" style="display: flex; flex-direction: row; margin: 5px; flex-wrap: wrap; justify-content:center;">
      <h1 class="flex items-center text-5xl font-extrabold dark:text-white m-10">Conheça Nossas Opções de Atividades Esportivas</h1>
    </div>
    <div id="modalidades" class="flex-1 ml-64 p-6" style="display: flex; flex-direction: row; margin: 5px; flex-wrap: wrap; justify-content:center;">
      <?php foreach ($list_mods as $mod) : ?>

        <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md" style="margin: 5px; flex-basis: calc(17% - 10px);">
          <?php $mod_id = $mod["id_modalidade"]; ?>
          <div class="p-6">
            <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
              <?= $mod["nm_modalidade"] ?>
            </h5>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
    <hr>
    <div id="unidades" class="flex-1 ml-64 p-20" style="display: flex; flex-direction: row; margin: 5px; overflow: hidden; justify-content:center">
      <!-- Cards à Esquerda -->
      <div class="flex flex-wrap" style="margin-right: 5px; max-height: 400px; overflow-y: auto; flex-direction: row; width: 441px;">
        <?php foreach ($list_units as $unit) : ?>
          <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md m-5">
            <?php $unit_id = $unit["id_unidade"]; ?>
            <div class="p-6">
              <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                <?= $unit["nm_unidade"] ?>
              </h5>
              <h6 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                <?= $unit["ds_endereco"] ?>
              </h6>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <!-- Mapa à Direita -->
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29203.566287414164!2d-46.02668773103145!3d-23.802742068863513!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-BR!2sbr!4v1700014452900!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
      <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
          <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">SGEP</span>
          </a>
          <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
            <li>
              <a href="#noticias" class="hover:underline me-4 md:me-6 mr-2">Notícias</a>
            </li>
            <li>
              <a href="#modalidades" class="hover:underline me-4 md:me-6 mr-2">Modalidades</a>
            </li>
            <li>
              <a href="#unidade" class="hover:underline me-4 md:me-6">Unidades</a>
            </li>
          </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.</span>
      </div>
    </footer>



    <script>
      function mudarImagem(src) {
        // Seleciona o elemento da imagem
        var imagemUnidade = document.getElementById('imagem-unidade');

        // Atualiza o atributo src da imagem
        imagemUnidade.getElementsByTagName('img')[0].src = src;
      }
    </script>

  </div>
</body>

</html>