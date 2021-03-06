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
elgg_push_breadcrumb($nombre, "eventos/detalles/{$guid}/{$id_conv}");
elgg_push_breadcrumb('Lista de asistentes',"eventos/listar_asistentes/{$guid}/{$id_conv}");
elgg_push_breadcrumb('Registrar asistencia',"eventos/registro_asistencia/{$guid}/{$id_conv}");

$preinscritos = elgg_get_relationship_inversa($evento, "inscrito_al_evento");

$preinscritos_ev=array();

foreach ($preinscritos as $pre) {
    $user= array('id_usuario'=>$pre->guid, 'nombres_usuario'=>$pre->name, 'apellidos_usuario'=>$pre->apellidos);
    array_push($preinscritos_ev, $user);
}

$params = array ('id_conv'=>$id_conv,'id'=>$guid, 'nombre'=>$evento->nombre_evento, 'nombre_conv'=>$entity->name, 'preinscritos'=>$preinscritos_ev);
$content.= elgg_view('eventos/register_asistencia', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());