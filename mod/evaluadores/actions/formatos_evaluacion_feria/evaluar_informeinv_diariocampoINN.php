<?php

/**
 * Action que permite registrar una evaluación a un informe de investigación, hecha por 
 * un evaluador.
 * 
 * FORMATO 5 COMPONENTE INNOVACION -> CATEGORIA INNOVACION
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
$dpto = get_input('dpto');
$nom_colegio = get_input('colegio');
$name_grupo = get_input('name_grupo');
$name_inv = get_input('name_inv');
$colaborador = get_input('colaborador');
$name_eval = get_input('name_eval');
$colegio_eval = get_input('eval_colegio');
$profesion_eval = get_input('profesion');
$tipo_innovacion = get_input('tipo_innovacion');
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
 * FUNDAMENTACION
 */
$fundamentos_conocimiento = get_input('fundamentos_conocimiento');
$puntaje_fundamentos_conocimiento = get_input('puntaje_fundamentos_conocimiento');
$propuesta_metodologica = get_input('propuesta_metodologica');
$puntaje_propuesta_metodologica = get_input('puntaje_propuesta_metodologica');
$existe_coherencia = get_input('existe_coherencia');
$puntaje_existe_coherencia = get_input('puntaje_existe_coherencia');
$subtotal_fundamentacion = get_input('subtotal_fundamentacion');

/**
 * TIPOS Y PROCESO
 */
$forma_original = get_input('forma_original');
$puntaje_forma_original = get_input('puntaje_forma_original');
$argumenta_transformacion = get_input('argumenta_transformacion');
$puntaje_argumenta_transformacion = get_input('puntaje_argumenta_transformacion');
$proceso_investigativo = get_input('proceso_investigativo');
$puntaje_proceso_investigativo = get_input('puntaje_proceso_investigativo');
$subtotal_tipos = get_input('subtotal_tipos');

/**
 * PERTINENCIA E IMPACTO
 */
$grado_elaboracion = get_input('grado_elaboracion');
$puntaje_grado_elaboracion = get_input('puntaje_grado_elaboracion');
$resultados_investigacion = get_input('resultados_investigacion');
$puntaje_resultados_investigacion = get_input('puntaje_resultados_investigacion');
$evolucion_desarrollo = get_input('evolucion_desarrollo');
$puntaje_evolucion_desarrollo = get_input('puntaje_evolucion_desarrollo');
$subtotal_impacto = get_input('subtotal_impacto');

/**
 * APROPIACIÓN
 */
$dinamica_vivida = get_input('dinamica_vivida');
$puntaje_dinamica_vivida = get_input('puntaje_dinamica_vivida');
$social_logrado = get_input('social_logrado');
$puntaje_social_logrado = get_input('puntaje_social_logrado');
$importancia_social = get_input('importancia_social');
$puntaje_importancia_social = get_input('puntaje_importancia_social');
$subtotal_apropiacion = get_input('subtotal_apropiacion');

/**
 * ANEXOS
 */
$puntaje_total = get_input('puntaje_total');
$obs = get_input('obs');

/**
 * Verifico la entrada de los tipos de innovacion para guardarlas
 */
$innovacion = '';
if (sizeof($tipo_innovacion) > 0) {
    foreach ($tipo_innovacion as $in) {
        $innovacion .= $in . '&';
    }
}

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
    $evaluacion = new ElggEvaluacionCompInnovacionInvCuad();
}

$evaluacion->municipio_dpto = $dpto;
$evaluacion->institucion = $nom_colegio;
$evaluacion->name_grupo = $name_grupo;
$evaluacion->name_inv = $name_inv;
$evaluacion->name_maestroAcomp = $colaborador;
$evaluacion->name_eval = $name_eval;
$evaluacion->profesion_eval = $profesion_eval;
$evaluacion->institucion_eval = $colegio_eval;
$evaluacion->tipo_innovacion = $innovacion;
$evaluacion->linea_tematica = $lin_tem;
//FUNDAMENTACIÓN
$evaluacion->fundamentos_conocimiento = $fundamentos_conocimiento;
$evaluacion->puntaje_fundamentos_conocimiento = $puntaje_fundamentos_conocimiento;
$evaluacion->propuesta_metodologica = $propuesta_metodologica;
$evaluacion->puntaje_propuesta_metodologica = $puntaje_propuesta_metodologica;
$evaluacion->existe_coherencia = $existe_coherencia;
$evaluacion->puntaje_existe_coherencia = $puntaje_existe_coherencia;
$evaluacion->subtotal_fundamentacion = $subtotal_fundamentacion;
//TIPOS Y PROCESO
$evaluacion->forma_original = $forma_original;
$evaluacion->puntaje_forma_original = $puntaje_forma_original;
$evaluacion->argumenta_transformacion = $argumenta_transformacion;
$evaluacion->puntaje_argumenta_transformacion = $puntaje_argumenta_transformacion;
$evaluacion->proceso_investigativo = $proceso_investigativo;
$evaluacion->puntaje_proceso_investigativo = $puntaje_proceso_investigativo;
$evaluacion->subtotal_tipos = $subtotal_tipos;
//PERTINENCIA E IMPACTO
$evaluacion->grado_elaboracion = $grado_elaboracion;
$evaluacion->puntaje_grado_elaboracion = $puntaje_grado_elaboracion;
$evaluacion->resultados_investigacion = $resultados_investigacion;
$evaluacion->puntaje_resultados_investigacion = $puntaje_resultados_investigacion;
$evaluacion->evolucion_desarrollo = $evolucion_desarrollo;
$evaluacion->puntaje_evolucion_desarrollo = $puntaje_evolucion_desarrollo;
$evaluacion->subtotal_impacto = $subtotal_impacto;
//APROPIACIÓN
$evaluacion->dinamica_vivida = $dinamica_vivida;
$evaluacion->puntaje_dinamica_vivida = $puntaje_dinamica_vivida;
$evaluacion->social_logrado = $social_logrado;
$evaluacion->puntaje_social_logrado = $puntaje_social_logrado;
$evaluacion->importancia_social = $importancia_social;
$evaluacion->puntaje_importancia_social = $puntaje_importancia_social;
$evaluacion->subtotal_apropiacion = $subtotal_apropiacion;
//ANEXOS
$evaluacion->puntaje_total = $puntaje_total;
$evaluacion->observaciones = $obs;

$result = $evaluacion->save();

if ($result) {

    $result_eval = add_entity_relationship($guid_investigacion, 'evaluada_5_en_' . $guid_feria . '_con', $evaluacion->guid);
    $eval4 = elgg_get_relationship(get_entity($guid_investigacion), 'evaluada_4_en_' . $guid_feria . '_con');
    $eval2_1 = elgg_get_relationship(get_entity($guid_investigacion), 'evaluada_2.1_en_' . $guid_feria . '_con');
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
                elgg_enviar_correo($user->email, 'Seleccionado como evaluador en sitio de investigación', 'Usted ha sido seleccionado como evaluador en sitio de la investigación "' . $investigacion->name .
                        '" acreditada como participante y evaluada inicialmente en la feria "' . $feriaa->name . '".');
            }
        }
    }

    system_messages(elgg_echo('evaluador:formtaos:evaluar5:register:ok'), 'success');

    //forward(elgg_get_site_url()."evaluadores/listar_investigaciones_feria/$guid_feria#inicial");
} else {
    register_error(elgg_echo('evaluador:formtaos:evaluar5:register:fail'), 'error');
}

forward(REFERER);
