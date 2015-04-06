<?php

/**
 * Action que registra una subcategoría de innovación
 */
$nombre = get_input('nombre');

if (!elgg_existe_subcategoria($nombre)) {
    $subcategoria = new ElggSubcategoria();
    $subcategoria->title = $nombre;
    $guid = $subcategoria->save();
    if (!$guid) {
        register_error(elgg_echo("error:existe:subcategoria:create"), 'error');
        forward(REFERER);
    } else {
        system_message(elgg_echo("okay:subcategoria:create"), 'success');
        forward('/subcategorias/listar');
    }
} else {
    register_error(elgg_echo("error:existela:subcategoria:create"), 'error');
    forward(REFERER);
}