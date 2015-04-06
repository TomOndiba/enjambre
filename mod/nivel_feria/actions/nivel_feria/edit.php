<?php

/**
 * Action que actualiza la información de un Nivel de Feria
 * @author DIEGOX_CORTEX
 */
$name = get_input('nombre');
$existe_area = elgg_existe_nivel_feria($name);

if ($existe_area) {
    system_messages(elgg_echo('error:existela:nivel:create'), 'error');
} else {

    $id = get_input('id');
    $area_feria = new ElggAreaFeria($id);
    $area_feria->title = $name;
    $guid = $area_feria->save();


    if ($guid) {
        system_messages(elgg_echo('edicion_nivel:correcto'), 'success');
    } else {
        register_error(elgg_echo('edicion_nivel:invalido'), 'error');
    }
}

forward("/nivel/listar");
