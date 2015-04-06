<?php

/**
 * Función que devuelve los evaluadores registrados en el banco de evaluadores (Grupo evaluadores)
 * @return type -> Array
 */
function elgg_get_evaluadores() {
    $e = elgg_get_grupo_evaluadores();
    $integrantes_evaluadores = elgg_get_relationship_inversa($e, 'member');
    return $integrantes_evaluadores;
}

/**
 * Funcion que devuelve una lista paginable de los evaluadores registrados en el banco de evaluadores
 * @param type $limit
 * @param type $offset
 */
function elgg_get_list_evaluadores($limit, $offset) {
    $e = elgg_get_grupo_evaluadores();

    $options = array('query' => $query,
        'limit' => $limit,
        'offset' => $offset,
        'view' => 'evaluadores/lista/listado_evaluadores',
        'guid' => $e->guid,
        'relacion' => 'member',
        'inverse' => true
    );
    $content = elgg_list_paginable_entities_relationships($options);
    echo $content;
}

/**
 * Funcion que devuelve una lista paginable de los evaluadores registrados en el banco de evaluadores
 * @param type $limit
 * @param type $offset
 */
function elgg_get_list_convocatorias_asignadas($limit, $offset, $user, $view, $relacion) {

    $query = array('type' => 'group', 'subtype' => 'convocatoria');

    $options = array(
        'query' => $query,
        'limit' => $limit,
        'offset' => $offset,
        'view' => $view,
        'guid' => $user->guid,
        'relacion' => $relacion,
    );
    $content = elgg_list_paginable_entities_relationships($options);
    echo $content;
}

/**
 * Función que devuelve la entidad del grupo de evaluadores
 * @return type -> Entity
 */
function elgg_get_grupo_evaluadores() {
    $evaluadores = elgg_get_entities(array(
        'type' => 'group',
        'subtype' => 'RedEvaluadores',
    ));
    $eval = null;
    foreach ($evaluadores as $e) {
        $eval = $e;
    }

    return $eval;
}

/**
 * Funcion que devuelve una lista paginable de los evaluadores preinscritos en el banco de evaluadores
 * @param type $limit
 * @param type $offset
 */
function elgg_get_list_maestros_preincritos_evaluadores($limit, $offset) {

    $banco_evaluadores = elgg_get_entities(array(
        'type' => 'group',
        'subtype' => 'RedEvaluadores',
    ));

    $options = array('query' => $query,
        'limit' => $limit,
        'offset' => $offset,
        'view' => 'evaluadores/lista_preinscritos/listado_evaluadores_preinscritos',
        'guid' => $banco_evaluadores[0]->guid,
        'relacion' => 'membership_request',
        'inverse' => true
    );
    $content = elgg_list_paginable_entities_relationships($options);
    echo $content;
}

/**
 * Función que verifica si un usuario ya es evaluador de la convocatoria
 * @param type $guid_conv -> idenificador de la convocatoria
 * @param type $user_guid -> identificador del ususario
 * @return boolean -> true si ya esta inscrito como evaluador a la convocatoria o false si no lo esta.
 */
function elgg_es_evaludor_convocatoria($guid_conv, $user_guid) {
    return (check_entity_relationship($user_guid, 'preinscrito_evaluador_convocatoria', $guid_conv) ||
            check_entity_relationship($user_guid, 'es_evaluador_convocatoria', $guid_conv) );
}

/**
 * Función que deveuelve todos los evaluadores preinscritos a la convocatoria
 * @param type $guid_convocatoria -> identificador de la convocatoria
 * @return type -> Array
 */
function elgg_get_preevaluadores_convocar($guid_convocatoria) {
    return elgg_get_relationship_inversa(get_entity($guid_convocatoria), 'preinscrito_evaluador_convocatoria');
}

/* * Función que permitie verificar si un masestro se encuentra preinscrito o es miembro del banco de evaluadores
 */

