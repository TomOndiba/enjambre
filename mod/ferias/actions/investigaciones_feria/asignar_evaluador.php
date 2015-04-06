<?php

$feria = get_input('guid_feria');
$investigacion = get_input('investigacion');
$evaluador = get_input('evaluador');
$tipo_eval = get_input('tipo_eval');
$inv = new ElggInvestigacion($investigacion);
$feriaa = new ElggFeria($feria);
if ($evaluador > 0 && $feria > 0 && $investigacion > 0) {
    if ($tipo_eval == "inicial") {
        if ($feriaa->tipo_feria == 'Municipal') {
            $relacion = "es_evaluador_inicial_mun_de";
        } else {
            $relacion = "es_evaluador_inicial_dptal_de";
        }
        $pag = "acreditadas";
    } else if ($tipo_eval == "en sitio") {
        if ($feriaa->tipo_feria == 'Municipal') {
            $relacion = "es_evaluador_en_sitio_mun_de";
        } else {
            $relacion = "es_evaluador_en_sitio_dptal_de";
        }
        $pag = "evaluadas_ini";
    }


    $evaluadores_aceptados = elgg_get_relationship_inversa($inv, $relacion);
    if (sizeof($evaluadores_aceptados) > 0) {
        foreach ($evaluadores_aceptados as $eva) {
            $create_relation = remove_entity_relationship($eva->guid, $relacion, $investigacion);
            if ($create_relation) {
                if (!empty($eva->email)) {
                    messages_send('Ya no es evaluador ' . $tipo_eval . ' de investigación', 'Usted ya no se encuentra asignado como '
                            . 'evaluador ' . $tipo_eval . ' de la investigación "' . $inv->name . '" acreditada como participante '
                            . 'en la feria "' . $feriaa->name . '".', $eva->guid, 0, false);
                    elgg_enviar_correo($eva->email, "Ya no es evaluador $tipo_eval de investigación en Feria - $feriaa->name", 'Usted ya no se encuentra asignado como evaluador ' . $tipo_eval . ' de la investigación "' . $inv->name .
                            '" acreditada como participante en la feria "' . $feriaa->name . '".');
                }
            }
        }
    }

    $create_relation = add_entity_relationship($evaluador, $relacion, $investigacion);
    if ($create_relation) {
        $evalu = get_entity($evaluador);
        if (!empty($evalu->email)) {
            messages_send('Seleccionado como evaluador ' . $tipo_eval . ' de investigación', 'Usted ha sido seleccionado como '
                    . 'evaluador ' . $tipo_eval . ' de la investigación "' . $inv->name . '" acreditada como participante '
                    . 'en la feria "' . $feriaa->name . '".', $evalu->guid, 0, false);
            elgg_enviar_correo($evalu->email, "Seleccionado como evaluador $tipo_eval de Investigación - $inv->name en Feria - $feriaa->name", 'Usted ha sido seleccionado como evaluador ' . $tipo_eval . ' de la investigación "' . $inv->name .
                    '" acreditada como participante en la feria "' . $feriaa->name . '".');
        }
        system_message(elgg_echo('feria:evaluador:asignado:ok'), 'success');
    } else {
        register_error(elgg_echo('feria:evaluador:asignado:fail'));
    }
} else {
    register_error(elgg_echo('feria:evaluador:asignado:clean'));
}

forward("ferias/investigaciones/{$feria}#{$pag}");



