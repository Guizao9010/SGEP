<?php
require_once 'conn.php';
$banco = getConnection();

function listarUsuarios(){
    global $banco;
    $dados = $banco->query("SELECT * FROM usuario");
    $user = $dados->fetchAll(PDO::FETCH_ASSOC);
    foreach($user as $u){
        echo $u['nm_usuario'];
        echo "\n";
    }
}


function cadastrarUsuario($email,$nome,$senha){
    global $banco;
    $stmt = $banco->prepare("INSERT INTO usuario VALUES(:email,:nome,:senha)");
    $stmt->execute([':email' => $email, ':nome' => $nome ,':senha' => $senha]);
    $stmt = null;
}

function excluirUsuario($email){
    global $banco;
    $banco->query("DELETE FROM usuario WHERE ds_email = '$email'");
}

function atualizarInformacoesUsuario($campo, $novoValor, $email){
    global $banco;
    $banco->query("UPDATE usuario SET $campo = '$novoValor' WHERE ds_email = '$email'");
}

function verificarLogin($nome, $senha){
    global $banco;
    $banco->query("SELECT * FROM usuario WHERE nm_usuario = '$nome' AND ds_senha = '$senha'");
    $user = $dados->fetchAll(PDO::FETCH_ASSOC);
    foreach($user as $u){
        $cookieName = "usuario";
        $cookieValue = $u['nm_usuario'];
        $expiration = time() + (86400 * 30);

        setcookie($cookieName, $cookieValue, $expiration);
    }
}
?>