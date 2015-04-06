<?php

/**
 * Libreria donde se crean los métodos usados en el plugin nivel_feria
 * @author DIEGOX_CORTEX
 */


/**
 * Funcion que devueve el listado de objetos de los niveles de feria existentes en el sistema
 * @return type -> array
 */
function listar_niveles_feria() {
    $options = (array(
        'type' => 'object',
        'subtype' => 'nivel_feria',
    ));
    $lineas = elgg_get_entities_from_metadata($options);
    return $lineas;
}

/**
 * Función que verifica si el nombre del nivel de feria ya existe en el sistema
 * @param type -> String $name -> nombre del área de feria que se desea comparar
 * @return type -> boolean 
 */
function elgg_existe_nivel_feria($name) {

    $db_prefix = get_config('dbprefix');
    $options = array(
        'type' => 'object',
        'subtype' => 'nivel_feria',
        'joins' => array("JOIN {$db_prefix}objects_entity us on us.guid = e.guid"),
        'wheres' => array("us.title= '$name'"),
    );

    $grupo_investigacion = elgg_get_entities_from_metadata($options);

    if ($grupo_investigacion) {
        return true;
    }

    return false;
}
