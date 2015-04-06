<?php

elgg_load_js('pagination/redes');
$offset = get_input('offset');
$query = get_input('busqueda');
$ajax = get_input('ajax');
$limit = 10;
$url = elgg_get_site_url() . "redes_tematicas/registrar";




if (!$ajax) {
    echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> Está seguro de eliminar la Red Tematica?</div>';
    $busqueda = elgg_view('input/text', array('name' => 'busqueda',
        'id' => 'busqueda2',
        'class' => 'text-busqueda',
        'value' => "",
        'placeholder' => "Busca aquí tu grupo"
    ));
    $titulo = elgg_view_title("Redes Tematicas");
    echo '<div id="contenedor-busqueda">' . $busqueda . ' </div>';
    if (elgg_is_rol_logged_user("coordinador")|| elgg_is_rol_logged_user("Profesor")|| elgg_is_rol_logged_user("SuperAdmin")) {
        echo '<div class="botones-titulo"><div class="contenedor-button"> <a class="link-button" href="#" style="color:gray">Crear Red Temática</a></div></div>';
    }
    echo "<div id='paginable' class='list-grupos'>";
    echo elgg_get_list_redes_tematicas($limit, 0);
    echo "</div>";
} else {
    if ($query) {
        echo elgg_get_list_redes_tematicas_nombre($limit, $offset, $query);
    } else {
        echo elgg_get_list_redes_tematicas($limit, $offset);
    }
}
?>
