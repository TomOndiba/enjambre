<?php

$convocatoria = get_input('guid_conv');
$investigacion = get_input('investigacion');
$asesor = get_input('asesor');
$asesorr=  get_entity($asesor);

if ($asesor > 0 && $convocatoria > 0 && $investigacion > 0) {

    $asesores_aceptados = elgg_get_relationship_inversa(get_entity($investigacion), 'es_asesor_de');
    if (sizeof($asesores_aceptados) > 0) {
        foreach ($asesores_aceptados as $eva) {
            remove_entity_relationship($eva->guid, 'es_asesor_de', $investigacion);
        }
    }

    $create_relation = add_entity_relationship($asesor, 'es_asesor_de', $investigacion);
    if ($create_relation) {

        $options = array(
            'type' => 'object',
            'relationship' => 'tiene_la_bitacora',
            'relationship_guid' => $investigacion,
        );

        $bitacoras = elgg_get_entities_from_relationship($options);

        foreach ($bitacoras as $pre) {
            if ($pre->description == '1') {
                $user = elgg_get_logged_in_user_entity();
                $result=create_metadata($pre->guid, 'asesor_linea', $asesorr->name." ".$asesorr->apellidos, 'text', $user->guid, ACCESS_PUBLIC);
            }
        }
        system_message(elgg_echo('convocatoria:asesor:asignado:ok'), 'success');
        elgg_enviar_correo($asesorr->email, "Eres Asesor de investigación - $inv->name", "Felicidades ha sido asignado como asesor de la investigación " . $inv->name .
                            " participante en la convocatoria " . get_entity($convocatoria)->name .".");                    
            
    } else {
        register_error(elgg_echo('convocatoria:asesor:asignado:fail'));
    }
} else {
    register_error(elgg_echo('convocatoria:asesor:asignado:clean'));
}

forward("convocatorias/investigaciones/{$convocatoria}#seleccionadas");



