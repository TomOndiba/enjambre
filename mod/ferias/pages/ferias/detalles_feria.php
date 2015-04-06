<?php
/**
 * Página que consulta la información detallada de una feria seleccionada y la envía a la vista para ser mostrada
 */
elgg_load_css("coordinacion");

$guid=  get_input('id');

$feria = new ElggFeria($guid);
elgg_push_breadcrumb(elgg_echo('ferias:menu:title'), 'ferias/');
elgg_push_breadcrumb($feria->name,"ferias/detalles/".$guid);

$params = array ('id'=>$guid,'nombre'=>$feria->name, 'descripcion'=>$feria->descripcion, 'objetivos'=>$feria->objetivos,
                 'correos_contacto'=>$feria->correos_contacto, 'fecha_inicio_feria'=>$feria->fecha_inicio_feria, 
                 'fecha_fin_feria'=>$feria->fecha_fin_feria, 'fecha_inicio_inscripciones'=>$feria->fecha_inicio_inscripciones,
                 'fecha_fin_inscripciones'=>$feria->fecha_fin_inscripciones, 'valor_inscripcion'=>$feria->valor_inscripcion, 
                 'fecha_montaje_puestos'=>$feria->fecha_montaje_puestos, 'hora_montaje_puestos'=>$feria->hora_montaje_puestos, 
                 'fecha_desmontaje_puestos'=>$feria->fecha_desmontaje_puestos, 'hora_desmontaje_puestos'=>$feria->hora_desmontaje_puestos,
                 'tipo_feria'=>$feria->tipo_feria, 'departamento'=>$feria->departamento, 'municipios'=>$feria->municipios, 'formas_participacion'=>$feria->formas_participacion,
                 'max_inscritos'=>$feria->max_inscritos, 'premios_distinciones'=>$feria->premios_distinciones, 'actividades'=>$feria->actividades,
                 'requisitos_participacion'=>$feria->requisitos_participacion, 'publico_invitado'=>$feria->publico_invitado,
                 'costos_organizadores'=>$feria->costos_organizadores, 'parametros_puestos'=>$feria->parametros_puestos,
                 'herramientas_presentaciones'=>$feria->herramientas_presentaciones, 'proceso_valoracion'=>$feria->proceso_valoracion,
                 'agenda_feria'=>$feria->agenda_feria, 'reglamento_feria'=>$feria->reglamento_feria, 'institucion' => get_entity($feria->institucion)->name);
$content.= elgg_view('ferias/profile_feria', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());