function elgg_verificar_inscripcion_maestro_evaluador() {
    $user = elgg_get_logged_in_user_entity();

    $banco_evaluadores = elgg_get_entities(array(
        'type' => 'group',
        'subtype' => 'RedEvaluadores',
    ));

    if (!elgg_is_rol_logged_user("Profesor")) {
        return true;
    }
    if (check_entity_relationship($user->guid, 'membership_request', $banco_evaluadores[0]->guid) || check_entity_relationship($user->guid, 'member', $banco_evaluadores[0]->guid)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Función que imprime en pantalla las investigaciones que se encuentran asignadas a un evaluador 
 * dentro de una feria/convocatoria dada
 * @param type $user - usuario evaluador
 * @param type $relacion - nombre de la relación con la que se van a buscar las investigaciones asignadas al usuario
 * @param type $vista - vista en la cual se va a mostrar el resultado de la consulta
 * @param type $participa - municipal o departamental en caso de que la consulta sea sobre las investigaciones de una feria
 * @param type $guid - id de la convocatoria o feria sobre la cual se está haciendo la consulta / NULL
 */
function elgg_get_investigaciones_asignadas_usuario($user, $relacion, $vista, $participa, $guid = NULL) {
    $consulta = array('type' => 'group', 'subtype' => 'investigacion', 'relationship_guid' => $user,
        'relationship' => $relacion, 'inverse_relationship' => false);
    $entities = elgg_get_entities_from_relationship($consulta);
    $options['entities'] = elgg_investigaciones_entity($entities, $guid);
    $options['participa'] = $participa;
    $options['guid_entity'] = $guid;

    echo elgg_view($vista, $options);
}

/**
 * Función que imprime en pantalla las investigaciones que se encuentran asignadas a un asesor 
 * dentro de una convocatoria dada
 * @param type $user - usuario evaluador
 * @param type $relacion - nombre de la relación con la que se van a buscar las investigaciones asignadas al usuario
 * @param type $vista - vista en la cual se va a mostrar el resultado de la consulta
 * @param type $guid - id de la convocatoria sobre la cual se está haciendo la consulta / NULL
 */
function elgg_get_investigaciones_asignadas_usuario2($user, $relacion, $vista, $guid = NULL) {
    $consulta = array('type' => 'group', 'subtype' => 'investigacion', 'relationship_guid' => $user,
        'relationship' => $relacion, 'inverse_relationship' => false);
    $entities = elgg_get_entities_from_relationship($consulta);
    $options['entities'] = elgg_investigaciones_entity2($entities, $guid);
    $options['guid_entity'] = $guid;

    echo elgg_view($vista, $options);
}

function elgg_get_investigaciones_asignadas_usuario2_red($user, $relacion, $vista) {
    $consulta = array('type' => 'group', 'subtype' => 'investigacion', 'relationship_guid' => $user,
        'relationship' => $relacion, 'inverse_relationship' => true);
    $entities = elgg_get_entities_from_relationship($consulta);
    $options['entities'] = $entities;
    $options['linea']= $user;
    echo elgg_view($vista, $options);
}

/**
 * Función que devuelve las investigaciones asignadas a un evaluador que pertenecen a una 
 * convocatoria o feria dada
 * @param array $investigaciones - todas las investigaciones asignadas al usuario (asesor o evaluador)
 * @param type $id_conv - ID de la convocatoria o feria sobre la cual se va a hacer el filtro
 * return array
 */
function elgg_investigaciones_entity($investigaciones, $id_entity) {
    $array = array();
    $entity = get_entity($id_entity);
    if ($entity->getSubtype() == 'convocatoria') {
        foreach ($investigaciones as $investigacion) {
            if (check_entity_relationship($investigacion->guid, "inscrita_a_convocatoria", $id_entity) || check_entity_relationship($investigacion->guid, "evaluada_en_convocatoria", $id_entity) || check_entity_relationship($investigacion->guid, "seleccionada_en_convocatoria", $id_entity)) {
                array_push($array, $investigacion);
            }
        }
    } else if ($entity->getSubtype() == 'feria') {
        $tipo = ($entity->tipo_feria == 'Municipal') ? "municipal" : "departamental";
        foreach ($investigaciones as $investigacion) {
            if (check_entity_relationship($investigacion->guid, "participa_en_$tipo", $id_entity)) {
                array_push($array, $investigacion);
            }
        }
    }
    error_log("participan en feria ".sizeof($array));
    return $array;
}

/**
 * Función que devuelve las investigaciones asignadas a un asesor que pertenecen a una 
 * convocatoria
 * @param array $investigaciones - todas las investigaciones asignadas al usuario (asesor o evaluador)
 * @param type $id_conv - ID de la convocatoria o feria sobre la cual se va a hacer el filtro
 * return array
 */
function elgg_investigaciones_entity2($investigaciones, $id_entity) {
    $array = array();
    $entity = get_entity($id_entity);

    foreach ($investigaciones as $investigacion) {

        if (check_entity_relationship($investigacion->guid, "seleccionada_a_convocatoria_especial", $id_entity)) {

            array_push($array, $investigacion);
        }
    }
    return $array;
}

function elgg_get_ferias_mun_evaluador($limit, $offset, ElggUser $ev) {
    $vista = "investigaciones_feria_asignadas/lista_ferias_tipo";
    $rel = 'es_evaluador_feria';
    $query = array('type' => 'group', 'subtype' => 'feria',
        'metadata_name_value_pairs' => array(
            'name' => 'tipo_feria',
            'value' => 'Municipal',
            'operand' => '=',
            'case_sensitive' => TRUE
        )
    );

    $options = array(
        'query' => $query,
        'limit' => $limit,
        'offset' => $offset,
        'view' => $vista,
        'guid' => $ev->guid,
        'relacion' => $rel,
    );
    $content = elgg_list_paginable_entities_relationships($options);
    return $content;


    //return $ev->getEntitiesFromRelationship('es_evaluador_feria');
}

function elgg_get_ferias_dep_evaluador($limit, $offset, ElggUser $ev) {
    $vista = "investigaciones_feria_asignadas/lista_ferias_tipo";
    $rel = 'es_evaluador_feria';
    $query = array('type' => 'group', 'subtype' => 'feria',
        'metadata_name_value_pairs' => array(
            'name' => 'tipo_feria',
            'value' => 'Departamental',
            'operand' => '=',
            'case_sensitive' => TRUE
        )
    );

    $options = array(
        'query' => $query,
        'limit' => $limit,
        'offset' => $offset,
        'view' => $vista,
        'guid' => $ev->guid,
        'relacion' => $rel,
    );

    $content = elgg_list_paginable_entities_relationships($options);
    return $content;
}

function elgg_get_investigaciones_feria_evaluador($feria, $ev) {
    $lista = array();
    $options = array();
    if ($feria->tipo_feria === 'Departamental') {

        $options = array(
            'relationship' => "participa_en_departamental",
            'relationship_guid' => $feria->guid,
            'inverse_relationship' => TRUE,
        );
    } else {

        $options = array(
            'relationship' => 'participa_en_municipal',
            'relationship_guid' => $feria->guid,
            'inverse_relationship' => TRUE,
        );
    }
    $inv = array();
    $inv = elgg_get_entities_from_relationship($options);

    $count_inicial = 0;
    $count_sitio = 0;
    foreach ($inv as $in) {
        if ($feria->tipo_feria === 'Departamental') {
            if (check_entity_relationship($ev, 'es_evaluador_inicial_dptal_de', $in->guid)) {
                $count_inicial++;
            }

            if (check_entity_relationship($ev, 'es_evaluador_en_sitio_dptal_de', $in->guid)) {
                $count_sitio++;
            }
            //array_push($lista, $investigacion);
        } else {
            if (check_entity_relationship($ev, 'es_evaluador_inicial_mun_de', $in->guid)) {
                $count_inicial++;
            }

            if (check_entity_relationship($ev, 'es_evaluador_en_sitio_mun_de', $in->guid)) {
                $count_sitio++;
            }
//            if (check_entity_relationship($ev, 'es_evaluador_inicial_mun_de', $in) ||
//                    check_entity_relationship($ev, 'es_evaluador_en_sitio_mun_de', $in))
//                array_push($lista, $investigacion);
        }
    }

    $lista['inicial'] = $count_inicial;
    $lista['sitio'] = $count_sitio;

    return $lista;
}
