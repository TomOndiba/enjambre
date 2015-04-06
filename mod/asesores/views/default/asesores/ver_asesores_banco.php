<?php

elgg_load_js('pagination/asesores');
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 16;

if (!$ajax) {
    $header = "<div class='titulo-asesor'>";
    $header .="<h2>Asesores</h2>";
    $header.="</div>";
    echo $header;

    echo "<div id='paginable' class='lista-coordinacion'>";
    echo elgg_get_list_asesores($limit, 0);
    echo "</div>";
} else {
    echo elgg_get_list_asesores($limit, $offset);
}

?> 


