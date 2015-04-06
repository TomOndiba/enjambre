<?php



$title = "Nuevo evento";

$guid=  get_input('id');
$entity = new ElggGroup($guid);
elgg_load_css("coordinacion");
$subtype=$entity->getSubtype();
if($subtype=='convocatoria'){
    elgg_push_breadcrumb(elgg_echo('convocatorias:menu:title'), 'convocatorias/');
    elgg_push_breadcrumb($entity->name,"convocatorias/detalles/{$id_conv}");
}else if($subtype=='feria'){
    elgg_push_breadcrumb(elgg_echo('ferias:menu:title'), 'ferias/');
    elgg_push_breadcrumb($entity->name,"ferias/detalles/{$id_conv}");
}

elgg_push_breadcrumb('Eventos',"eventos/listado/{$guid}");
elgg_push_breadcrumb('Registrar Nuevo',"eventos/registro_evento/{$guid}");
$params = array('id'=>$guid, 'nombre'=>$entity->name);
$content .= elgg_view('eventos/register_evento', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());


