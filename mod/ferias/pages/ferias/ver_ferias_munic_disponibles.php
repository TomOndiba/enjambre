<?php
/**
 * Página que consulta las ferias municipales que no han participado en ferias departamentales
 * y envía la información a la vista para ser mostrada
 */
elgg_load_css("coordinacion");
$guid=  get_input('id');

$feria = new ElggFeria($guid);
elgg_push_breadcrumb(elgg_echo('ferias:menu:title'), 'ferias/');
elgg_push_breadcrumb($feria->name,"ferias/detalles/".$guid);
$title = $feria->name;
$ferias_municipales = elgg_get_ferias_municipales_disponibles($feria->departamento);

foreach ($ferias_municipales as $feria_mun){
    $options[$feria_mun->name]=$feria_mun->guid;
}
$params = array ('ferias_municipales'=>$options, 'id_feria'=>$guid, 'nombre'=>$feria->name);
$content.= elgg_view('ferias/incluir_municipales', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());