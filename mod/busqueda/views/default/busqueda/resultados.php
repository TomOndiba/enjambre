<?php

elgg_load_js('pagination/resultados');

$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 8;


if (!$ajax) {
    $clave = $vars['clave'];

//    $header = "<div class='titulo-asesor'>";
    echo "<div class='box'><h2 class='title-legend'>Resultado de la Búsqueda </h2>";
    echo "<input type='hidden' value=$clave id='clave'>";
    echo "<div id='paginable' class='lista-coordinacion'>";
    echo elgg_get_all_usuarios_like_paginable($clave, $limit, 0);
    echo "</div></div>";
} else {
    $clave = get_input('clave');

    echo elgg_get_all_usuarios_like_paginable($clave, $limit, $offset);
}
?> 

