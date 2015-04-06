<?php

/**
 * Action que permite registrar una evaluación a un informe de investigación de formato 4.1
 * categoria investigacion - componente investigacion, hecha por 
 * un evaluador.
 * 
 * @author CORTEX_DIEGOX
 */
/**
 * RECIBIENDO DATOS DEL FORM
 */
$guid_investigacion = get_input('guid_invest');
$guid_eval = get_input('guid_eval');
$guid_feria = get_input('guid_feria');
$dpto = get_input('dpto');
$name_grupo = get_input('name_grupo');
$name_inv = get_input('name_inv');
$colaborador = get_input('colaborador');
$name_eval = get_input('name_eval');
$colegio_eval = get_input('eval_colegio');
$profesion_eval = get_input('profesion');
$categoria_inv = get_input('categoria_inv');
$linea_tematica = get_input('linea_tematica');
$lineas_pre = get_input('lineas_pre');
$lineas_open = get_input('lineas_open');
$guid_evaluacion_hecha = get_input('guid_evaluacion_hecho');

$obj_feria = new ElggFeria($guid_feria);
$tipo_feria = $obj_feria->tipo_feria;

if ($tipo_feria == 'Municipal') {
    $rel = "mun";
} else if ($tipo_feria == 'Departamental') {
    $rel = "dptal";
}

/**
 * COHERENCIA
 */
$puntaje_trabajo_colaborativo = get_input('puntaje_trabajo_colaborativo');
$puntaje_claridad_pregunta = get_input('puntaje_claridad_pregunta');
$subtotal_coherencia = get_input('subtotal_coherencia');

/**
 * RUTA_INDAGACION
 */
$puntaje_diseño_metodologico = get_input('puntaje_diseño_metodologico');
$puntaje_conceptos_investigacion = get_input('puntaje_conceptos_investigacion');
$puntaje_resultados_claros = get_input('puntaje_resultados_claros');
$subtotal_ruta = get_input('subtotal_ruta');

/**
 * FUENTES
 */
$puntaje_forma_adecuada = get_input('puntaje_forma_adecuada');
$subtotal_fuentes = get_input('subtotal_fuentes');

/**
 * ANEXOS
 */
$puntaje_total = get_input('puntaje_total');
$obs = get_input('observaciones');



/**
 * Verico que lineas temáticas llegan para guardarlas
 */
$lin_tem = '';
if (sizeof($linea_tematica) > 0) {
    $lin_tem = $linea_tematica;
} else if (sizeof($lineas_pre) > 0) {
    $lin_tem = $lineas_pre;
} else if (sizeof($lineas_open) > 0) {
    $lin_tem = $lineas_open;
}

$evaluacion = get_entity($guid_evaluacion_hecha);
if (empty($guid_evaluacion_hecha)) {
    $evaluacion = new ElggEvaluarInformeInvCuadCampoINN_inv();
}

$evaluacion->municipio_dpto = $dpto;
$evaluacion->name_grupo = $name_grupo;
$evaluacion->name_inv = $name_inv;
$evaluacion->name_maestroAcomp = $colaborador;
$evaluacion->name_eval = $name_eval;
$evaluacion->profesion_eval = $profesion_eval;
$evaluacion->institucion_eval = $colegio_eval;
$evaluacion->categoria = $categoria_inv;
$evaluacion->linea_tematica = $lin_tem;
//COHERENCIA
$evaluacion->puntaje_trabajo_colaborativo = $puntaje_trabajo_colaborativo;
$evaluacion->puntaje_claridad_pregunta = $puntaje_claridad_pregunta;
$evaluacion->subtotal_coherencia = $subtotal_coherencia;
//RUTA_INDAGACION
$evaluacion->puntaje_diseño_metodologico = $puntaje_diseño_metodologico;
$evaluacion->puntaje_conceptos_investigacion = $puntaje_conceptos_investigacion;
$evaluacion->puntaje_resultados_claros = $puntaje_resultados_claros;
$evaluacion->subtotal_ruta = $subtotal_ruta;
//FUENTES
$evaluacion->puntaje_forma_adecuada = $puntaje_forma_adecuada;
$evaluacion->subtotal_fuentes = $subtotal_fuentes;
//ANEXOS
$evaluacion->puntaje_total = $puntaje_total;
$evaluacion->observaciones = $obs;

