<?php
/**
 * Página que prepara los datos de una feria existente, para ser mostrados en un formulario para su edición
 */
elgg_load_css("coordinacion");

elgg_load_library('elgg:file');
$id = get_input('id');

$feria= new ElggFeria($id);

$title = $feria->name;

elgg_push_breadcrumb(elgg_echo('ferias:menu:title'), 'ferias/');
elgg_push_breadcrumb(elgg_echo('Editar feria'), 'ferias/edit');
//$form_vars = array('enctype' => 'multipart/form-data');
$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt',
);
$content = elgg_view_title($title);
$url1= elgg_get_site_url()."action/ferias/edit?id=".$lineaa->guid;
$url_editar= elgg_add_action_tokens_to_url($url1);
$params = array ('id'=>$id,'nombre'=>$feria->name, 'descripcion'=>$feria->descripcion, 'objetivos'=>$feria->objetivos,
                 'correos_contacto'=>$feria->correos_contacto, 'fecha_inicio_feria'=>$feria->fecha_inicio_feria, 
                 'fecha_fin_feria'=>$feria->fecha_fin_feria, 'fecha_inicio_inscripciones'=>$feria->fecha_inicio_inscripciones,
                 'fecha_fin_inscripciones'=>$feria->fecha_fin_inscripciones, 'valor_inscripcion'=>$feria->valor_inscripcion, 
                 'fecha_montaje_puestos'=>$feria->fecha_montaje_puestos, 'hora_montaje_puestos'=>$feria->hora_montaje_puestos, 
                 'fecha_desmontaje_puestos'=>$feria->fecha_desmontaje_puestos, 'hora_desmontaje_puestos'=>$feria->hora_desmontaje_puestos,
                 'tipo_feria'=>$feria->tipo_feria, 'formas_participacion'=>$feria->formas_participacion,
                 'max_inscritos'=>$feria->max_inscritos, 'premios_distinciones'=>$feria->premios_distinciones, 'actividades'=>$feria->actividades,
                 'requisitos_participacion'=>$feria->requisitos_participacion, 'publico_invitado'=>$feria->publico_invitado,
                 'costos_organizadores'=>$feria->costos_organizadores, 'parametros_puestos'=>$feria->parametros_puestos,
                 'herramientas_presentaciones'=>$feria->herramientas_presentaciones, 'proceso_valoracion'=>$feria->proceso_valoracion,
                 'agenda_feria'=>$feria->agenda_feria, 'reglamento_feria'=>$feria->reglamento_feria,
                 'href_edit'=>$url_editar); 
$content.= elgg_view_form('ferias/edit_feria', $form_vars,$params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());