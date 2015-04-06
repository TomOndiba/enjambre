<?php

/**
 * Action que registra un nivel de feria
 * @author DIEGOX_CORTEX
 */
$nombre = get_input('nombre');

if (!elgg_existe_nivel_feria($nombre)) {
    $nviel = new ElggNivelFeria();
    $nviel->title = $nombre;
    $guid = $nviel->save();
    if (!$guid) {
        register_error(elgg_echo("error:existe:nivel:create"), 'error');
        forward(REFERER);
    } else {
        system_message(elgg_echo("okay:nivel:create"), 'success');
        forward('/nivel/listar');
    }
} else {
    register_error(elgg_echo("error:existela:nivel:create"), 'error');
    forward(REFERER);
}