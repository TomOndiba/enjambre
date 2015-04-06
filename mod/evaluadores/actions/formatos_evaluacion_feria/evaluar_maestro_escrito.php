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

$obj_feria = new ElggFeria($guid_feria);
$tipo_feria = $obj_feria->tipo_feria;

if ($tipo_feria == 'Municipal') {
    $rel = "mun";
} else if ($tipo_feria == 'Departamental') {
    $rel = "dptal";
}
$evaluacion = get_entity($guid_evaluacion_hecha);
if (empty($guid_evaluacion_hecha)) {
    $evaluacion = new ElggEvalMaestroEscrito();
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

    $result_eval = add_entity_relationship($guid_investigacion, 'evaluada_2.1_en_' . $guid_feria . '_con', $evaluacion->guid);
    $eval4 = elgg_get_relationship(get_entity($guid_investigacion), 'evaluada_4_en_' . $guid_feria . '_con');

    //Valida la categoria para realizar la operación creando las relaciones y eliminando las cosas
    if ($categoria == "Innovación") {
        $eval5 = elgg_get_relationship(get_entity($guid_investigacion), 'evaluada_5_en_' . $guid_feria . '_con');
        if (sizeof($eval5) > 0 && sizeof($eval4) > 0) {
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
    } else {

        if (sizeof($eval4) > 0) {

            add_entity_relationship($guid_investigacion, 'evaluada_inicialmente_en', $guid_feria);
            remove_entity_relationship($guid_investigacion, 'acreditada_en', $guid_feria);
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
                    elgg_enviar_correo($user->email, 'Seleccionado como evaluador en sitio de investigación',  'Usted ha sido seleccionado como evaluador en sitio de la investigación "' . $investigacion->name .
                            '" acreditada como participante y evaluada inicialmente en la feria "' . $feriaa->name . '".');
                }
            }
        }
    }

    system_messages(elgg_echo('evaluador:formtaos:evaluar5:register:ok'), 'success');

    //forward(elgg_get_site_url() . "evaluadores/listar_investigaciones_feria/$guid_feria#inicial");
} else {
    register_error(elgg_echo('inscripcion_evaluador_feria:acptado:fail'), 'error');
}

forward(REFERER);
