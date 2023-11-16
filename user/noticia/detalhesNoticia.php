<?php
require_once "../../src/controller/noticia.php";
require_once "../../src/controller/user.php";
$noticia_obj = new Noticia();
$user_obj = new User();
$user_data = $user_obj->procurar_user_por_id($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $noticiaExistente = $noticia_obj->procurar_noticia_por_id($id);
    if ($noticiaExistente) {
        $noticia_atual = $noticia_obj->listarNoticia($id);
        // Exiba o formulário de atualização com os dados atuais
        // Certifique-se de preencher os campos do formulário com os dados atuais
?>
        <!DOCTYPE html>
        <html lang="pt-br">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
            <link rel="stylesheet" href="../../src/css/userPanel.css">
            <title>Detalhes Notícias</title>
        </head>

        <body>
            <div style="border-bottom: #0B3142 2px solid;">
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
                                    <a href="noticias.php" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Notícias</a>
                                </li>
                                <li>
                                    <a href="../modalidade/modalidades.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Modalidade</a>
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
            </div>

            <main class="mt-10">

                <div class="mb-4 md:mb-0 w-full max-w-screen-md mx-auto relative" style="height: 24em;">
                    <div class="absolute left-0 bottom-0 w-full h-full z-10" style="background-image: linear-gradient(180deg,transparent,rgba(0,0,0,.7));"></div>
                    <img src="<?= $noticia_atual[0]["im_capa_url"] ?>" class="absolute left-0 top-0 w-full h-full z-0 object-cover" />
                    <div class="p-4 absolute bottom-0 left-0 z-20">
                        <a href="#" class="px-4 py-1 bg-black text-gray-200 inline-flex items-center justify-center mb-2"></a>
                        <h2 class="text-4xl font-semibold text-gray-100 leading-tight">
                            <?php echo $noticia_atual[0]['nm_titulo']; ?>
                        </h2>
                        <div class="flex mt-3">
                            <div>
                                <p class="font-semibold text-gray-400 text-xs">
                                    <?php echo date("d-m-Y", strtotime($noticia_atual[0]['dt_noticia'])); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-4 lg:px-0 mt-12 text-gray-700 max-w-screen-md mx-auto text-lg leading-relaxed">
                    <p class="pb-6 text-justify"><?php echo $noticia_atual[0]['ds_conteudo']; ?></p>
                </div>
            </main>
    <?php
    } else {
        echo "noticiao não encontrado.";
    }
}
    ?>
    <div class="border-top-color">
        <footer class="bg-white m-4">
            <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                        <span class="self-center text-3xl font-semibold whitespace-nowrap dark:text-white">SGEP</span>
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
                <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="" class="hover:underline"><?php echo $user_data->nm_usuario ?></a>.Todos os direitos reservados.</span>
                <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">Desenvolvido por <a href="" class="hover:underline">Fatecanos</a></span>
            </div>
        </footer>
    </div>
        </body>

        </html>