<?php
require_once "src/controller/mod.php";
$mod_obj = new Mod();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $modExistente = $mod_obj->mod_existe($id);

    if ($modExistente) {
        // Exiba o formulário de atualização com os dados atuais do pet
        // Certifique-se de preencher os campos do formulário com os dados atuais do pet
?>
        <!DOCTYPE html>
        <html lang="pt-br">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="src/css/dashboard.css">
            <title>Atualizar Modalidade</title>
        </head>

        <body bgcolor="#F9F6ED">
            <span class="absolute text-white text-4xl top-5 left-4 cursor-pointer" onclick="openSidebar()">
                <i class="bi bi-filter-left px-2 bg-gray-900 rounded-md"></i>
            </span>
            <div class="flex">
        <div class="sidebar fixed top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto text-center bg-gray-900 sidebar-container">
            <div class="text-gray-100 text-xl">
                <div class="p-2.5 mt-1 flex items-center">
                    <h1 class="font-bold text-gray-200 text-[15px] ml-3">SGEP</h1>
                    <i class="bi bi-x cursor-pointer ml-28 lg:hidden" onclick="openSidebar()"></i>
                </div>
                <div class="my-2 bg-gray-600 h-[1px]"></div>
            </div>
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer text-white">
                <i class="bi bi-person-circle"></i>
                <span class="text-[15px] ml-4 text-gray-200 font-bold"><?php echo $user_data->nm_usuario ?></span>
            </div>
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                <i class="bi bi-house-door-fill"></i>
                <a href="admDashboard.php"><span class="text-[15px] ml-4 text-gray-200 font-bold">Home</span></a>
            </div>
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                <i class="bi bi-file-earmark-text-fill"></i>
                <a href="cadastro.php"><span class="text-[15px] ml-4 text-gray-200 font-bold">Cadastro</span></a>
            </div>
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                <i class="bi bi-file-earmark-text-fill"></i>
                <a href="modalidades.php"><span class="text-[15px] ml-4 text-gray-200 font-bold">Modalidades</span></a>
            </div>
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                <i class="bi bi-file-earmark-text-fill"></i>
                <a href="cadastroModalidade.php"><span class="text-[15px] ml-4 text-gray-200 font-bold">Adicionar Modalidade</span></a>
            </div>
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white" style="position: absolute; bottom: 0; left: 0;">
                <i class="bi bi-box-arrow-in-right"></i>
                <a href="logout.php"><span class="text-[15px] ml-4 text-gray-200 font-bold">Logout</span></a>
            </div>
        </div>
    </div>
            <div class="flex-1 ml-64 p-9"> <!-- Adjust the ml-64 to create space between sidebar and table -->
                <div class="relative overflow-x-auto form-container">
                    <h1 style="font: 700 30px 'Montserrat', sans-serif; margin-bottom: 20px;">ATUALIZAÇÃO DA MODALIDADE</h1>
                    <form action="" method="POST">
                <div class="mb-6">
                <input type="hidden" name="id" value="<?= $id ?>">
                    <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                    <input type="text" id="nome" name="nome" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                </div>
                <div class="mb-6">
                    <label for="descricao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                    <input type="text" id="descricao" name="descricao" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Atualizar</button>
            </form>   
                </div>
            </div>
    <?php
    } else {
        echo "Modalidade não encontrada.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar a submissão do formulário de atualização
    $id = $_POST['id'];
    $modName = $_POST['nome'];
    $modDescription = $_POST['descricao'];

    $mod = new Mod();
    $resultadoAtualizacao = $mod->atualizarMod($id, $modName, $modDescription);
    header('Location: modalidades.php');
    exit;
} else {
    echo "ID de Modalidade inválido.";
}
    ?>
        </body>

        </html>