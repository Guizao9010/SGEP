<?php
require_once "src/controller/unit.php";
$unit_obj = new Unit();
$list_units = $unit_obj->listarUnidades();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modalidades</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <link rel="stylesheet" href="src/css/dashboard.css">
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
    <div class="flex-1 ml-64 p-8"> <!-- Adjust the ml-64 to create space between sidebar and table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <tr style="background-color: #0B3142; color:aliceblue;">
                    <th scope="col" class="px-6 py-3">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descrição
                    </th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($list_units as $unit) : ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <?php $unit_id = $unit["id_unidade"]; ?>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $unit["nm_unidade"] ?>
                            </th>
                            <td class="px-6 py-4">
                                <?= $unit["ds_unidade"] ?>
                            </td>
                            <td class="px-6 py-4">
                                <!-- Modal Editar -->
                                <a href="atualizaMod.php?id=<?= $unit['id_unidade'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" type="button">Editar</a>                            
                                <a href="deleteMod.php?id=<?= $unit['id_unidade'] ?>" class="font-medium text-red-600 dark:text-red-500 hover:underline" type="button">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>