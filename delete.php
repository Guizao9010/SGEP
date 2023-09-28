<?php
require_once "src/controller/user.php";
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = intval($_GET['id']);

    $user_data = new User();

    // Verificar se o user existe antes de tentar excluí-lo
    $userExistente = $user_data->all_users($user_id);
    
    if ($userExistente) {
        // Realize a exclusão do user
        $resultadoExclusao = $user_data->excluirUsuario($user_id);
        header('Location: admDashboard.php');
        exit;
    } else {
        echo "user não encontrado.";
    }
} else {
    echo "ID de user inválido.";
}
?>
