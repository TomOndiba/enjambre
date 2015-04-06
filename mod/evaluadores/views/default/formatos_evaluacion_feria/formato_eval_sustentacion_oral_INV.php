<?php

/**
 * Page en el que se recopila la información para redireccionar al formulario 
 * formato_eval_sustentacion_oral_INV
 * 
 * @author DIEGOX_CORTEX
 */
elgg_load_js('sumar_4.2');
elgg_load_js('sumar_evalinfcuad');
elgg_load_js('sumar_4.1');
elgg_load_js('sumar_3_INN');
elgg_load_js('sumar_3_INV');
elgg_load_js('sumar2.1');
$guid_inv = get_input('guid_inv');

$guid_feria = get_input('guid_f');

$guid_evaluacion = get_input('guid_eval');
$datos_evaluacion = array();
if (!empty($guid_evaluacion)) {
    $url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $guid_evaluacion . '&bit=99';
    $url_print = elgg_add_action_tokens_to_url($url1);

    $evaluacion = new ElggEvalMaestroEscrito($guid_evaluacion);
    $datos_evaluacion = array('guid_evaluacion_hecho' => $guid_evaluacion,
        //Apropiacion
        'puntaje_presenta_claridad' => $evaluacion->puntaje_presenta_claridad,
        'puntaje_explica_fundamentos' => $evaluacion->puntaje_explica_fundamentos,
        'puntaje_proceso_metodologico' => $evaluacion->puntaje_proceso_metodologico,
        'puntaje_innovacion_lograda' => $evaluacion->puntaje_innovacion_lograda,
        'subtotal_apropiacion' => $evaluacion->subtotal_apropiacion,
        //Capacidades
        'puntaje_evidentes_capacidades' => $evaluacion->puntaje_evidentes_capacidades,
        'subtotal_capacidades' => $evaluacion->subtotal_capacidades,
        //Puesto
        'puntaje_diseño_investigativo' => $evaluacion->puntaje_diseño_investigativo,
        'subtotal_puesto' => $evaluacion->subtotal_puesto,
        //Anexos
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

//validamos que la investigación tenga linea temática... 
$linea_invPRECAR = "";
if (empty($inscripcion[0]->linea_tematica)) {
    $lineas_preestructuradas = array();
    $lines_abiertas = array();
    $linea_inv = '';
    if (empty($investigacion->linea_tematica)) {
        $todas_lineas = listar_lineas();
        foreach ($todas_lineas as $li) {
            if ($li->tipo == 'Proyectos abiertos') {
                $lines_abiertas[$li->name] = $li->guid;
            } else {
                $lineas_preestructuradas[$li->name] = $li->guid;
            }
        }
    } else {
        $linea_inv = get_entity($investigacion->linea_tematica)->name;
    }
} else {
    $linea_invPRECAR = $inscripcion[0]->linea_tematica;
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
    'colegio_name' => $institucion[0]->name,
    'dpto' => $institucion[0]->departamento . ' / ' . $institucion[0]->municipio,
    'nombre_grupo' => $grupo[0]->name,
    'inv_name' => $pregunta,
    'colaborador' => $colaborador->name . ' ' . $colaborador->apellidos,
    'name_eval' => $user->name . ' ' . $user->apellidos,
    'profesion_eval' => $user->especialidad,
    'colegio_eval' => $colego_eval[0]->name,
    'categoria' => $investigacion->categoria_inv,
    'eval_hecha' => $datos_evaluacion,
    'linea_tematica' => $linea_inv,
    'linea_open' => $lines_abiertas,
    'linea_pre' => $lineas_preestructuradas,
    'lineaPRECAR' => $linea_invPRECAR);

$content = elgg_view_form('formatos_evaluacion_feria/formato_eval_sustentacion_oral_INV', NULL, $params);

//$vars = array('content' => $content);
//$body = elgg_view_layout('one_column', $vars);
//echo elgg_view_page($title, $body);

echo $content;


