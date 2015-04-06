<?php
/**
 * Página que consulta la información detallada de una convocatoria seleccionada y la envía a la vista para ser mostrada
 */

$guid=  get_input('id');
elgg_load_css("coordinacion");
$convocatoria = new ElggConvocatoria($guid);
$especial = "Normal";
if($convocatoria->especial){
    $especial= "Especial";
}
$params = array ('id'=>$guid, 'tipo_convocatoria'=>$convocatoria->tipo_convocatoria,'nombre'=>$convocatoria->name, 
                'departamento'=>$convocatoria->departamento, 'convenio'=>$convocatoria->convenio, 'fecha_apertura'=>$convocatoria->fecha_apertura, 
                'fecha_cierre'=>$convocatoria->fecha_cierre, 'hora_cierre'=>$convocatoria->hora_cierre, 'fecha_pub_resultados'=>$convocatoria->fecha_pub_resultados,
                'proceso_pedagogico'=>$convocatoria->proceso_pedagogico, 'requisitos'=>$convocatoria->requisitos, 'no_aplica'=>$convocatoria->no_aplica,
                'objetivos'=>$convocatoria->objetivos, 'publico'=>$convocatoria->publico, 'criterios'=>$convocatoria->criterios_revision_seleccion,
    'especial'=>$especial);
$content.= elgg_view('convocatorias/profile_convocatoria', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());