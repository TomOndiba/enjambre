<?php

elgg_load_css("coordinacion");

$guid=  get_input('id_evento');
$id_conv=  get_input('id_conv');

$evento = new ElggEvento($guid);
$entity= new ElggGroup($id_conv);


$subtype=$entity->getSubtype();
if($subtype=='convocatoria'){
    elgg_push_breadcrumb(elgg_echo('convocatorias:menu:title'), 'convocatorias/');
    elgg_push_breadcrumb($entity->name,"convocatorias/detalles/{$id_conv}");
}else if($subtype=='feria'){
    elgg_push_breadcrumb(elgg_echo('ferias:menu:title'), 'ferias/');
    elgg_push_breadcrumb($entity->name,"ferias/detalles/{$id_conv}");
}
elgg_push_breadcrumb('Eventos',"eventos/listado/{$id_conv}");
elgg_push_breadcrumb($title, "eventos/editar/{$guid}/{$id_conv}");


$params = array ('id_conv'=>$id_conv,'id'=>$guid, 'nombre'=>$evento->nombre_evento, 'fecha_inicio'=>$evento->fecha_inicio, 'tipo_evento'=>$evento->tipo_evento, 
                'fecha_terminacion'=>$evento->fecha_terminacion, 'fecha_lim_confirmacion'=>$evento->fecha_limite_confirmacion, 
                'lugar'=>$evento->lugar, 'max_asistentes'=>$evento->max_asistentes, 'objetivo'=>$evento->objetivo,
                'dirigido_a'=>$evento->dirigido_a, 'requisitos'=>$evento->requisitos_evento,);


$content .= elgg_view('eventos/edit_evento', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());