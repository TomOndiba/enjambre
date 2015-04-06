<?php

/**
 * Libreria donde se crean los métodos usados en el plugin linea_tematica
 * @author DIEGOX_CORTEX
 */


/**
 * Funcion que devueve el listado de objetos de las lineas tematicas existentes en el sistema
 * @return type -> array
 */
function listar_lineas() {
    $options = (array(
        'type' => 'group',
        'subtype' => 'lineaTematica',
    ));
    $lineas = elgg_get_entities_from_metadata($options);
    return $lineas;
}

/**
 * Función que verifica si el nombre de la línea temáctica ya existe en el sistema
 * @param type -> String $name -> nombre de la línea tematica que se desea comparar
 * @return type -> boolean 
 */
function elgg_existe_linea($name) {

    $db_prefix = get_config('dbprefix');
    $options = array(
        'type' => 'group',
        'subtype' => 'lineaTematica',
        'joins' => array("JOIN {$db_prefix}groups_entity us on us.guid = e.guid"),
        'wheres' => array("us.name= '$name'"),
    );

    $grupo_investigacion = elgg_get_entities_from_metadata($options);

    if ($grupo_investigacion) {
        return true;
    }

    return false;
}


/**
 * Función que imprime en pantalla un listado paginable de las lineas tematicas de acuerdo a los parámetros recibidos
 * @param type $limit - cantidad de elementos que se desea obtener
 * @param type $offset - número a partir del cual se desea que se listen las lineas tematicas
 */
function elgg_get_list_lineas($limit, $offset) {
$query = array('type' => 'group', 'subtype' => 'red_tematica');
$options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'linea_tematica/lista/lista_lineas');
$content = elgg_list_paginable_entities($options);
echo $content;
}

/**
 * Función que imprime en pantalla un listado paginable de las lineas tematicas deshabilitadas de acuerdo a los parámetros recibidos
 * @param type $limit - cantidad de elementos que se desea obtener
 * @param type $offset - número a partir del cual se desea que se listen las lineas tematicas
 */
function elgg_get_list_lineas_deshabilitadas($limit, $offset) {
    $query = array('type' => 'group', 'subtype' => 'lineaTematica');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'linea_tematica/lista_deshabilitada/lista_lineas_deshabilitadas');
    $content = elgg_list_paginable_entities($options, false);
    echo $content;
}