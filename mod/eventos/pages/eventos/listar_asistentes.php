<?php

elgg_load_css("coordinacion");

$guid=  get_input('id_evento');
$id_conv=  get_input('id_conv');
$evento= new ElggEvento($guid);
$entity= new ElggGroup($id_conv);
$nombre= $evento->title;


$subtype=$entity->getSubtype();
if($subtype=='convocatoria'){
    elgg_push_breadcrumb(elgg_echo('convocatorias:menu:title'), 'convocatorias/');
    elgg_push_breadcrumb($entity->name,"convocatorias/detalles/{$id_conv}");
}else if($subtype=='feria'){
    elgg_push_breadcrumb(elgg_echo('ferias:menu:title'), 'ferias/');
    elgg_push_breadcrumb($entity->name,"ferias/detalles/{$id_conv}");
}

elgg_push_breadcrumb('Eventos',"eventos/listado/{$id_conv}");
elgg_push_breadcrumb("{$nombre}","eventos/detalles/{$guid}/{$id_conv}");
elgg_push_breadcrumb('Lista de asistentes',"eventos/listar_asistentes/{$guid}/{$id_conv}");
$asistentes = elgg_get_relationship_inversa($evento, "asistió_al_evento");

$asist = array();
foreach ($asistentes as $user) {
    $us = array('id_usuario' => $user->guid, 'nombres_usuario' => $user->name, 'apellidos_usuario' => $user->apellidos, 'tipo_documento'=>$user->tipo_documento,
           'numero_documento'=>$user->numero_documento, 'email'=>$user->email, 'tipo_user'=>$user->getSubtype());
    array_push($asist, $us);
}
$params = array ('id_conv'=>$id_conv,'id'=>$guid, 'asistentes'=>$asist, 'nombre'=>$evento->nombre_evento, 'nombre_conv'=>$entity->name);

$content.= elgg_view('eventos/listado_asistentes', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());