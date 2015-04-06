<?php
elgg_load_library('evaluadores');
elgg_load_js('pagination/evaluadores');
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 16;


if (!$ajax) {
$header = "<div class='titulo-asesor'>";
$header .="<h2>Evaluadores</h2>";
$header.="</div>";

echo $header;
echo "<div id='paginable' class='lista-coordinacion'>";
echo elgg_get_list_evaluadores($limit, 0);
echo "</div>";
}
else{
 echo elgg_get_list_evaluadores($limit, $offset);
}