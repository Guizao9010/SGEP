<?php
require_once "../../src/controller/user.php";
require_once "../../src/controller/evento.php";
$event_obj = new Event();
$user_obj = new User();
if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
  $user_data = $user_obj->procurar_user_por_id($_SESSION['user_id']);
  if ($user_data ===  false) {
    header('Location: ../../logout.php');
    exit;
  }
  $idU = $user_data->id;
  $list_events = $event_obj->listarEvento($_SESSION['user_id']);
} else {
  header('Location: ../../logout.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
  <link rel="stylesheet" href="../../src/css/dashboard.css">
  <title>Eventos</title>
</head>

<body bgcolor="#F9F6ED">

  <nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="../userDashboard.php" class="flex items-center">
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
              <a href="../../logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sair</a>
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
            <a href="../noticia/noticias.php" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Notícias</a>
          </li>
          <li>
            <a href="../modalidade/modalidades.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Modalidade</a>
          </li>
          <li>
            <a href="eventos.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Eventos</a>
          </li>
          <li>
            <a href="../unidade/unidades.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Unidades</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="flex-1 ml-50 p-8">
    <div style="display: flex; justify-content: flex-end; margin-bottom: 5px;">
      <a href="cadastroEvento.php"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover-bg-blue-700 focus:outline-none dark:focus-ring-blue-800">Novo cadastro</button></a>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <tr style="background-color: #0B3142; color:aliceblue;">
          <th scope="col" class="px-6 py-3">
            Nome
          </th>
          <th scope="col" class="px-6 py-3">
            Descrição
          </th>
          <th scope="col" class="px-6 py-3">
            Data
          </th>
          <th scope="col" class="px-6 py-3">
            Ação
          </th>
        </tr>
        </thead>
        <tbody>
          <?php foreach ($list_events as $event) : ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <?php $event_id = $event["id_evento"]; ?>
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <?= $event["nm_evento"] ?>
              </th>
              <td class="px-6 py-4">
                <?= $event["ds_evento"] ?>
              </td>
              <td class="px-6 py-4">
                <?= $event["dt_evento"] ?>
              </td>
              <td class="px-6 py-4">
                <!-- Modal Editar -->
                <a href="atualizaEvent.php?id=<?= $event['id_evento'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" type="button">Editar</a>
                <a href="deleteEvent.php?id=<?= $event['id_evento'] ?>" class="font-medium text-red-600 dark:text-red-500 hover:underline" type="button">Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>