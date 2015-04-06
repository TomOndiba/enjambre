<?php

/**
 * Action que permite registrar una evaluación a un maestro de formato 2.1
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
$colaborador = get_input('colaborador');
$name_grupo = get_input('name_grupo');
$name_inv = get_input('name_inv');
$name_eval = get_input('name_eval');
$colegio_eval = get_input('eval_colegio');
$profesion_eval = get_input('profesion');
$guid_evaluacion_hecha = get_input('guid_evaluacion_hecho');
$categoria = get_input('categoria');

$visible_reflexiones = get_input('visible_reflexiones');
$puntaje_visible_reflexiones = get_input('puntaje_visible_reflexiones');
$practica_pedagogica = get_input('practica_pedagogica');
$puntaje_practica_pedagogica = get_input('puntaje_practica_pedagogica');
$aprendizajes_propios = get_input('aprendizajes_propios');
$puntaje_aprendizajes_propios = get_input('puntaje_aprendizajes_propios');
$reflexion_presentada = get_input('reflexion_presentada');
$puntaje_reflexion_presentada = get_input('puntaje_reflexion_presentada');
$puntaje_total = get_input('puntaje_total');
$obs = get_input('obs');

$evaluacion = get_entity($guid_evaluacion_hecha);
if (empty($guid_evaluacion_hecha)) {
    $evaluacion = new ElggEvalMaestroOral();
}

$evaluacion->municipio_dpto = $dpto;
$evaluacion->institucion = $nom_colegio;
$evaluacion->name_maestro = $colaborador;
$evaluacion->name_grupo = $name_grupo;
$evaluacion->name_ponencia = $name_inv;
$evaluacion->name_eval = $name_eval;
$evaluacion->profesion_eval = $profesion_eval;
$evaluacion->institucion_eval = $colegio_eval;
$evaluacion->visible_reflexiones = $visible_reflexiones;
$evaluacion->puntaje_visible_reflexiones = $puntaje_visible_reflexiones;
$evaluacion->practica_pedagogica = $practica_pedagogica;
$evaluacion->puntaje_practica_pedagogica = $puntaje_practica_pedagogica;
$evaluacion->aprendizajes_propios = $aprendizajes_propios;
$evaluacion->puntaje_aprendizajes_propios = $puntaje_aprendizajes_propios;
$evaluacion->reflexion_presentada = $reflexion_presentada;
$evaluacion->puntaje_reflexion_presentada = $puntaje_reflexion_presentada;
$evaluacion->puntaje_total = $puntaje_total;
$evaluacion->obs = $obs;



$result = $evaluacion->save();

if ($result) {

    $result_eval = add_entity_relationship($guid_investigacion, 'evaluada_2.2_en_' . $guid_feria . '_con', $evaluacion->guid);
    
    $eval3 = elgg_get_relationship(get_entity($guid_investigacion), 'evaluada_3_en_' . $guid_feria . '_con');

    if (sizeof($eval3) > 0) {
        add_entity_relationship($guid_investigacion, 'evaluada_en_sitio_en', $guid_feria);            
        remove_entity_relationship($guid_investigacion, 'evaluada_inicialmente_en', $guid_feria);
    }

    system_messages(elgg_echo('evaluador:formtaos:evaluar5:register:ok'), 'success');

//    forward(elgg_get_site_url() . "evaluadores/listar_investigaciones_feria/$guid_feria#en_sitio");
} else {
    register_error(elgg_echo('inscripcion_evaluador_feria:acptado:fail'), 'error');
    
}

forward(REFERER);
