<?php


elgg_load_js('pag_investigaciones_asignadas');

$user=  elgg_get_logged_in_user_entity();
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 5;



if (!$ajax) {
    $guid_conv=  $vars['guid_conv'];
    $convocatoria= get_entity($guid_conv);

    $header = "<div class='titulo-coordinacion'>";
    $header .="<h2>{$convocatoria->name}-  Investigaciones Asignadas</h2>";
    $header.="</div>";
    echo $header;
    echo elgg_view('input/hidden', array('id'=>'convocatoria', 'value'=>$guid_conv));
    echo "<div id='investigaciones'><br><br>";
    echo elgg_get_investigaciones_asignadas_usuario($user->guid, 'es_evaluador_de', 'investigaciones_asignadas/lista_investigaciones', '', $guid_conv);
    echo "</div>";
} else {
    
    $guid = get_input('guid');
    $guid_conv=  get_input('convocatoria');
    echo elgg_get_investigaciones_asignadas_usuario($user->guid, 'es_evaluador_de', 'investigaciones_asignadas/lista_investigaciones', '', $guid_conv);
}
