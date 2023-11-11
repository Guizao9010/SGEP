<?php
require_once "../src/controller/user.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar a submissão do formulário de atualização
    $id = $_POST['id'];
    $username = $_POST['nome'];
    $email = $_POST['email'];
    $user_id = $_POST['idUsuario'];
    $password = $_POST['senha'];

    $user_data = new User();
    $resultadoAtualizacao = $user_data->atualizarUsuario($id, $username, $email, $password, $user_id);
    header('Location: admDashboard.php');
    exit;
} else {
    echo "ID de pet inválido.";
}
?>