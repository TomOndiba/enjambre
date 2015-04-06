<?php

/**
 * Busca las instituciones registradas y lista los nombres en un array de String
 * @return array()
 */
function elgg_get_lista_instituciones() {
    $opt = array(
        'type' => 'group',
        'subtype' => 'institucion',
    );
    $instituciones = elgg_get_entities($opt);
    $lista = array();
    foreach ($instituciones as $institucion) {
        $lista[$institucion->name] = $institucion->name;
    }
    return $lista;
}

/**
 * Metodo que retorna una institucion dado su nombre,
 * si no la encuentra retorna FALSE
 * @param type $name :nombre de la institucion
 * @return boolean
 */
function elgg_get_institucion_by_name($name) {
    $db_prefix = get_config('dbprefix');
    $opt = array(
        'type' => 'group',
        'subtype' => 'institucion',
        'joins' => array("JOIN {$db_prefix}groups_entity ge on ge.guid = e.guid"),
        'wheres' => array("ge.name = '$name'"),
    );

    $buscado = elgg_get_entities($opt);
    $lista = array();
    if($buscado){
        return $buscado[0];
    }
    return false;
}


/**
 * Retorna las visitas (ElggVisita) realizadas por el usuario
 * @return array
 */
function elgg_get_visitas_from_user() {
    $user = elgg_get_logged_in_user_entity();
    $options = array(
        'type' => 'object',
        'subtype' => 'visita',
        'owner_guid' => $user->guid,
    );
    
    $visitas = elgg_get_entities_from_metadata($options);
    
    $lista = array();
    
    foreach ($visitas as $v) {
        $visitada = $v->getEntitiesFromRelationship('visito'); //array de instituciones relacionadas(solo 1)
        if($visitada = $v->getEntitiesFromRelationship('visito')){
           
        }
        $institucion = new ElggGroup($visitada[0]->guid); // se toma el unico objeto que debe existir en la relacion
        $dato = array(
            'id'=>$v->guid,
            'fecha_visita' => $v->fecha_visita,
            'departamento' => $v->departamento,
            'municipio' => $v->municipio,
            'institucion' => $institucion->name,
            'institucionURL'=> $institucion->getURL(),
            'institucion-icon'=> $institucion->getIconURL('small'),
            'interesado' => $v->interesado,
            'observaciones' => $v->observaciones,
            'tipo_comunicacion' => $v->tipo_comunicacion,
        );
        array_push($lista, $dato);
    }

    return $lista;
}

function elgg_get_visitas_convocatoria($id_conv){
    
    $user = elgg_get_logged_in_user_entity();
  
    $options = array(
        'type' => 'object',
        'subtype' => 'visitaConvocatoria',
        //'owner_guid' => $user->guid,
        'container_guid'=> $id_conv,
    );
    
    $visitas = elgg_get_entities_from_metadata($options);
    
    $lista = array();
    
    foreach ($visitas as $v) {
        $opt = array(
    'relationship' => 'visito',
    'relationship_guid' => $v->guid,
    //'inverse_relationship' => TRUE,
    //'order_by_metadata' => array('name' => 'orden', 'direction' => 'ASC')
);
        $visitada = elgg_get_entities_from_relationship($opt);
        
        //$visitada = $v->getEntitiesFromRelationship('visito'); //array de instituciones relacionadas(solo 1)
//        if($visitada = $v->getEntitiesFromRelationship('visito')){

//        }
        //$institucion = new ElggGroup($visitada[0]->guid); // se toma el unico objeto que debe existir en la relacion
        $institucion = new ElggInstitucion($visitada[0]->guid);
        
        $dato = array(
            'id'=>$v->guid,
            'fecha_visita' => $v->fecha_visita,
            'departamento' => $v->departamento,
            'municipio' => $v->municipio,
            'institucion' => $institucion->name,
            'institucionURL'=> $institucion->getURL(),
            'institucion-icon'=> $institucion->getIconURL('small'),
            'asunto' => $v->asunto,
            'observaciones' => $v->observaciones,
            'tipo_comunicacion' => $v->tipo_comunicacion,
        );
        array_push($lista, $dato);
    }

    return $lista;
    
}

function elgg_get_institucion_visitada($id_visita){
    $visita = new ElggVisitaConvocatoria($id_visita);
    $visitadas = $visita->getEntitiesFromRelationship('visito');
    $inst_visitada= new ElggInstitucion($visitadas[0]->guid);
   
    return $inst_visitada;
}
