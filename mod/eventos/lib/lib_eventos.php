<?php

function elgg_get_relationship_inversa($objeto, $name_relacion) {
    $entities = $objeto->getEntitiesFromRelationship($name_relacion, true);
    return $entities;
}

function elgg_get_all_usuarios() {
    $options = array(
        'type' => 'user',
    );
    $users = elgg_get_entities($options);
    return $users;
}

function elgg_get_all_usuarios_like($clave) {
    $options = array(
        'type' => 'user',
        'wheres' => array(
            'name' => 'mts.string=\'apellidos\' and mts.id=mt.name_id and mt.value_id=mts2.id and concat_ws(\' \', s.name, mts2.string) LIKE \'%' . $clave . '%\' AND mt.entity_guid=s.guid '
            . 'AND e.guid=s.guid',
        ),
        'joins' => array(
            'name' => ', elgg_users_entity s, elgg_metadata mt, elgg_metastrings mts, elgg_metastrings mts2'
        ),
    );

    $users = elgg_get_entities_from_metadata($options);
    return $users;
}

function elgg_get_all_usuarios_like_paginable($clave, $limit, $offset) {
   
    $options = array(
        'type' => 'user',
        'wheres' => array(
            'name' => 'mts.string=\'apellidos\' and mts.id=mt.name_id and mt.value_id=mts2.id and concat_ws(\' \', s.name, mts2.string) LIKE \'%' . $clave . '%\' AND mt.entity_guid=s.guid '
            . 'AND e.guid=s.guid',
        ),
        'joins' => array(
            'name' => ', elgg_users_entity s, elgg_metadata mt, elgg_metastrings mts, elgg_metastrings mts2'
        ),
    );

    $users = elgg_list_paginable_entities_metadata(array('query'=>$options, 'view' => 'busqueda/lista', 'limit' => $limit, 'offset' => $offset,));
    return $users;
}


function buscar_directorio($guid, $clave) {
    $evento = new ElggEvento($guid);

    $preinscritos = elgg_get_relationship_inversa($evento, "inscrito_al_evento");
    $asistentes = elgg_get_relationship_inversa($evento, "asistió_al_evento");
    $all = elgg_get_all_usuarios_like($clave);
    $nuevos = array();
    foreach ($all as $user) {
        if (!in_array($user, $preinscritos) && !in_array($user, $asistentes)) {
            $us = array('id_usuario' => $user->guid, 'nombres_usuario' => $user->name, 'apellidos_usuario' => $user->apellidos);
            array_push($nuevos, $us);
        }
    }
    return $nuevos;
}

function elgg_get_evento($guid) {
    $options = array('type' => 'object',
        'subtype' => 'evento',
        'guid' => $guid);
    $eventos = elgg_get_entities($options);
    return $eventos[0];
}

function elgg_get_eventos_all() {

    $user = elgg_get_logged_in_user_entity();

    $grupos = elgg_get_relationship($user, "es_miembro_de");
    $grupos2 = elgg_get_relationship($user, "administrador");

    if($user->getSubtype()=="estudiante"){
    $grupos3= elgg_get_relationship($user, "estudia_en");
    }
    else{
    $grupos3= elgg_get_relationship($user, "trabaja_en"); 
    }
    
    
    $eventos = array();
    foreach ($grupos as $grupo) {

        $options = array('type' => 'object',
            'subtype' => 'evento',
            'container_guid' => $grupo->guid);

        $eventos= array_merge($eventos,elgg_get_entities($options));
    }

    foreach ($grupos2 as $grupo) {

        $options = array('type' => 'object',
            'subtype' => 'evento',
            'container_guid' => $grupo->guid);
        $eventos= array_merge($eventos,elgg_get_entities($options));
    }
    
    foreach ($grupos3 as $grupo) {

        $options = array('type' => 'object',
            'subtype' => 'evento',
            'container_guid' => $grupo->guid);
        $eventos= array_merge($eventos,elgg_get_entities($options));
    }
   
    return $eventos;
    
    
}

function elgg_get_json_eventos_entity($entity) {
    $retorno = array();
    $eventos= elgg_get_relationship($entity, 'tiene_el_evento');
    foreach ($eventos as $evento) { 
        $eve = array();
        $eve['id'] = $evento->guid;
        $eve['title'] = $evento->nombre_evento;
        $eve['start'] = $evento->fecha_inicio;
        if ($evento->fecha_inicio != $evento->fecha_terminacion) {
            $eve['end'] = $evento->fecha_terminacion;
        }

        array_push($retorno, $eve);
    }
    return json_encode($retorno);
}
