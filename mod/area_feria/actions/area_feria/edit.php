<?php

/**
 * Action que actualiza la información de un Area de Feria
 * @author DIEGOX_CORTEX
 */
$name = get_input('nombre');
$existe_area = elgg_existe_area_feria($name);

if ($existe_area) {
    system_messages(elgg_echo('error:existe:area:create'), 'error');
} else {

    $id = get_input('id');
    $area_feria = new ElggAreaFeria($id);
    $area_feria->title = $name;
    $guid = $area_feria->save();


    if ($guid)
        system_messages(elgg_echo('edicion_area:correcto'), 'success');
    else
        register_error(elgg_echo('edicion_area:invalido'), 'error');
}

forward("/area/listar");
