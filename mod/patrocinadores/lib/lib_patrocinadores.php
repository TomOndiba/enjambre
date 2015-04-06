<?php

/**
 * Libreria donde se crean los métodos usados en el plugin patrocinador
 * @author DIEGOX_CORTEX
 */


/**
 * Funcion que devueve el listado de objetos de los patrocinadores existentes en el sistema
 * @return type -> array
 */
function listar_patrocinadores() {
    $options = (array(
        'type' => 'object',
        'subtype' => 'patrocinador',
    ));
    $lineas = elgg_get_entities_from_metadata($options);
    return $lineas;
}

/**
 * Función que verifica si el nombre del patrocinador ya existe en el sistema
 * @param type -> String $name -> nombre del patrocinador que se desea comparar
 * @return type -> boolean 
 */
function elgg_existe_patrocinador($name) {

    $db_prefix = get_config('dbprefix');
    $options = array(
        'type' => 'object',
        'subtype' => 'patrocinador',
        'joins' => array("JOIN {$db_prefix}objects_entity us on us.guid = e.guid"),
        'wheres' => array("us.title= '$name'"),
    );

    $grupo_investigacion = elgg_get_entities_from_metadata($options);

    if ($grupo_investigacion) {
        return true;
    }

    return false;
}
