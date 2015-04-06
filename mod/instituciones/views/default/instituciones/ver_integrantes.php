<?php
elgg_load_js('pagination/integrantes');

$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 6;

if (!$ajax) {
    $institucion = $vars['institucion'];

    echo '<div class="list-grupos" style="margin-left: 20px; margin-top: 25px">
    <h2 class="title-legend">Integrantes de la Institución</h2>';
    
    $busqueda = elgg_view('input/text', array('name' => 'busqueda',
        'id' => 'busqueda_integrante',
        'class' => 'text-busqueda',
        'value' => "",
        'placeholder' => "Ingresa aquí tu búsqueda y presiona ENTER"
    ));
    echo '<div id="contenedor-busqueda">' . $busqueda . ' </div>';
    echo $header;

    echo "<div id='paginable' class='lista-coordinacion'>";
    echo elgg_get_estudiantes_inst_like_paginable($clave, $institucion, $limit, 0);
    echo "</div>";
} else {
    $clave = get_input('clave');
    $institucion = get_input('institucion');

    echo elgg_get_estudiantes_inst_like_paginable($clave, $institucion, $limit, $offset);
}
?>
<div>