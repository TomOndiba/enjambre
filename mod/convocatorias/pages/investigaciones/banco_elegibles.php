<?php

elgg_load_css('reveal');
elgg_load_css("coordinacion");
$title = "Banco de Investigaciones Elegibles";
$guid=get_input("id");
$elegibles=elgg_get_investigaciones_elegibles($guid);
$lista=array();

foreach($elegibles as $inv){
    $conv=  elgg_get_relationship($inv, "evaluada_en_convocatoria")[0];
    $linea=  elgg_get_relationship($inv, "evaluada_en_{$conv->guid}_con_linea_tematica")[0];
    $invest= array('id_inv'=>$inv->guid, 'nombre'=>$inv->name, 'id_conv'=>$conv->guid, 'convocatoria'=>$conv->name, 'id_linea'=>$linea->guid, 'linea'=>$linea->name, 'fecha_cierre'=>$conv->fecha_cierre);
    array_push($lista, $invest);
}

$params=array("guid_convocatoria"=>  $guid, "investigaciones"=>$lista);
$content = elgg_view_form('investigaciones/seleccionar_elegibles', null, $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
