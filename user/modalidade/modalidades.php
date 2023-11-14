<?php
require_once "../../src/controller/user.php";
require_once "../../src/controller/mod.php";
$mod_obj = new Mod();
$user_obj = new User();
if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
    $user_data = $user_obj->procurar_user_por_id($_SESSION['user_id']);
    if ($user_data ===  false) {
        header('Location: ../../logout.php');
        exit;
    }
    $list_mods = $mod_obj->listarModalidadeUsuario($_SESSION['user_id']);
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
    <title>Modalidades</title>
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
                    <span class="sr-only">Abrir menu</span>
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
                    <span class="sr-only">Abrir menu</span>
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
                        <a href="modalidades.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Modalidade</a>
                    </li>
                    <li>
                        <a href="../evento/eventos.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Eventos</a>
                    </li>
                    <li>
                        <a href="../unidade/unidades.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Unidades</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="flex-1 ml-64 p-20" style="display: flex; flex-direction: row; margin: 5px; flex-wrap: wrap;">

        <?php foreach ($list_mods as $mod) : ?>

            <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md" style="margin: 5px; flex-basis: calc(25% - 10px);">
                <?php $mod_id = $mod["id_modalidade"]; ?>
                <div class="p-6">
                    <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                        <?= $mod["nm_modalidade"] ?>
                    </h5>
                    <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                        <?= $mod["ds_modalidade"] ?>
                    </p>
                </div>
                <div class="p-6 pt-0">
                    <a href="atualizaMod.php?id=<?= $mod['id_modalidade'] ?>">
                        <button class="" type="button" data-ripple-light="true">
                            Editar
                        </button>
                    </a>
                    <a href="deleteMod.php?id=<?= $mod['id_modalidade'] ?>">
                        <button class="" type="button" data-ripple-light="true">
                            Apagar
                        </button>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <!-- Botão do Modal -->
    <button data-modal-target="cadastro-modal" data-modal-toggle="cadastro-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Cadastro
    </button>

    <!-- Modal de Cadastro -->
    <div id="cadastro-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Conteúdo do Modal -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Cabeçario -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Cadastrar Modalidade
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="cadastro-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Fechar</span>
                    </button>
                </div>
                <!-- Corpo do Modal -->
                <form action="" method="POST">
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="flex-1 ml-64 p-9"> <!-- Adjust the ml-64 to create space between sidebar and table -->
                            <div class="relative overflow-x-auto form-container">
                                <h1 style="font: 700 30px 'Montserrat', sans-serif; margin-bottom: 20px;">CADASTRO DE MODALIDADE</h1>
                                <div class="mb-6">
                                    <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                                    <input type="text" id="nome" name="nome" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                </div>
                                <div class="mb-6">
                                    <label for="descricao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                                    <input type="text" id="descricao" name="descricao" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['nome']) && isset($_POST['descricao'])) {
                        $result = $mod_obj->cadastroMod($_POST['nome'], $_POST['descricao'], $_SESSION['user_id']);
                        if (isset($result['successMessage'])) {
                            $successMessage = $result['successMessage'];
                        }
                        if (isset($result['errorMessage'])) {
                            $errorMessage = $result['errorMessage'];
                        }
                    }
                    ?>
                    <!-- Rodapé do Modal -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Adicionar</button>
                        <button data-modal-hide="cadastro-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="../../src/js/speedDial.js"></script>
</body>

</html>