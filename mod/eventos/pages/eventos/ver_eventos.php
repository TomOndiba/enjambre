<?php

$id_conv=  get_input('id_conv');
$entity= new ElggGroup($id_conv);
$eventos= elgg_get_relationship($entity, 'tiene_el_evento');
elgg_load_css("coordinacion");
$title = "Eventos de  $entity->name";

$subtype=$entity->getSubtype();
if($subtype=='convocatoria'){
    elgg_push_breadcrumb(elgg_echo('convocatorias:menu:title'), 'convocatorias/');
    elgg_push_breadcrumb($entity->name,"convocatorias/detalles/{$id_conv}");
}else if($subtype=='feria'){
    elgg_push_breadcrumb(elgg_echo('ferias:menu:title'), 'ferias/');
    elgg_push_breadcrumb($entity->name,"ferias/detalles/{$id_conv}");
}
elgg_push_breadcrumb('Eventos',"eventos/listado/{$id_conv}");
$lista_eventos= Array();
foreach ($eventos as $ev) {  
    
    $url_detalles= elgg_get_site_url()."eventos/detalles/$ev->guid/".$entity->guid;
    
    $url_editar= elgg_get_site_url()."eventos/editar/$ev->guid/".$entity->guid;
    
    $url1= elgg_get_site_url()."action/eventos/eliminar?id_evento=".$ev->guid."&id_conv=".$entity->guid;
    $url_eliminar= elgg_add_action_tokens_to_url($url1);
    
    
    $event= array('id'=>$ev->guid, 'nombre'=>$ev->nombre_evento, 'fecha_limite_confirm'=>$ev->fecha_limite_confirmacion, 'tipo_evento'=>$ev->tipo_evento,
                    'fecha_inicio'=>$ev->fecha_inicio, 'lugar'=>$ev->lugar, 'href_editar'=>$url_editar,
                    'fecha_terminacion'=>$ev->fecha_terminacion, 'href_detalles' => $url_detalles, 'href_eliminar' => $url_eliminar,);
    array_push($lista_eventos, $event);
}

$params = array ('id_conv'=>$id_conv,'lista_eventos'=>$lista_eventos, 'tipo_entity'=>$subtype, 'nombre_convocatoria'=>$entity->name);
$content.= elgg_view('eventos/listado_eventos', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
