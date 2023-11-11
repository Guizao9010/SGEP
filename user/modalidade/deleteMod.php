<?php
require_once "../../src/controller/mod.php";
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $mod_id = intval($_GET['id']);

    $mod_data = new Mod();

    // Verificar se a modalidade existe antes de tentar excluí-la
    $modExistence = $mod_data->procurar_mod_por_id($mod_id);
    
    if ($modExistence) {
        // Realize a exclusão da modalidade
        $resultadoExclusao = $mod_data->excluirMod($mod_id);
        header('Location: modalidades.php');
        exit;
    } else {
        echo "Modalidade não encontrada.";
    }
} else {
    echo "ID de modalidade inválido.";
}
?>
