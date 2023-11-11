<?php
require_once "../../src/controller/evento.php";
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $event_id = intval($_GET['id']);

    $event_obj = new Event();

    // Verificar se a modalidade existe antes de tentar excluí-la
    $modExistence = $event_obj->procurar_evento_por_id($event_id);
    
    if ($modExistence) {
        // Realize a exclusão da modalidade
        $resultadoExclusao = $event_obj->excluirEvento($event_id);
        header('Location: eventos.php');
        exit;
    } else {
        echo "Evento não encontrado.";
    }
} else {
    echo "ID de unidade inválido.";
}
?>
