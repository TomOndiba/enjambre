<?php

/**
 * Verifica si existe una Entidad con un nombre
 * @param String $nombre nombre de la Entidad
 * @param String $subtype subtipo de la Entidad
 * @return boolean 
 */
function elgg_existe_entity($nombre, $subtype) {
    $db_prefix = get_config('dbprefix');
    $opt = array(
        'type' => 'group',
        'subtype' => $subtype,
        'joins' => array("JOIN {$db_prefix}groups_entity ge on ge.guid = e.guid"),
        'wheres' => array("ge.name = '$nombre'"),
    );

    $convoc = elgg_get_entities($opt);
    if ($convoc) {
        return true;
    }
    return false;
}




/**
 * Función que devuelve las líneas temáticas almacenadas en base de datos
 * @return type->NULL|array
 */
function elgg_get_lineas_tematicas() {
    $options = array(
        'type' => 'group',
        'subtype' => 'lineaTematica',
    );

    $lineas = elgg_get_entities_from_metadata($options);
    return $lineas;
}

/**
 * Función que devuelve las líneas temáticas almacenadas en base de datos
 * @return type->NULL|array
 */
function elgg_get_lineas_tematicas_tipo($tipo) {
    $options = array(
        'type' => 'group',
        'subtype' => 'lineaTematica',
        'metadata_names' => 'tipo',
        'metadata_values' => $tipo
    );

    $lineas = elgg_get_entities_from_metadata($options);

    return $lineas;
}

/**
 * Función que devuelve todas las convocatorias almacenadas en base de datos
 * @return type->NULL|array
 */
function elgg_get_convocatorias() {
    $options = array(
        'type' => 'group',
        'subtype' => 'convocatoria',
    );

    $convocatorias = elgg_get_entities($options);
    return $convocatorias;
}

/**
 * Función que busca las entidades que se encuentran relacionadas en cierta manera con la entidad dada
 * @param type $entity - entidad dueña de la relación a buscar
 * @param type $name_relacion - nombre de la relación a buscar
 * @return type->NULL|array
 */
function elgg_get_relationship($entity, $name_relacion) {
    $entities = $entity->getEntitiesFromRelationship($name_relacion);
    return $entities;
}

/**
 * Función que imprime en pantalla un listado paginable de las convocatorias de acuerdo a los parámetros recibidos
 * @param type $limit - cantidad de elementos que se desea obtener
 * @param type $offset - número a partir del cual se desea que se listen las convocatorias
 */
function elgg_get_list_convocatorias($limit, $offset) {
    $query = array('type' => 'group', 'subtype' => 'convocatoria');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'convocatorias/lista/lista_convocatoria');
    $content = elgg_list_paginable_entities($options);
    echo $content;
}
function elgg_get_list_convocatorias_inactivas($limit, $offset) {
    $query = array('type' => 'group', 'subtype' => 'convocatoria');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'convocatorias/lista_inactivas/lista_convocatoria');
    $content = elgg_list_paginable_entities($options, false);
    echo $content;
}

function elgg_get_list_grupos_inactivos($limit, $offset,$subtype) {
     
    $query = array('type' => 'group', 'subtype' => $subtype);
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' =>'administracion/lista_grupos_inactivos');
    $content = elgg_list_paginable_entities($options, false);
    echo $content;
}




/**
 * Función que retorna las convocatorias que se encuentran abiertas, de acuerdo a la validación de su fecha de apertura 
 * y fecha de cierre con respecto a la fecha actual
 * @return type->NULL|array
 */
function elgg_get_convocatorias_abiertas() {
    $fecha = date("Y-m-d");
    $options = array(
        'type' => 'group',
        'subtype' => 'convocatoria',
        'wheres' => array(
            'name' => "(mts.string='fecha_apertura' and mts.id=mt.name_id and mt.value_id=mts2.id AND mt.entity_guid=s.guid AND mts2.string<='$fecha')
                        AND (mts3.string='fecha_cierre' and mts3.id=mt2.name_id and mt2.value_id=mts4.id AND mt2.entity_guid=s.guid AND mts4.string>='$fecha')"
            . " AND e.guid=s.guid",
        ),
        'joins' => array(
            'name' => ', elgg_groups_entity s, elgg_metadata mt, elgg_metadata mt2, elgg_metastrings mts, elgg_metastrings mts2, elgg_metastrings mts3, elgg_metastrings mts4'
        ),
    );

    $convocatorias = elgg_get_entities($options);
    return $convocatorias;
}

