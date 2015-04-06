<?php

/**
 * Page en el que se recopila la información para redireccionar al formulario 
 * formato_eval_informeinv_diariocampoINN_inv
 * 
 * @author DIEGOX_CORTEX
 */

$guid_inv = get_input('guid_inv');

$guid_feria = get_input('guid_f');

$guid_evaluacion = get_input('guid_eval');

$datos_evaluacion = array();
if(!empty($guid_evaluacion)){
    $url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $guid_evaluacion . '&bit=94';
    $url_print = elgg_add_action_tokens_to_url($url1);
    
    $evaluacion = new ElggEvaluacionCompInnovacionInvCuad($guid_evaluacion);
    $datos_evaluacion = array('guid_evaluacion_hecho' => $guid_evaluacion, 
        //COHERENCIA
        'puntaje_trabajo_colaborativo' => $evaluacion->puntaje_trabajo_colaborativo,
        'puntaje_relacion_pregunta' => $evaluacion->puntaje_relacion_pregunta,
        'subtotal_coherencia' => $evaluacion->subtotal_coherencia,
        //RUTA_INDAGACION
        'puntaje_diseño_metodologico' => $evaluacion->puntaje_diseño_metodologico,
        'puntaje_conocimientos_conceptos' => $evaluacion->puntaje_conocimientos_conceptos,
        'puntaje_resultados_claros' => $evaluacion->puntaje_resultados_claros,
        'subtotal_ruta' => $evaluacion->subtotal_ruta,
        //FUENTES
        'puntaje_forma_adecuada' => $evaluacion->puntaje_forma_adecuada,
        'subtotal_fuentes' => $evaluacion->subtotal_fuentes,
        //ANEXOS
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
$subcategorias_innova = listar_subcategorias_innovacion();
$subcat = array();
if(sizeof($subcategorias_innova) > 0){
    foreach ($subcategorias_innova as $s){
        $subcat[$s->title] = $s->guid;
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
    'categoria_inv' => $investigacion->categoria_inv,
    'linea_tematica' => $linea_inv,
    'lineas_pre' => $lineas_preestructuradas,
    'lines_open' => $lines_abiertas);

$content = elgg_view_form('formatos_evaluacion_feria/formato_eval_informeinv_diariocampoINN_inv', NULL, $params);

$vars = array('content' => $content);
$body = elgg_view_layout('one_column', $vars);
echo elgg_view_page($title, $body);


