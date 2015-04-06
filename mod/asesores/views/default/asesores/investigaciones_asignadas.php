<?php

elgg_load_js('pag/investig_conv');

$user = elgg_get_logged_in_user_entity();
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 5;

if (!$ajax) {
    
    $guid_conv=  $vars['guid_convocatoria'];
    $convocatoria= get_entity($guid_conv);
    echo "";
    $header = "<div class='titulo-coordinacion'>";
    $header .="<h2>{$convocatoria->name}-  Investigaciones Asignadas</h2>";
    $header.="</div>";
    echo $header;
    echo elgg_view('input/hidden', array('id' => 'convocatoria', 'value' => $guid_conv));
    echo "<div id='paginable' class='elgg-image-block clearfix'><br><br>";
    echo elgg_get_investigaciones_asignadas_usuario2($user->guid, 'es_asesor_de', 'asesores/lista_investigaciones', $guid_conv);
    echo "</div>";
} else {
    $guid = get_input('guid');
    $guid_conv = get_input('convocatoria');
    echo elgg_get_investigaciones_asignadas_usuario2($user->guid, 'es_asesor_de', 'asesores/lista_investigaciones', $guid_conv);
}
