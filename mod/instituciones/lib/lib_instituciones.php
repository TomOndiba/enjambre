<?php

/**
 * Verifica si existe un grupo de investigación con un nombre
 * @param String $nombre nombre del grupo de investigación
 * @return boolean 
 */
function elgg_existe_institucion($nombre) {
    $db_prefix = get_config('dbprefix');
    $opt = array(
        'type' => 'group',
        'subtype' => 'institucion',
        'joins' => array("JOIN {$db_prefix}groups_entity ge on ge.guid = e.guid"),
        'wheres' => array("ge.name = '$nombre'"),
    );

    $institucion = elgg_get_entities($opt);
    if ($institucion) {
        return true;
    }
    return false;
}

/**
 * Lista las instituciones
 * @return array Lista de entidades de tipo instituciones
 */
function elgg_get_instituciones() {
    $options = array(
        'type' => 'group',
        'subtype' => 'institucion'
    );

    $retorno = array();
    $instituciones = elgg_get_entities($options);
    foreach ($instituciones as $institucion) {
        array_push($retorno, $institucion->name);
    }
    return $retorno;
}

/**
 * Busca las intituciones que pertenecen a un municipio de un departamento
 * @param String $municipio nombre del municipio 
 * @param String $departamento nombre del departamento
 * @return array Lista de entitades de tipo grupo, subtipo institucion
 */
function elgg_buscar_instituciones_Municipio($municipio, $departamento) {
    $municipio = mb_strtoupper($municipio,'UTF-8');
    
    $options = array(
        'type' => 'group',
        'subtype' => 'institucion',
        'metadata_names' => 'municipio',
        'metadata_values' => $municipio,
        "limit"=>0
    );


    $instituciones = elgg_get_entities_from_metadata($options);


    $listado = array();
    foreach ($instituciones as $institucion) {

        $inst = array('id' => $institucion->guid, 'nombre' => $institucion->name);
        array_push($listado, $inst);
    }
    return $listado;
}

/**
 * Busca las intituciones que pertenecen a un municipio de un departamento
 * @param String $municipio nombre del municipio 
 * @param String $departamento nombre del departamento
 * @return array Lsita de entitades de tipo grupo, subtipo institucion
 */
function elgg_get_instituciones_municipio($municipio, $departamento) {
    $options = array(
        'type' => 'group',
        'subtype' => 'institucion',
        'metadata_names' => 'municipio',
        'metadata_values' => $municipio
    );


    $instituciones = elgg_get_entities_from_metadata($options);

    return $instituciones;
}

/**
 * Permite obtener una lista de instituciones
 * @param int $limit cantidad que se quiere consultar
 * @param int $offset numero apartir del cual se muestran los resultados
 */
function elgg_get_list_instituciones($limit, $offset) {
    $query = array('type' => 'group', 'subtype' => 'institucion');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'instituciones/lista/lista_instituciones');
    $content = elgg_list_paginable_entities($options);
    echo $content;
}

function elgg_get_list_instituciones_especiales($limit, $offset) {
    $query = array('type' => 'group', 'subtype' => 'institucion');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'instituciones/lista/lista_instituciones');
    $content = elgg_list_paginable_entities_instuciones_priorizadas($options);
    echo $content;
}

/**
 * Permite obtener una lista de instituciones filtrada por un nombre
 * @param int $limit cantidad de elementos que se desea obtener
 * @param int $offset numero apartir del cual se desea que se liste las instituciones
 * @param String $busqueda. Consulta que se desea que coincida con el nombre de la institución
 */
function elgg_get_list_instituciones_nombre($limit, $offset, $busqueda) {
    $db_prefix = get_config('dbprefix');
    $query = array('type' => 'group',
        'subtype' => 'institucion',
        'joins' => array("JOIN {$db_prefix}groups_entity ge on ge.guid = e.guid"),
        'wheres' => array("ge.name  LIKE '%$busqueda%'"));

    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'instituciones/lista/lista_instituciones');
    $content = elgg_list_paginable_entities($options);
    echo $content;
}

function elgg_get_is_miembro_institucion($guid, $user) {
    $instit = get_entity($guid);
    if (check_entity_relationship($user, "estudia_en", $guid) || check_entity_relationship($user, "trabaja_en", $guid) || $instit->owner_guid == $user) {
        return true;
    }
    return false;
}

function elgg_get_estudiantes_institucion($guid_institucion) {
    $opt = array(
        'relationship' => 'estudia_en',
        'relationship_guid' => $guid_institucion,
        'inverse_relationship' => TRUE,
        'order_by_metadata' => array('name' => 'apellidos', 'direction' => 'DESC')
    );
    $lista = elgg_get_entities_from_relationship($opt);
    return $lista;
}

function elgg_get_estudiantes_inst_like_paginable($clave, $guid_institucion, $limit, $offset) {
    $options = array(
        'type' => 'user',
        'wheres' => array(
            'name' => 'mts.string=\'apellidos\' and mts.id=mt.name_id and mt.value_id=mts2.id and concat_ws(\' \', s.name, mts2.string) LIKE \'%' . $clave . '%\' AND mt.entity_guid=s.guid '
            . "AND e.guid=s.guid AND e.guid=r.guid_one AND r.relationship='estudia_en' AND r.guid_two=$guid_institucion",
        ),
        'joins' => array(
            'name' => ', elgg_users_entity s, elgg_metadata mt, elgg_metastrings mts, elgg_metastrings mts2, elgg_entity_relationships r'
        ),
    );
//    $lista = elgg_get_entities_from_relationship($opt);
//    return $lista;

    $users = elgg_list_paginable_entities_metadata(array('query' => $options, 'view' => 'instituciones/integrantes/lista', 'limit' => $limit, 'offset' => $offset,));
    return $users;
}

function elgg_get_profesores_institucion($guid_institucion) {
    $opt = array(
        'relationship' => 'trabaja_en',
        'relationship_guid' => $guid_institucion,
        'inverse_relationship' => TRUE,
        'order_by_metadata' => array('name' => 'apellidos', 'direction' => 'DESC')
    );
    $lista = elgg_get_entities_from_relationship($opt);
    return $lista;
}

function elgg_get_list_grupos_institucion($guid_institucion, $limit, $offset) {
    $query = array('type' => 'group', 'subtype' => 'grupo_investigacion');
    $options = array(
        'query' => $query,
        'limit' => $limit,
        'offset' => $offset,
        'view' => 'instituciones/lista/lista_grupos',
        'relacion' => "pertenece_a",
        'guid' => $guid_institucion,
        'inverse' => TRUE,
    );
    $r = elgg_list_paginable_entities_relationships($options);
    return $lista;
}
