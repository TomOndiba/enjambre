<?php

/**
 * Page que redirecciona al formato para llenar la evaluación de un informe de
 * investigación.
 */


$guid_inv = get_input('guid_inv');

$guid_feria = get_input('guid_f');

$guid_evaluacion = get_input('guid_eval');

$datos_evaluacion = array();
if(!empty($guid_evaluacion)){
    $url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $guid_evaluacion . '&bit=93';
    $url_print = elgg_add_action_tokens_to_url($url1);
    
    $evaluacion = new ElggEvaluacionCompInnovacionInvCuad($guid_evaluacion);
    $datos_evaluacion = array('guid_evaluacion_hecho' => $guid_evaluacion, 
        //Findamentos
        'fundamentos_conocimiento' => $evaluacion->fundamentos_conocimiento,
        'puntaje_fundamentos_conocimiento' => $evaluacion->puntaje_fundamentos_conocimiento, 
        'propuesta_metodologica' => $evaluacion->propuesta_metodologica, 
        'puntaje_propuesta_metodologica' => $evaluacion->puntaje_propuesta_metodologica, 
        'existe_coherencia' => $evaluacion->existe_coherencia, 
        'puntaje_existe_coherencia' => $evaluacion->puntaje_existe_coherencia, 
        'subtotal_fundamentacion' => $evaluacion->subtotal_fundamentacion, 
        //Tipos y proceso de
        'forma_original' => $evaluacion->forma_original, 
        'puntaje_forma_original' => $evaluacion->puntaje_forma_original, 
        'argumenta_transformacion' => $evaluacion->argumenta_transformacion, 
        'puntaje_argumenta_transformacion' => $evaluacion->puntaje_argumenta_transformacion, 
        'proceso_investigativo' => $evaluacion->proceso_investigativo, 
        'puntaje_proceso_investigativo' => $evaluacion->puntaje_proceso_investigativo, 
        'subtotal_tipos' => $evaluacion->subtotal_tipos,
        //Pertinencia e impacto
        'grado_elaboracion' => $evaluacion->grado_elaboracion, 
        'puntaje_grado_elaboracion' => $evaluacion->puntaje_grado_elaboracion, 
        'resultados_investigacion' => $evaluacion->resultados_investigacion, 
        'puntaje_resultados_investigacion' => $evaluacion->puntaje_resultados_investigacion, 
        'evolucion_desarrollo' => $evaluacion->evolucion_desarrollo, 
        'puntaje_evolucion_desarrollo' => $evaluacion->puntaje_evolucion_desarrollo, 
        'subtotal_impacto' => $evaluacion->subtotal_impacto, 
        //Apropiación
        'dinamica_vivida' => $evaluacion->dinamica_vivida, 
        'puntaje_dinamica_vivida' => $evaluacion->puntaje_dinamica_vivida, 
        'social_logrado' => $evaluacion->social_logrado, 
        'puntaje_social_logrado' => $evaluacion->puntaje_social_logrado, 
        'importancia_social' => $evaluacion->importancia_social, 
        'puntaje_importancia_social' => $evaluacion->puntaje_importancia_social, 
        'subtotal_apropiacion' => $evaluacion->subtotal_apropiacion, 
        //Anexo
        'puntaje_total' => $evaluacion->puntaje_total, 
        'observaciones' => $evaluacion->observaciones,         
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

//Verificamos las subcategorias de innovación para cargarlas en el form
if(empty($inscripcion->subcategorias_innovacion)){
$subcategorias_innova = listar_subcategorias_innovacion();
$subcat = array();
if(sizeof($subcategorias_innova) > 0){
    foreach ($subcategorias_innova as $s){
        $subcat[$s->title] = $s->guid;
    }
}

    }

//validamos que la investigación tenga linea temática... 
$lineas_preestructuradas = array();
$lines_abiertas = array();
$linea_inv = '';
if(empty($investigacion->linea_tematica)){
    $todas_lineas = listar_lineas();
    foreach ($todas_lineas as $li){
        if($li->tipo == 'Proyectos abiertos'){
            $lines_abiertas[$li->name] = $li->guid;
        }else{
            $lineas_preestructuradas[$li->name] = $li->guid;
        }
    }
}else{
    $linea_inv = get_entity($investigacion->linea_tematica)->name;
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
    'eval_hecha' => $datos_evaluacion,
    'subcate' => $subcat,
    'linea_tematica' => $linea_inv,
    'lineas_pre' => $lineas_preestructuradas,
    'lines_open' => $lines_abiertas);

$content = elgg_view_form('formatos_evaluacion_feria/formato_eval_informeinv_diariocampoINN', NULL, $params);

$vars = array('content' => $content);
$body = elgg_view_layout('one_column', $vars);
echo elgg_view_page($title, $body);
