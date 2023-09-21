<?php
// Inicializa a sessão.
session_start();

// Remove todas as variáveis da sessão
$_SESSION = array();

// Se quiser derrubar a sessão, apague também o cookie da sessão.
// Nota: Isso irá acabar com a sessão, não só os dados da sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 20000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destrói a sessão.
session_destroy();
header("Location: index.php");
exit;
?>