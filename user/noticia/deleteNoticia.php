<?php
require_once "../../src/controller/noticia.php";
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $noticia_id = intval($_GET['id']);

    $noticia_data = new Noticia();

    // Verificar se a noticia existe antes de tentar excluí-la
    $noticiaExistence = $noticia_data->procurar_noticia_por_id($noticia_id);
    
    if ($noticiaExistence) {
        // Realize a exclusão da noticia
        $resultadoExclusao = $noticia_data->excluirNoticia($noticia_id);
        header('Location: noticias.php');
        exit;
    } else {
        echo "Noticia não encontrada.";
    }
} else {
    echo "ID de noticia inválido.";
}
?>
