<?php

/**
 * Libreria donde se crean los métodos usados en el plugin subcategorias_innovacion
 */


/**
 * Funcion que devueve el listado de objetos de las subcategorías de innovación existentes en el sistema
 * @return type -> array
 */
function listar_subcategorias_innovacion() {
    $options = (array(
        'type' => 'object',
        'subtype' => 'subcategoria_innovacion',
    ));
    $subcategorias = elgg_get_entities_from_metadata($options);
    return $subcategorias;
}

/**
 * Función que verifica si el nombre de la subcategoria ya existe en el sistema
 * @param type -> String $name -> nombre de la subcategoria que se desea comparar
 * @return type -> boolean 
 */
function elgg_existe_subcategoria($name) {

    $db_prefix = get_config('dbprefix');
    $options = array(
        'type' => 'object',
        'subtype' => 'subcategoria_innovacion',
        'joins' => array("JOIN {$db_prefix}objects_entity us on us.guid = e.guid"),
        'wheres' => array("us.title= '$name'"),
    );

    $subcategoria = elgg_get_entities_from_metadata($options);

    if ($subcategoria) {
        return true;
    }

    return false;
}
