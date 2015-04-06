<?php

$convocatoria = get_input('guid_conv');
$investigacion = get_input('investigacion');
$evaluador = get_input('evaluador');

if ($evaluador > 0 && $convocatoria > 0 && $investigacion > 0) {

    $evaluadores_aceptados = elgg_get_relationship_inversa(get_entity($investigacion), 'es_evaluador_de');
    if (sizeof($evaluadores_aceptados) > 0) {
        foreach ($evaluadores_aceptados as $eva) {
            $create_relation = remove_entity_relationship($eva->guid, 'es_evaluador_de', $investigacion);
            if ($create_relation) {
                messages_send('Ya no es evaluador de investigación', 'Usted ya no se encuentra asignado como '
                        . 'evaluador de la investigación "' . get_entity($investigacion)->name . '" acreditada como participante '
                        . 'en la convocatoria "' . get_entity($convocatoria)->name . '".', $eva->guid, 0, false);
                if (!empty($eva->email)) {
                    elgg_enviar_correo($eva->email, "Ya no es evaluador - $inv->name", 'Ya no es evaluador ' . $tipo_eval . ' de investigación', 'Usted ya no se encuentra asignado como evaluador ' . $tipo_eval . ' de la investigación "' . $inv->name .
                            '" acreditada como participante en la convocatoria "' . get_entity($convocatoria)->name . '".');                    
                }
            }
        }
    }

    $create_relation = add_entity_relationship($evaluador, 'es_evaluador_de', $investigacion);
    if ($create_relation) {
        $site = elgg_get_site_url() . 'evaluadores/listar_convocatorias_evaluador';
        $link_evaluador = "<a href='$site'>Aqui</a>";
        $evalu = get_entity($evaluador);
        messages_send('Seleccionado como evaluador de investigacino en la convocatoria ' . get_entity($convocatoria)->name, 'Seleccionado como evaluador de la investigación ' . get_entity($investigacion)->name . ' en la convocatoria ' . get_entity($convocatoria)->name . ' <br>Puedes ir a tu perfil como evaluador en la comunidad para verificarlo: ' . $link_evaluador, $evalu->guid, 0, false);
        if (!empty($evalu->email)) {
            elgg_enviar_correo($eva->email, "Eres Evaluador de investigación - $inv->name", 'Felicidades ha sido asignado como evaluador ' . $tipo_eval . " de la investigación " . $inv->name .
                            " acreditada como participante en la convocatoria " . get_entity($convocatoria)->name .".");                    
            
        }
        system_message(elgg_echo('convocatoria:evaluador:asignado:ok'), 'success');
    } else {
        register_error(elgg_echo('convocatoria:evaluador:asignado:fail'));
    }
} else {
    register_error(elgg_echo('convocatoria:evaluador:asignado:clean'));
}

forward("convocatorias/investigaciones/{$convocatoria}#inscritas");



