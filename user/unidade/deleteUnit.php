<?php
require_once "../../src/controller/unit.php";
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $unit_id = intval($_GET['id']);

    $unit_obj = new Unit();

    // Verificar se a modalidade existe antes de tentar excluí-la
    $modExistence = $unit_obj->procurar_unit_por_id($unit_id);
    
    if ($modExistence) {
        // Realize a exclusão da modalidade
        $resultadoExclusao = $unit_obj->excluirUnidade($unit_id);
        header('Location: unidades.php');
        exit;
    } else {
        echo "Unidade não encontrada.";
    }
} else {
    echo "ID de unidade inválido.";
}
?>
