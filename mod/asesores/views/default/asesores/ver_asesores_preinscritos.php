<?php

elgg_load_js('pagination/asesores_preinscritos');
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 16;

if (!$ajax) {
    $header = "<div class='titulo-asesor'>";
    $header .="<h2>Asesores</h2>";
    $header.="</div>";
    echo $header;
    // paginacion para los maestros preinscritos que se deben aceptar
    echo "<div id='paginable' class='lista-coordinacion'>";
    echo elgg_get_list_asesores_preinscritos_banco($limit, 0);
    echo "</div>";
} else {
    
    echo elgg_get_list_asesores_preinscritos_banco($limit, $offset);
}


?> 


