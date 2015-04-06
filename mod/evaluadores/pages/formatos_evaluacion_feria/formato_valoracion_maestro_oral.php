<?php


/**
 * Page en el que se recopila la información para redireccionar al formulario 
 * formato_valoracion_maestro_oral
 * 
 * @author DIEGOX_CORTEX
 */

$guid_inv = get_input('guid_inv');

$guid_feria = get_input('guid_f');

$guid_evaluacion = get_input('guid_eval');
$datos_evaluacion = array();
if(!empty($guid_evaluacion)){
    $url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $guid_evaluacion . '&bit=96';
    $url_print = elgg_add_action_tokens_to_url($url1);
    
    $evaluacion = new ElggEvalMaestroEscrito($guid_evaluacion);
    $datos_evaluacion = array('guid_evaluacion_hecho' => $guid_evaluacion, 
        'visible_reflexiones' => $evaluacion->visible_reflexiones,
        'puntaje_visible_reflexiones' => $evaluacion->puntaje_visible_reflexiones,
        'practica_pedagogica' => $evaluacion->practica_pedagogica,
        'puntaje_practica_pedagogica' => $evaluacion->puntaje_practica_pedagogica,
        'aprendizajes_propios' => $evaluacion->aprendizajes_propios,
        'puntaje_aprendizajes_propios' => $evaluacion->puntaje_aprendizajes_propios,
        'reflexion_presentada' => $evaluacion->reflexion_presentada,
        'puntaje_reflexion_presentada' => $evaluacion->puntaje_reflexion_presentada,
        'puntaje_total' => $evaluacion->puntaje_total,
        'obs' => $evaluacion->obs,           
        'url_print' => $url_print);
}



$investigacion = new ElggInvestigacion($guid_inv);
$feria = new ElggFeria($guid_feria);
$inscripcion = elgg_get_relationship($investigacion, 'inscrita_en_' . $guid_feria . '_con');
// Busca la relacion del grupo con la investigacion  para enviar datos al formulario de registro y actualización
$grupo = elgg_get_relationship_inversa($investigacion, "tiene_la_investigacion");
// Busca la pregunta de investigacion  para enviar datos al formulario de registro y actualización
$pregunta = elgg_get_pregunta_investigacion($guid_inv);
if (check_entity_relationship($grupo[0]->guid, "tiene_la_investigacion", $guid_inv)) {
// Busca la relacion del grupo con la institución  para enviar datos al formulario de registro y actualización
    $institucion = elgg_get_relationship($grupo[0], "pertenece_a");
}



$user = elgg_get_logged_in_user_entity();
//obtenemos la institucion del evaluador
$colego_eval = (elgg_get_relationship($user, "trabaja_en"));
//obtenemos los colaboradores de la investigación
$colaborador = get_entity($investigacion->owner_guid);
$params = array(
    'guid_feria' => $guid_feria, 
    'guid_inv' => $guid_inv, 
    'guid_eval' => $user->guid, 
    'colegio_guid' => $institucion[0]->guid,
    'colegio_name' => $institucion[0]->name,
    'dpto' => $institucion[0]->departamento.' / '.$institucion[0]->municipio, 
    'nombre_grupo' => $grupo[0]->name,
    'inv_name' => $pregunta, 
    'colaborador' => $colaborador->name.' '.$colaborador->apellidos,
    'name_eval' => $user->name.' '.$user->apellidos, 
    'profesion_eval' => $user->especialidad,
    'colegio_eval' => $colego_eval[0]->name,
    'categoria' => $investigacion->categoria_inv,
    'eval_hecha' => $datos_evaluacion,);

$content = elgg_view_form('formatos_evaluacion_feria/formato_valoracion_maestro_oral', NULL, $params);

$vars = array('content' => $content);
$body = elgg_view_layout('one_column', $vars);
echo elgg_view_page($title, $body);



