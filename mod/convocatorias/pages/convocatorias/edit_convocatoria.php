<?php
/**
 * Página que prepara los datos de una convocatoria existente, para ser mostrados en un formulario para su edición
 */

elgg_load_css("coordinacion");
$id = get_input('id');

$convocatoria_vieja = new ElggConvocatoria($id);

$title = $convocatoria_vieja->name;

$content = elgg_view_title($title);
$url1= elgg_get_site_url()."action/convocatorias/edit?id=".$lineaa->guid;
$url_editar= elgg_add_action_tokens_to_url($url1);
$params = array ('ide'=>$convocatoria_vieja->guid, 'nombre'=>$convocatoria_vieja->name, 'tipo'=>$convocatoria_vieja->tipo_convocatoria, 'dpto'=>$convocatoria_vieja->departamento, 
                 'convenio'=>$convocatoria_vieja->convenio, 'f_apertura'=>$convocatoria_vieja->fecha_apertura,'f_cierre'=>$convocatoria_vieja->fecha_cierre, 'h_cierre'=>$convocatoria_vieja->hora_cierre, 'f_pubresultados'=>$convocatoria_vieja->fecha_pub_resultados,
                 'proceso_pedagogico'=>$convocatoria_vieja->proceso_pedagogico, 'requisitos'=>$convocatoria_vieja->requisitos, 'no_aplica'=>$convocatoria_vieja->no_aplica, 'objetivos'=>$convocatoria_vieja->objetivos,
                 'publico'=>$convocatoria_vieja->publico, 'presupuesto'=>$convocatoria_vieja->presupuesto, 'criterios_revision_seleccion'=>$convocatoria_vieja->criterios_revision_seleccion, 'href_edit'=>$url_editar); 

$content.= elgg_view_form('convocatorias/edit_convocatoria', NULL,$params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());