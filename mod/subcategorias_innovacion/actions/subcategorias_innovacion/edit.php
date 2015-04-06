<?php

/**
 * Action que actualiza la información de una subcategoría de innovación
 */
$name = get_input('nombre');
$existe_sub = elgg_existe_subcategoria($name);

if ($existe_sub) {
    system_messages(elgg_echo('error:existela:subcategoria:create'), 'error');
} else {

    $id = get_input('id');
    $subcategoria = new ElggSubcategoria($id);
    $subcategoria->title = $name;
    $guid = $subcategoria->save();


    if ($guid){
        system_messages(elgg_echo('edicion_subcategoria:correcto'), 'success');
    }else{
        register_error(elgg_echo('edicion_subcategoria:invalido'), 'error');
    }
}

forward("/subcategorias/listar");
