

   
<?php

elgg_load_js('pagination/miembros');

$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 6;


if (!$ajax) {
    
    echo '<div class="list-grupos" style="margin-left: 20px; margin-top: 25px"> <h2 class="title-legend">Integrantes del Grupo</h2>';
    $grupo = $vars['grupo'];
    $busqueda = elgg_view('input/text', array('name' => 'busqueda',
        'id' => 'busqueda_miembro',
        'class' => 'text-busqueda',
        'value' => "",
        'placeholder' => "Ingresa aquí tu búsqueda y presiona ENTER"
    ));
    echo '<div id="contenedor-busqueda">' . $busqueda . ' </div>';
    echo $header;

    echo "<div id='paginable' class='lista-coordinacion'>";
    echo elgg_get_miembros_grupo_like_paginable_2("", $grupo, $limit, 0);
    echo "</div>";
} else {
    $clave = get_input('clave');
    $grupo = get_input('grupo_inv');
    echo elgg_get_miembros_grupo_like_paginable_2($clave, $grupo, $limit, $offset);
}
?>
</div>