<?php

elgg_load_js('pagination/conv_asesor');
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 16;
$user=  elgg_get_logged_in_user_entity();

if (!$ajax) {
$header = "<div class='titulo-coordinacion'>";
$header .="<h2>Convocatorias a las que está inscrito</h2>";
$header.="</div>";

echo $header;
echo "<div id='paginable' class='lista-coordinacion'>";
echo elgg_get_list_convocatorias_asignadas($limit, 0, $user,'asesores/listado_convocatorias', 'asesor_convocatoria');
echo "</div>";
}
else{
 echo elgg_get_list_convocatorias_asignadas($limit, $offset, $user, 'asesores/listado_convocatorias', 'asesor_convocatoria');
}


