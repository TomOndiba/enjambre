<?php

/**
 * Action que registra un área de feria
 * @author DIEGOX_CORTEX
 */
$nombre = get_input('nombre');

if (!elgg_existe_area_feria($nombre)) {
    $feria = new ElggAreaFeria();
    $feria->title = $nombre;
    $guid = $feria->save();
    if (!$guid) {
        register_error(elgg_echo("error:existe:area:create"), 'error');
        forward(REFERER);
    } else {
        system_message(elgg_echo("okay:area:create"), 'success');
        forward('/area/listar');
    }
} else {
    register_error(elgg_echo("error:existela:area:create"), 'error');
    forward(REFERER);
}