/**
 * Función que imprime en pantalla las investigaciones que se se encuentran inscritas a una convocatoria dada, con una 
 * línea temática dada
 * @param type $limit - cantidad de elementos que se desea obtener
 * @param type $offset - número a partir del cual se desea que se listen las investigaciones
 * @param type $id_conv - id de la convocatoria
 * @param type $id_linea - id de la línea temática
 * @param String $tipo_relacion -identifica si se listan las innvestigaciones inscritas o las preinscritas
 */
function elgg_get_investigaciones_linea_convocatoria($limit, $offset, $id_conv, $id_linea, $tipo_relacion) {

    if ($tipo_relacion == "preinscritas") {
        $relation_linea = "preinscrita_a_" . $id_conv . "_con_linea_tematica";
    } else if ($tipo_relacion == "inscritas") {
        $relation_linea = "inscrita_a_" . $id_conv . "_con_linea_tematica";
    } else if ($tipo_relacion == "preseleccionadas") {
        $relation_linea = "evaluada_en_" . $id_conv . "_con_linea_tematica";
    } else if ($tipo_relacion == "seleccionadas") {
        $relation_linea = "seleccionada_en_" . $id_conv . "_con_linea_tematica";
    }

    
    $query = array('type' => 'group', 'subtype' => 'investigacion');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => "investigaciones/{$tipo_relacion}/lista_{$tipo_relacion}", 'guid' => $id_linea, 'id_conv' => $id_conv, 'tipo' => $tipo_relacion, 'relacion' => $relation_linea, 'inverse' => 'true');
    $content = elgg_list_paginable_entities_relationships($options);
    return $content;
}

/**
 * Función que imprime en pantalla las investigaciones seleccionadas en una convocatoria dada
 * @param type $limit - cantidad de elementos que se desea obtener
 * @param type $offset - número a partir del cual se desea que se listen las investigaciones
 * @param type $id_conv - id de la convocatoria
 * @param type $tipo_relacion - nombre de la relación
 */
function elgg_get_investigaciones_seleccionadas_linea_convocatoria($entity) {

    $lineas = $entity->getEntitiesFromRelationship("tiene_la_línea_temática");
    $entities = array();

    foreach ($lineas as $lin) {
        $lineas2 = $lin->getEntitiesFromRelationship("seleccionada_en_{$entity->guid}_con_linea_tematica", true);
        $entities = array_merge($entities, $lineas2);
    }
    return $entities;
}

/**
 * Función que devuelve los evaluadores preinscritos a una convocatoria.
 * @param type $guid_convocatoria -> identificador de la convocatoria.
 */
function elgg_get_evaluadores_preinscritos($guid_convocatoria) {


    $options = array('relationship' => 'preinscrito_evaluador_convocatoria',
        'relationship_guid' => $guid_convocatoria,
        'inverse_relationship' => true
    );
    $evaluadores = elgg_get_entities_from_relationship($options);
    $vars = array('entities' => $evaluadores, 'guid' => $guid_convocatoria);
    echo elgg_view("evaluadores_conv/lista/lista_evaluadores_conv", $vars);
}

/**
 * Función que devuelve los evaluadores aceptados en una convocatoria.
 * @param type $guid_convocatoria -> identificador de la convocatoria.
 */
function elgg_get_evaluadores_convocatoria($guid_convocatoria) {

    $options = array('relationship' => 'es_evaluador_convocatoria',
        'relationship_guid' => $guid_convocatoria,
        'inverse_relationship' => true
    );
    $evaluadores = elgg_get_entities_from_relationship($options);
    $vars = array('entities' => $evaluadores, 'guid' => $guid_convocatoria);
    echo elgg_view("evaluadores_conv/lista_aceptados/lista_evaluadores", $vars);
}

/**
 * Función que devuelve los evaladores aceptados de la convocatoria
 * @param type $conv -> entidad convocatoria
 * @return type -> Array
 */
function elgg_get_evaluadores_aceptados($conv) {
    return elgg_get_relationship_inversa($conv, 'es_evaluador_convocatoria');
}

function elgg_exite_asesor_asignado($guid_convocatoria) {
    $options = array('relationship' => 'es_asesor_de_investigacion',
        'relationship_guid' => $guid_convocatoria,
        'inverse_relationship' => true);
    return elgg_get_entities_from_relationship($options)[0];
}

function elgg_get_investigaciones_elegibles($guid_convocatoria) {
    $options = array(
        'type' => 'group',
        'subtype' => 'investigacion',
        'metadata_names' => 'elegible',
        'metadata_values' => 'true'
    );

    $entities = elgg_get_entities_from_metadata($options);
    $elegibles= array();
    
    foreach($entities as $ent){
        if(!check_entity_relationship($ent->guid, "evaluada_en_convocatoria", $guid_convocatoria)){
            array_push($elegibles, $ent);
        }
    }

    return $elegibles;
}
