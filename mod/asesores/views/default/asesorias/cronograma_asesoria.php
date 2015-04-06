<?php

elgg_load_library('asesores');
elgg_load_js('pagination/investigaciones');
elgg_load_js("reveal2");
elgg_load_css('reveal');

$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 10;

$content = "";
$lista = "";
$url = elgg_get_site_url();
$investigacion= get_entity($vars['id_inv']);
$asesoria = $vars['asesoria'];
$volver="<div class='titulo-coordinacion'><h2>Investigacion:  {$investigacion->name}</h2></div>";
$volver.= "<a href={$url}asesores/asesorias/asignadas/{$id_conv}>Volver a Investigaciones Asignadas</a>";
if (!$ajax) {
    echo $volver.'<br><br>';
        
    echo "{$reg}<hr/>{$txt}<hr/>{$cron}";
 
    echo "<div id='paginable'>";
    echo elgg_get_asesorias_red_asesoria($limit, 0, $asesoria);
    echo "</div>";
    
} else {
    $lista = elgg_get_asesorias_red_asesoria($limit, $offset, $asesoria);
    echo $lista;
}
?>