$result = $evaluacion->save();

if ($result) {

    $result_eval = add_entity_relationship($guid_investigacion, 'evaluada_4_en_' . $guid_feria . '_con', $evaluacion->guid);
    $eval2_1 = elgg_get_relationship(get_entity($guid_investigacion), 'evaluada_2.1_en_' . $guid_feria . '_con');
    //Valida la categoria para realizar la operación creando las relaciones y eliminando las cosas
    if ($categoria_inv == "Innovación") {
        $eval4 = elgg_get_relationship(get_entity($guid_investigacion), 'evaluada_5_en_' . $guid_feria . '_con');
        if ($result_eval && sizeof($eval4) > 0 && sizeof($eval2_1) > 0) {
            remove_entity_relationship($guid_investigacion, 'acreditada_en', $guid_feria);
            add_entity_relationship($guid_investigacion, 'evaluada_inicialmente_en', $guid_feria);
            $feriaa = new ElggFeria($guid_feria);
            $investigacion = new ElggInvestigacion($guid_investigacion);
            $evaluador_ini = elgg_get_relationship_inversa($investigacion, "es_evaluador_inicial_" . $rel . "_de");

            $create_relation = add_entity_relationship($evaluador_ini[0]->guid, 'es_evaluador_en_sitio_' . $rel . '_de', $guid_investigacion);
            if ($create_relation) {
                $evalu = get_entity($guid_eval);
                messages_send('Seleccionado como evaluador en sitio de investigación', 'Usted ha sido seleccionado como '
                        . 'evaluador en sitio de la investigación "' . $investigacion->name . '" acreditada como participante '
                        . 'y evaluada inicialmente en la feria "' . $feriaa->name . '".', $evalu->guid, 0, false);
                if (!empty($evalu->email)) {
                    elgg_enviar_correo($evalu->email, 'Seleccionado como evaluador en sitio de investigación', 'Usted ha sido seleccionado como evaluador en sitio de la investigación "' . $investigacion->name .
                            '" acreditada como participante y evaluada inicialmente en la feria "' . $feriaa->name . '".');
                }
            }
        }
    } else {
        if ($result_eval && sizeof($eval2_1) > 0) {
            remove_entity_relationship($guid_investigacion, 'acreditada_en', $guid_feria);
            add_entity_relationship($guid_investigacion, 'evaluada_inicialmente_en', $guid_feria);
            $feriaa = new ElggFeria($guid_feria);
            $investigacion = new ElggInvestigacion($guid_investigacion);
            $evaluador_ini = elgg_get_relationship_inversa($investigacion, "es_evaluador_inicial_" . $rel . "_de");

            $create_relation = add_entity_relationship($evaluador_ini[0]->guid, 'es_evaluador_en_sitio_' . $rel . '_de', $guid_investigacion);
            if ($create_relation) {
                $evalu = get_entity($guid_eval);
                messages_send('Seleccionado como evaluador en sitio de investigación', 'Usted ha sido seleccionado como '
                        . 'evaluador en sitio de la investigación "' . $investigacion->name . '" acreditada como participante '
                        . 'y evaluada inicialmente en la feria "' . $feriaa->name . '".', $evalu->guid, 0, false);
                if (!empty($evalu->email)) {
                    elgg_enviar_correo($evalu->email, 'Seleccionado como evaluador en sitio de investigación', 'Usted ha sido seleccionado como evaluador en sitio de la investigación "' . $investigacion->name .
                            '" acreditada como participante y evaluada inicialmente en la feria "' . $feriaa->name . '".');
                }
            }
        }
    }

    system_messages(elgg_echo('evaluador:formtaos:evaluar5:register:ok'), 'success');

    //forward(elgg_get_site_url() . "evaluadores/listar_investigaciones_feria/$guid_feria#inicial");
    forward(REFERER);
} else {
    register_error(elgg_echo('inscripcion_evaluador:acptado:fail'), 'error');
    forward(REFERER);
}

