<?php

/**
 * Action que permite registrar una evaluación a una expósicion en puesto de formato 3.2
 * 
 * @author CORTEX_DIEGOX
 */
/**
 * RECIBIENDO DATOS DEL FORM
 */
$guid_investigacion = get_input('guid_invest');
$guid_eval = get_input('guid_eval');
$guid_feria = get_input('guid_feria');
$guid_colegio = get_input('guid_colegio');
$municipio_dpto = get_input('dpto');
$name_grupo = get_input('name_grupo');
$name_inv = get_input('name_inv');
$name_maestro = get_input('colaborador');
$name_eval = get_input('name_eval');
$profesion_eval = get_input('profesion');
$institucion_eval = get_input('eval_colegio');
$categoria = get_input('categoria_inv');
$linea_tematica = get_input('linea_tematica');
$lineas_pre = get_input('lineas_pre');
$lineas_open = get_input('lineas_open');
//Apropiacion
$puntaje_presenta_claridad = get_input('puntaje_presenta_claridad');
$puntaje_explica_fundamentos = get_input('puntaje_explica_fundamentos');
$puntaje_proceso_metodologico = get_input('puntaje_proceso_metodologico');
$puntaje_innovacion_lograda = get_input('puntaje_innovacion_lograda');
$subtotal_apropiacion = get_input('subtotal_apropiacion');
//Capacidades
$puntaje_evidentes_capacidades = get_input('puntaje_evidentes_capacidades');
$subtotal_capacidades = get_input('subtotal_capacidades');
//Puesto
$puntaje_diseño_investigativo = get_input('puntaje_diseño_investigativo');
$subtotal_puesto = get_input('subtotal_puesto');
//Anexos
$puntaje_total = get_input('puntaje_total');
$obs = get_input('obs');
$guid_evaluacion_hecha = get_input('guid_evaluacion_hecho');

$linea = '';
if(!empty($linea_tematica)){
    $linea = $linea_tematica;
}elseif (!empty ($lineas_pre)) {
    $linea = $lineas_pre;
}elseif (!empty ($lineas_open)) {
    $linea = $lineas_open;
}
    

$evaluacion = get_entity($guid_evaluacion_hecha);
if (empty($guid_evaluacion_hecha)) {
    $evaluacion = new ElggEvalSustentacionOral_inv();
}

$evaluacion->municipio_dpto = $municipio_dpto;
$evaluacion->name_maestro = $name_maestro;
$evaluacion->name_grupo = $name_grupo;
$evaluacion->name_inv = $name_inv;
$evaluacion->name_eval = $name_eval;
$evaluacion->profesion_eval = $profesion_eval;
$evaluacion->institucion_eval = $institucion_eval;
$evaluacion->categoria = $categoria;
$evaluacion->linea_tematica = $linea;
//APROPIACION
$evaluacion->puntaje_presenta_claridad = $puntaje_presenta_claridad;
$evaluacion->puntaje_explica_fundamentos = $puntaje_explica_fundamentos;
$evaluacion->puntaje_proceso_metodologico = $puntaje_proceso_metodologico;
$evaluacion->puntaje_innovacion_lograda = $puntaje_innovacion_lograda;
$evaluacion->subtotal_apropiacion = $subtotal_apropiacion;
//Capacidades
$evaluacion->puntaje_evidentes_capacidades = $puntaje_evidentes_capacidades;
$evaluacion->subtotal_capacidades = $subtotal_capacidades;
//Puesto
$evaluacion->puntaje_diseño_investigativo = $puntaje_diseño_investigativo;
$evaluacion->subtotal_puesto = $subtotal_puesto;
//Anexos
$evaluacion->puntaje_total = $puntaje_total;
$evaluacion->obs = $obs;



$result = $evaluacion->save();

if ($result) {

    $result_eval = add_entity_relationship($guid_investigacion, 'evaluada_3_en_' . $guid_feria . '_con', $evaluacion->guid);
    $eval3 = elgg_get_relationship(get_entity($guid_investigacion), 'evaluada_2.2_en_' . $guid_feria . '_con');

    if (sizeof($eval3) > 0) {
        remove_entity_relationship($guid_investigacion, 'evaluada_inicialmente_en', $guid_feria);
        add_entity_relationship($guid_investigacion, 'evaluada_en_sitio_en', $guid_feria);
    }


    system_messages(elgg_echo('evaluador:formtaos:evaluar5:register:ok'), 'success');

   // forward(elgg_get_site_url() . "evaluadores/listar_investigaciones_feria/$guid_feria#en_sitio");
} else {
    register_error(elgg_echo('inscripcion_evaluador_feria:acptado:fail'), 'error');
    
}


forward(REFERER);

