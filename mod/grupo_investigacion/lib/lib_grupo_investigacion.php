<?php

/**
 * Metodo para consultar si un grupo existe.
 * @param type $name nombre del grupo de investigacion
 * @return boolean. Indica si exite o no un grupo con el nombre
 */
function elgg_existe_grupo($name) {
    $bd = Db::getInstance();
    /* Creamos una query sencilla */
    $sql = "SELECT * FROM elgg_groups_entity g INNER JOIN elgg_entities e ON e.guid=g.guid "
            . "INNER JOIN elgg_entity_subtypes es ON es.id=e.subtype AND es.subtype='grupo_investigacion' "
            . "WHERE g.name='$name'";
    $stmt = $bd->ejecutar($sql);
    $existe = false;
    while ($x = $bd->obtener_fila($stmt, 0)) {
        $existe = true;
    }
    return $existe;
}

/**
 * Lista los grupos de investigacion
 * @return array lista de los grupos de investigacion
 */
function elgg_listar_grupos_investigacion() {


    $options = array(
        'type' => 'group',
        'subtype' => 'grupo_investigacion'
    );

    $grupos = elgg_get_entities($options);

    $listado = array();
    foreach ($grupos as $grupo) {
        $url = elgg_get_site_url() . "action/grupo_investigacion/eliminar?id=" . $grupo->guid;
        $url_eliminar = elgg_add_action_tokens_to_url($url);
        $grup = array('id' => $grupo->guid, 'nombre' => $grupo->name, 'href' => $url_eliminar);
        array_push($listado, $grup);
    }
    return $listado;
}

/**
 * Obtiene el rol de un usuario en en Grupo de Investigacion
 * @param ElggGrupoInvestigacion $grupo Grupo de investigacion
 * @param entity $user Usuario a consultar
 * @return string|boolean: String con el nombre del Rol del usuario en el grupo
 *                         false si el usuario no tiene rol en el grupo
 */
function elgg_get_rol_en_grupo_investigacion(ElggGrupoInvestigacion $grupo, $user) {
    if (elgg_is_admin_grupo_investigacion($grupo, $user->guid)) {
        return "admin";
    } else if (elgg_is_member_grupo_investigacion($grupo, $user->guid)) {
        return "leer";
    } else if (elgg_is_request_grupo_investigacion($grupo, $user->guid)) {
        return "request";
    } else {
        return false;
    }
}

/**
 * Permite conocer si un usuario es miembro en un grupo de investigacion
 * @param ElggGrupoInvestigacion $grupo Grupo de Investigacion
 * @param entity $user Usuario 
 * @return string|boolean String con el rol del usuario 
 */
function elgg_is_miembro_en_grupo_investigacion($grupo, $user) {
    if (elgg_is_admin_grupo_investigacion($grupo, $user)) {
        return "admin";
    } else if (elgg_is_member_grupo_investigacion($grupo, $user)) {
        return "leer";
    } else {
        return false;
    }
}

/**
 * Permite conocer si un usuario es administrador en un grupo de investigación
 * @param ElggGrupoInvestigacion $grupo Grupo de Investigacion
 * @param entity $user Usuario
 * @return boolean 
 */
function elgg_is_admin_grupo_investigacion($grupo, $user) {
    if (check_entity_relationship($user, "administrador", $grupo->guid)) {
        return true;
    }
    return false;
}

/**
 * Permite conocer si un usuario es miembro de un grupo de investigación
 * @param ElggGrupoInvestigacion $grupo Grupo de Investigación
 * @param entity $user Usuario
 * @return boolean 
 */
function elgg_is_member_grupo_investigacion($grupo, $user) {
    if (check_entity_relationship($user, "es_miembro_de", $grupo->guid)) {
        return true;
    }
    return false;
}

/**
 * Permite conocer si un usuario esta en espera de ser aceptado en uu grupo de investigación
 * @param entity $grupo Grupo de Investigación
 * @param entity $user Usuario
 * @return int 1 si el usuario esta en espera
 */
function elgg_is_request_grupo_investigacion($grupo, $user) {
    if (check_entity_relationship($user, "peticionUnirse", $grupo->guid)) {
        return 1;
    }
}

/**
 * Permite obtenes los miebros de un grupos de investigacion: Administradores y miembros
 * @param ElggGrupoInvestigacion $grupo Grupo de Investigación
 * @return array lista de miebros del grupo de investigación
 */
function elgg_get_entities_grupo_investigacion($grupo) {

    $todos = array();
    $admins = $grupo->getEntitiesFromRelationship("administrador", true);
    foreach ($admins as $miembro) {
        array_push($todos, array(
            'rol' => 'admin',
            'usuario' => $miembro
        ));
    }

    $editores = $grupo->getEntitiesFromRelationship("editar", true);
    foreach ($editores as $miembro) {
        array_push($todos, array(
            'rol' => 'editar',
            'usuario' => $miembro
        ));
    }

    $miembros = $grupo->getEntitiesFromRelationship("es_miembro_de", true);
    foreach ($miembros as $miembro) {
        array_push($todos, array(
            'rol' => 'leer',
            'usuario' => $miembro
        ));
    }
    return $todos;
}

function elgg_get_entities_desactivados_grupo_investigacion(ElggGrupoInvestigacion $grupo) {

    $todos = array();
    $admins = $grupo->getEntitiesFromRelationship("usuario_desactivado_de", true);
    foreach ($admins as $miembro) {
        array_push($todos, array(
            'rol' => 'admin',
            'usuario' => $miembro
        ));
    }
    return $todos;
}

function elgg_get_mis_grupos_investigacion($user_guid) {
    $todos = array();
    $options = array('relationship' => 'administrador',
        'relationship_guid' => $user_guid,
        'inverse_relationship' => FALSE
    );
    $todos = array_merge($todos, elgg_get_entities_from_relationship($options));
    $options = array('relationship' => 'editar',
        'relationship_guid' => $user_guid,
        'inverse_relationship' => FALSE
    );
    $todos = array_merge($todos, elgg_get_entities_from_relationship($options));
    $options = array('relationship' => 'es_miembro_de',
        'relationship_guid' => $user_guid,
        'inverse_relationship' => FALSE
    );
    $todos = array_merge($todos, elgg_get_entities_from_relationship($options));

    $final = array();
    foreach ($todos as $grupo) {
        if ($grupo->getSubtype() == 'grupo_investigacion') {
            array_push($final, $grupo);
        }
    }

    return $final;
}

/**
 * Permite obtener el numero de miembros de un grupo de investigación: miembros 
 * @param ElggGrupoInvestigacion $grupo
 * @return array
 */
function elgg_get_miembros_grupo_investigacion($grupo) {
    $miembros = elgg_get_entities_de_grupo_investigacion($grupo);
    $todos = array();
    foreach ($miembros as $miembro) {
        array_push($todos, array(
            'rol' => $miembro['rol'],
            'guid' => $miembro['usuario']->guid,
            'nombre' => $miembro['usuario']->name . " " . $miembro['usuario']->apellidos,
            'username' => $miembro['usuario']->username,
            'icono' => $miembro['usuario']->getIconURL(),
        ));
    }
    return $todos;
}

function elgg_get_miembros_desactivados_grupo_investigacion(ElggGrupoInvestigacion $grupo) {
    $miembros = elgg_get_entities_desactivados_grupo_investigacion($grupo);
    $todos = array();
    foreach ($miembros as $miembro) {
        array_push($todos, array(
            'rol' => $miembro['rol'],
            'guid' => $miembro['usuario']->guid,
            'nombre' => $miembro['usuario']->name . " " . $miembro['usuario']->apellidos,
            'username' => $miembro['usuario']->username,
            'icono' => $miembro['usuario']->getIconURL(),
        ));
    }
    return $todos;
}

function elgg_get_miembros_grupo_like_paginable($clave, $guid_grupo, $limit, $offset) {
    $options = array(
        'type' => 'user',
        'wheres' => array(
            'name' => 'mts.string=\'apellidos\' and mts.id=mt.name_id and mt.value_id=mts2.id and concat_ws(\' \', s.name, mts2.string) LIKE \'%' . $clave . '%\' AND mt.entity_guid=s.guid '
            . "AND e.guid=s.guid AND e.guid=r.guid_one AND r.relationship='es_miembro_de' AND r.guid_two=$guid_grupo",
        ),
        'joins' => array(
            'name' => ', elgg_users_entity s, elgg_metadata mt, elgg_metastrings mts, elgg_metastrings mts2, elgg_entity_relationships r'
        ),
    );
//    $lista = elgg_get_entities_from_relationship($opt);
//    return $lista;

    $users = elgg_list_paginable_entities_metadata(array('query' => $options, 'view' => 'grupo_investigacion/integrantes/lista', 'limit' => $limit, 'offset' => $offset,));
    return $users;
}

function elgg_get_miembros_grupo_like_paginable_2($clave, $guid_grupo, $limit, $offset) {
    $options = array(
        'type' => 'user',
        'wheres' => array(
            'name' => 'mts.string=\'apellidos\' and mts.id=mt.name_id and mt.value_id=mts2.id and concat_ws(\' \', s.name, mts2.string) LIKE \'%' . $clave . '%\' AND mt.entity_guid=s.guid '
            . "AND e.guid=s.guid AND e.guid=r.guid_one AND r.relationship='es_miembro_de' AND r.guid_two=$guid_grupo",
        ),
        'joins' => array(
            'name' => ', elgg_users_entity s, elgg_metadata mt, elgg_metastrings mts, elgg_metastrings mts2, elgg_entity_relationships r'
        ),
    );
//    $lista = elgg_get_entities_from_relationship($opt);
//    return $lista;

    $users = elgg_list_paginable_entities_metadata_2(array('query' => $options, 'view' => 'grupo_investigacion/integrantes/lista_1', 'limit' => $limit, 'offset' => $offset, 'grupo' => $guid_grupo));
    return $users;
}

/**
 * Permite modificar el rol de un usuario en un grupo de investigacion
 * @param ElggGrupoInvestigacion $grupo Grupo de Investigacion
 * @param ElggUser $user usuario
 * @param String $rol Nuevo rol en el grupo
 * @param String $rolAntiguo Antiguo rol en el grupo
 * @return boolean Si se pudo modificar el rol del usuario en el grupo
 */
function elgg_set_rol_grupo_investigacion(ElggGrupoInvestigacion $grupo, ElggUser $user, $rol, $rolAntiguo) {
    $retorno = false;
    switch ($rol) {
        case 'admin':
            $relacion = "administrador";
            if (elgg_add_rol_user_grupo_investigacion($user, $grupo, $relacion)) {
                if (elgg_delete_rol_user_grupo_investigacion($user, $grupo, $rolAntiguo)) {
                    $retorno = true;
                }
            }
            break;
        case 'editar':
            $relacion = "editar";
            if (elgg_add_rol_user_grupo_investigacion($user, $grupo, $relacion)) {
                if (elgg_delete_rol_user_grupo_investigacion($user, $grupo, $rolAntiguo)) {
                    $retorno = true;
                }
            }
            break;
        case 'leer':
            $relacion = "es_miembro_de";
            if (elgg_add_rol_user_grupo_investigacion($user, $grupo, $relacion)) {
                if (elgg_delete_rol_user_grupo_investigacion($user, $grupo, $rolAntiguo)) {
                    $retorno = true;
                }
            }
            break;
    }
    return $retorno;
}

/**
 * Pemite agregar un rol a un usuario en un grupo de investigacion
 * @param ElggUser $user Usuario
 * @param ElggGrupoInvestigacion $grupo Grupo de Investigación
 * @param type $relacion nombre de la relacion (rol) del usuario en el grupo
 * @return boolean si se agrego el rol al usuario en el grupo correctamente
 */
function elgg_add_rol_user_grupo_investigacion(ElggUser $user, ElggGrupoInvestigacion $grupo, $relacion) {
    return $user->addRelationship($grupo->guid, $relacion);
}

/**
 * Permite eliminar un rol a un usuario en un grupo de investigación
 * @param ElggUser $user Usuario
 * @param ElggGrupoInvestigacion $grupo Grupo de Investigación
 * @param String $rolAntiguo Rol de usuario en el Grupo de investigacion
 * @return boolean Si se elimino el rol del usuario en el grupo correctamente
 */
function elgg_delete_rol_user_grupo_investigacion(ElggUser $user, ElggGrupoInvestigacion $grupo, $rolAntiguo) {
    if ($rolAntiguo == 'leer') {
        $rolAntiguo = 'es_miembro_de';
    } else if ($rolAntiguo == 'admin') {
        $rolAntiguo = 'administrador';
    }
    return $user->removeRelationship($grupo->guid, $rolAntiguo);
}

/**
 * Permite listar los usuarios con solicitud de unirse a un grupo de investigacion
 * @param int $guid Guid del grupo de investigación
 * @return array de lista de miembros: Formato:
 *                                           'nombre'=> Nombre del usuario
 *                                           'href_a'=> Url para aceptar al usuario
 *                                           'href_r'=> Url de action para rechazar al usuario
 *                                           'imagen'=> url de la imagen del perfil del usuario      
 */
function elgg_listar_solicitud_miembro($guid) {

    $grupo_investigacion = new ElggGrupoInvestigacion($guid);
    $miembros = $grupo_investigacion->getEntitiesFromRelationship("peticionUnirse", true);
    $listado = array();
    foreach ($miembros as $miembro) {
        $acepta = elgg_get_site_url() . "action/grupo_investigacion/miembro_grupo?id_grupo=" . $guid . "&id_miembro=" . $miembro->guid . "&acepta=true";
        $rechaza = elgg_get_site_url() . "action/grupo_investigacion/miembro_grupo?id_grupo=" . $guid . "&id_miembro=" . $miembro->guid . "&acepta=false";
        $url_acepta = elgg_add_action_tokens_to_url($acepta);
        $url_rechaza = elgg_add_action_tokens_to_url($rechaza);

        $m = array('nombre' => $miembro->name, 'apellidos' => $miembro->apellidos, 'href_a' => $url_acepta, 'href_r' => $url_rechaza, 'imagen' => $miembro->getIconURL(), 'profile' => $miembro->getURL());
        array_push($listado, $m);
    }
    return $listado;
}

/**
 * Prmite conocer si un usuario es miembro o tiene la peticion de unirse al grupo
 * @param entity $user Usuario
 * @param array $grupo Formato: 'id'=> guid del grupo de investigación
 * @return int 1 si es miembro del grupo, 2 si tiene petición de unirse al grupo.
 */
function elgg_esMiembro($user, $grupo) {
    if (check_entity_relationship($user->guid, "es_miembro_de", $grupo['id'])) {
        return 1;
    }
    if (check_entity_relationship($user->guid, "peticionUnirse", $grupo['id'])) {
        return 2;
    }
    return 3;
}

/**
 * Permite saber si un usuario logueado es miembro de un grupo, red e institucion
 * @param entity $guid Entity
 * @param entity $user Usuario
 * @return boolean
 */
function elgg_is_miembro_admin($guid, $user) {



    $entity = get_entity($guid);


    if ($entity->getSubtype() == "institucion") {
        return elgg_get_is_miembro_institucion($guid, $user);
    } else if ($entity->getSubtype() == "red_tematica" || $entity->getSubtype() == "grupo_investigacion") {
        return (check_entity_relationship($user, "administrador", $guid) || check_entity_relationship($user, "es_miembro_de", $guid));
    } else if ($entity->getType() == "user") {
        return ($guid == $user);
    } else if ($entity->getSubtype() == "investigacion" || $entity->getSubtype() == "cuaderno_campo") {
        return(check_entity_relationship($user, "hace_parte_de", $guid) || check_entity_relationship($user, "es_colaborador_de", $guid) || $user == $entity->owner_guid);
    }

    return false;
}

/**
 * Permite obtener si un usuario es  solo miebro del grupo
 * @param entity $grupo Grupo de Investigación
 * @param entity $user Usuario
 * @return boolean
 */
function elgg_is_miembro_grupo_investigacion($grupo, $user) {
    if (elgg_is_admin_grupo_investigacion($grupo, $user) || elgg_is_member_grupo_investigacion($grupo, $user)) {
        return true;
    } else
        return false;
}

/**
 * Permite obtener una lista de grupos de investigación filtrada por un nombre
 * @param int $limit cantidad de elementos que se desea obtener
 * @param int $offset numero apartir del cual se desea que se liste los grupos de Investigación
 * @param String $busqueda. Consulta que se desea que coincida con el nombre del grupo
 */
function elgg_get_list_grupo_investigacion_nombre($limit, $offset, $busqueda) {
    $db_prefix = get_config('dbprefix');
    $query = array('type' => 'group',
        'subtype' => 'grupo_investigacion',
        'joins' => array("JOIN {$db_prefix}groups_entity ge on ge.guid = e.guid"),
        'wheres' => array("ge.name  LIKE '%$busqueda%'"));

    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'grupo_investigacion/lista/lista_grupo_investigacion');
    $content = elgg_list_paginable_entities($options);
    echo $content;
}

/**
 * Permite obtener una lista de grupos de investigación
 * @param int $limit cantidad de elementos que se desea obtener
 * @param int $offset número a partir del cual se desea que se liste los grupos de Investigación
 */
function elgg_get_list_grupo_investigacion($limit, $offset) {
    $query = array('type' => 'group', 'subtype' => 'grupo_investigacion');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'grupo_investigacion/lista/lista_grupo_investigacion');
    $content = elgg_list_paginable_entities($options);
    echo $content;
}

/**
 * Permite obtener una lista paginable con ajax de entidades
 * @param array $options. Formato:
 *                      'query'=> String con la consulta,
 *                      'limit'=> int con la cantidad de elementos que se desea obtener
 *                      'offset'=> número a partir del cual se desea que se liste las entidades
 *                      'view'=> Vista que se va a mostrar.    
 */
function elgg_list_paginable_entities($options, $activa = true) {
    $consulta = $options['query'];
    $consulta['limit'] = $options['limit'];
    $consulta['offset'] = $options['offset'];
    if (!$activa) {
        $entities = elgg_get_disabled_entities($consulta);
    } else {
        $entities = elgg_get_entities($consulta);
    }
    //$entities = elgg_get_entities($consulta);
    $options['entities'] = $entities;
    $consulta['count'] = true;
    if (!$activa) {
        $count = elgg_get_disabled_entities($consulta);
    } else {
        $count = elgg_get_entities($consulta);
    }
    //$count = elgg_get_entities($consulta);
    $options['total'] = $count;
    echo elgg_view($options['view'], $options);
    elgg_get_pagination($options);
}

function elgg_get_instituciones_priorizadas($options) {
    $bd = Db::getInstance();
    /* Creamos una query sencilla */
    $sql = "SELECT guid as guid, nombre as name FROM colegios_enjambre limit {$options['limit']} offset {$options['offset']}";
    $stmt = $bd->ejecutar($sql);
    /* Realizamos un bucle para ir obteniendo los resultados */
    $instituciones = array();
    $attr = array('guid', 'name');
    while ($x = $bd->obtener_fila($stmt, 0)) {
        $institucion;
        foreach ($attr as $atributo) {
            if ($atributo == 'guid') {
                error_log($x[$attr]);
                $institucion = get_entity($x[$atributo]);
            }
        }
        array_push($instituciones, $institucion);
    }
    return $instituciones;
}
function elgg_is_priorizada($guid) {
    $bd = Db::getInstance();
    /* Creamos una query sencilla */
    $sql = "SELECT guid as guid FROM colegios_enjambre where guid = {$guid}";
    $stmt = $bd->ejecutar($sql);
    /* Realizamos un bucle para ir obteniendo los resultados */
    $instituciones = array();
    $attr = array('guid', 'name');
    while ($x = $bd->obtener_fila($stmt, 0)) {
        $institucion;
        foreach ($attr as $atributo) {
            if ($atributo == 'guid') {
                error_log($x[$attr]);
                $institucion = get_entity($x[$atributo]);
            }
        }
        array_push($instituciones, $institucion);
    }
    return (count($instituciones)>0);
}

function elgg_list_paginable_entities_instuciones_priorizadas($options, $activa = true) {
    $consulta = $options['query'];
    $consulta['limit'] = $options['limit'];
    $consulta['offset'] = $options['offset'];
    $entities = elgg_get_instituciones_priorizadas($options);
    //$entities = elgg_get_entities($consulta);
    $options['entities'] = $entities;
    //$count = elgg_get_entities($consulta);
    $options['total'] = 148;
    echo elgg_view($options['view'], $options);
    elgg_get_pagination($options);
}

/**
 * Permite imprimir en pantalla los números de pagina de un listado
 * @param array $vars. Formato: 'total'=>int número de elementos,
 *                              'limit'=> int cantidad de elementos que se imprimen en pantalla,
 *                                  
 */
function elgg_get_pagination($vars) {

    $pag = "<ul class='paginacion'>";

    $total_entities = $vars['total'];
    $limit = $vars['limit'];
    $num = 1;
    for ($i = 0; $i < $total_entities; $i = $i + $limit) {
        $offset = ($num - 1) * $limit;
        $name = $vars['guid'];
        $container = $vars['container_guid'];

        $pag.="<li><a class='pagination-item' tittle='$offset' name='$name' id='$container'>$num</a></li>";
        $num++;
    }
    $pag.="</ul>";
    echo $pag;
}

/**
 * Prmite obtener el muro de un grupo de Investigación
 * @param array $query consulta del grupo de investigación
 * @param boolean $add 
 * @return String imprime en pantalla el muro de un grupo de investigación
 */
function elgg_get_messageboard_grupo_investigacion($query, $add) {
    $options = array('query' => $query,
        'view' => 'messageboard/messageboard',
        'new_post' => $add,
    );
    return elgg_get_messageboard($options);
}

/**
 * Permite pintar en pantalla las anotaciones (post) el muro de un grupo de investigación
 * @param array $options. format:
 * @return String 'query'=> array con la consulta,
 *                      'view'=> Vista que se va a mostrar.  
 */
function elgg_get_messageboard($options) {
    $consulta = $options['query'];
    $entities = elgg_get_annotations($consulta);
    $options['entities'] = $entities;
    $consulta['count'] = true;
    $count = elgg_get_annotations($consulta);
    $retorno = elgg_view($options['view'], $options);
    if ($options['new_post']) {
        $options['query']['count'] = $count;
        $retorno.=elgg_get_continuable($options['query']);
    }
    return $retorno;
}

/**
 * Imprime en pantalla la opcion de ver mas Post en el muro de un grupo
 * @param array $vars. Formato:
 *  ´                       'limit'=> int cantidad de elementos que se muestra en pantalla
 *                          'offset'=> int numero apartir del cual se listan las entidades
 * @return String
 */
function elgg_get_continuable($vars) {
    $offset = $vars['limit'] + $vars['offset'];
    $grupo = $vars['guid'];
    $pag = "";
    if ($offset < $vars['count']) {
        $pag = "<div class='ver-mas'><a id='ver-mas' tittle='$offset' name='$grupo'>Ver mas</a></div>";
    }
    return $pag;
}

/**
 * Imprime en pantalla los comentarios de un post en el muro
 * @param array $options Consulta
 * @return String
 */
function elgg_get_comments_post($options) {
    $entities = elgg_get_annotations_to_annotations($options["query"]);
    $options['entities'] = $entities;
    return elgg_view($options['view'], $options);
}

/**
 * Permite agregar un comentario a un post
 * @param type $poster Usuario que deja el comentario
 * @param ElggAnnotation $owner Post al que se le hace comentario
 * @param type $message $ contenido del comentario
 * @param type $access_id nivel de acceso del comentario
 * @return boolean si se pudo realizar o no la operación
 */
function add_messageboard_comment($poster, ElggAnnotation $owner, $message, $access_id = ACCESS_PUBLIC) {
    $result = $owner->annotate('comment_messageboard', $message, $access_id, $poster->guid);
    if (!$result) {
        return false;
    }

    add_to_river('river/object/messageboard/create', 'messageboard', $poster->guid, $owner->id, $access_id, 0, $result);

    // only send notification if not self
    if ($poster->guid != $owner->id) {
        $subject = elgg_echo('messageboard:email:subject');
        $body = elgg_echo('messageboard:email:body', array(
            $poster->name,
            $message,
            elgg_get_site_url() . "messageboard/" . $owner->username,
            $poster->name,
        ));

        notify_user($owner->id, $poster->guid, $subject, $body);
    }

    return $result;
}

/* * Tomado de la libreria groups.php del plugin groups para cargar los valores que tiene el grupo y enviarlos al formulario 
 * que edita */

function grupo_investigacion_prepare_form_vars($group = null) {
    $values = array(
        'name' => '',
        'membership' => ACCESS_PUBLIC,
        'vis' => ACCESS_PUBLIC,
        'guid' => null,
        'entity' => null
    );

    // handle customizable profile fields
    $fields = elgg_get_config('group');

    if ($fields) {
        foreach ($fields as $name => $type) {
            $values[$name] = '';
        }
    }

    // handle tool options
    $tools = elgg_get_config('group_tool_options');
    if ($tools) {
        foreach ($tools as $group_option) {
            $option_name = $group_option->name . "_enable";
            $values[$option_name] = $group_option->default_on ? 'yes' : 'no';
        }
    }

    // get current group settings
    if ($group) {
        foreach (array_keys($values) as $field) {
            if (isset($group->$field)) {
                $values[$field] = $group->$field;
            }
        }

        if ($group->access_id != ACCESS_PUBLIC && $group->access_id != ACCESS_LOGGED_IN) {
            // group only access - this is done to handle access not created when group is created
            $values['vis'] = ACCESS_PRIVATE;
        } else {
            $values['vis'] = $group->access_id;
        }

        $values['entity'] = $group;
    }

    // get any sticky form settings
    if (elgg_is_sticky_form('groups')) {
        $sticky_values = elgg_get_sticky_values('groups');
        foreach ($sticky_values as $key => $value) {
            $values[$key] = $value;
        }
    }

    elgg_clear_sticky_form('groups');

    return $values;
}

/**
 * Returns an array of either ElggAnnotation or ElggMetadata objects.
 * Accepts all elgg_get_entities() options for entity restraints.
 *
 * @see elgg_get_entities
 *
 * @param array $options Array in format:
 *
 * 	metastring_names              => NULL|ARR metastring names
 *
 * 	metastring_values             => NULL|ARR metastring values
 *
 * 	metastring_ids                => NULL|ARR metastring ids
 *
 * 	metastring_case_sensitive     => BOOL     Overall Case sensitive
 *
 *  metastring_owner_guids        => NULL|ARR Guids for metadata owners
 *
 *  metastring_created_time_lower => INT      Lower limit for created time.
 *
 *  metastring_created_time_upper => INT      Upper limit for created time.
 *
 *  metastring_calculation        => STR      Perform the MySQL function on the metastring values
 *                                            returned.
 *                                            This differs from egef_annotation_calculation in that
 *                                            it returns only the calculation of all annotation values.
 *                                            You can sum, avg, count, etc. egef_annotation_calculation()
 *                                            returns ElggEntities ordered by a calculation on their
 *                                            annotation values.
 *
 *  metastring_type               => STR      metadata or annotation(s)
 *
 * @return mixed
 * @access private
 */
function elgg_get_metastring_based_objects_to_annotations($options) {
    $options = elgg_normalize_metastrings_options($options);

    switch ($options['metastring_type']) {
        case 'metadata':
            $type = 'metadata';
            $callback = 'row_to_elggmetadata';
            break;

        case 'annotations':
        case 'annotation':
            $type = 'annotations';
            $callback = 'row_to_elggannotation';
            break;

        default:
            return false;
    }

    $defaults = array(
        // entities
        'types' => ELGG_ENTITIES_ANY_VALUE,
        'subtypes' => ELGG_ENTITIES_ANY_VALUE,
        'type_subtype_pairs' => ELGG_ENTITIES_ANY_VALUE,
        'guids' => ELGG_ENTITIES_ANY_VALUE,
        'owner_guids' => ELGG_ENTITIES_ANY_VALUE,
        'container_guids' => ELGG_ENTITIES_ANY_VALUE,
        'site_guids' => get_config('site_guid'),
        'modified_time_lower' => ELGG_ENTITIES_ANY_VALUE,
        'modified_time_upper' => ELGG_ENTITIES_ANY_VALUE,
        'created_time_lower' => ELGG_ENTITIES_ANY_VALUE,
        'created_time_upper' => ELGG_ENTITIES_ANY_VALUE,
        // options are normalized to the plural in case we ever add support for them.
        'metastring_names' => ELGG_ENTITIES_ANY_VALUE,
        'metastring_values' => ELGG_ENTITIES_ANY_VALUE,
        //'metastring_name_value_pairs'				=>	ELGG_ENTITIES_ANY_VALUE,
        //'metastring_name_value_pairs_operator'	=>	'AND',
        'metastring_case_sensitive' => TRUE,
        //'order_by_metastring'						=>	array(),
        'metastring_calculation' => ELGG_ENTITIES_NO_VALUE,
        'metastring_created_time_lower' => ELGG_ENTITIES_ANY_VALUE,
        'metastring_created_time_upper' => ELGG_ENTITIES_ANY_VALUE,
        'metastring_owner_guids' => ELGG_ENTITIES_ANY_VALUE,
        'metastring_ids' => ELGG_ENTITIES_ANY_VALUE,
        // sql
        'order_by' => 'n_table.time_created asc',
        'limit' => 10,
        'offset' => 0,
        'count' => FALSE,
        'selects' => array(),
        'wheres' => array(),
        'joins' => array(),
        'callback' => $callback
    );

    // @todo Ignore site_guid right now because of #2910
    $options['site_guid'] = ELGG_ENTITIES_ANY_VALUE;

    $options = array_merge($defaults, $options);

    // can't use helper function with type_subtype_pair because
    // it's already an array...just need to merge it
    if (isset($options['type_subtype_pair'])) {
        if (isset($options['type_subtype_pairs'])) {
            $options['type_subtype_pairs'] = array_merge($options['type_subtype_pairs'], $options['type_subtype_pair']);
        } else {
            $options['type_subtype_pairs'] = $options['type_subtype_pair'];
        }
    }

    $singulars = array(
        'type', 'subtype', 'type_subtype_pair',
        'guid', 'owner_guid', 'container_guid', 'site_guid',
        'metastring_name', 'metastring_value',
        'metastring_owner_guid', 'metastring_id',
        'select', 'where', 'join'
    );

    $options = elgg_normalise_plural_options_array($options, $singulars);

    if (!$options) {
        return false;
    }

    $db_prefix = elgg_get_config('dbprefix');

    // evaluate where clauses
    if (!is_array($options['wheres'])) {
        $options['wheres'] = array($options['wheres']);
    }

    $wheres = $options['wheres'];

    // entities
    $wheres[] = elgg_get_entity_type_subtype_where_sql('e', $options['types'], $options['subtypes'], $options['type_subtype_pairs']);

    $wheres[] = elgg_get_guid_based_where_sql('e.guid', $options['guids']);
    $wheres[] = elgg_get_guid_based_where_sql('e.owner_guid', $options['owner_guids']);
    $wheres[] = elgg_get_guid_based_where_sql('e.container_guid', $options['container_guids']);
    $wheres[] = elgg_get_guid_based_where_sql('e.site_guid', $options['site_guids']);

    $wheres[] = elgg_get_entity_time_where_sql('e', $options['created_time_upper'], $options['created_time_lower'], $options['modified_time_upper'], $options['modified_time_lower']);


    $wheres[] = elgg_get_entity_time_where_sql('n_table', $options['metastring_created_time_upper'], $options['metastring_created_time_lower'], null, null);

    $wheres[] = elgg_get_guid_based_where_sql('n_table.owner_guid', $options['metastring_owner_guids']);

    // see if any functions failed
    // remove empty strings on successful functions
    foreach ($wheres as $i => $where) {
        if ($where === FALSE) {
            return FALSE;
        } elseif (empty($where)) {
            unset($wheres[$i]);
        }
    }

    // remove identical where clauses
    $wheres = array_unique($wheres);

    // evaluate join clauses
    if (!is_array($options['joins'])) {
        $options['joins'] = array($options['joins']);
    }

    $joins = $options['joins'];
    $joins[] = "JOIN {$db_prefix}entities e";

    // evaluate selects
    if (!is_array($options['selects'])) {
        $options['selects'] = array($options['selects']);
    }

    $selects = $options['selects'];

    // For performance reasons we don't want the joins required for metadata / annotations
    // unless we're going through one of their callbacks.
    // this means we expect the functions passing different callbacks to pass their required joins.
    // If we're doing a calculation
    $custom_callback = ($options['callback'] == 'row_to_elggmetadata' || $options['callback'] == 'row_to_elggannotation');
    $is_calculation = $options['metastring_calculation'] ? true : false;

    if ($custom_callback || $is_calculation) {
        $joins[] = "JOIN {$db_prefix}metastrings n on n_table.name_id = n.id";
        $joins[] = "JOIN {$db_prefix}metastrings v on n_table.value_id = v.id";

        $selects[] = 'n.string as name';
        $selects[] = 'v.string as value';
    }

    foreach ($joins as $i => $join) {
        if ($join === FALSE) {
            return FALSE;
        } elseif (empty($join)) {
            unset($joins[$i]);
        }
    }

    // metastrings
    $metastring_clauses = elgg_get_metastring_sql('n_table', $options['metastring_names'], $options['metastring_values'], null, $options['metastring_ids'], $options['metastring_case_sensitive']);

    if ($metastring_clauses) {
        $wheres = array_merge($wheres, $metastring_clauses['wheres']);
        $joins = array_merge($joins, $metastring_clauses['joins']);
    } else {
        $wheres[] = get_access_sql_suffix('n_table');
    }

    if ($options['metastring_calculation'] === ELGG_ENTITIES_NO_VALUE && !$options['count']) {
        $selects = array_unique($selects);
        // evalutate selects
        $select_str = '';
        if ($selects) {
            foreach ($selects as $select) {
                $select_str .= ", $select";
            }
        }

        $query = "SELECT DISTINCT n_table.*{$select_str} FROM {$db_prefix}$type n_table";
    } elseif ($options['count']) {
        // count is over the entities
        $query = "SELECT count(DISTINCT e.guid) as calculation FROM {$db_prefix}$type n_table";
    } else {
        $query = "SELECT {$options['metastring_calculation']}(v.string) as calculation FROM {$db_prefix}$type n_table";
    }

    // remove identical join clauses
    $joins = array_unique($joins);

    // add joins
    foreach ($joins as $j) {
        $query .= " $j ";
    }

    // add wheres
    $query .= ' WHERE ';

    foreach ($wheres as $w) {
        $query .= " $w AND ";
    }

    // Add access controls
    $query .= get_access_sql_suffix('e');

    // reverse order by
    if (isset($options['reverse_order_by']) && $options['reverse_order_by']) {
        $options['order_by'] = elgg_sql_reverse_order_by_clause($options['order_by'], $defaults['order_by']);
    }

    if ($options['metastring_calculation'] === ELGG_ENTITIES_NO_VALUE && !$options['count']) {
        if (isset($options['group_by'])) {
            $options['group_by'] = sanitise_string($options['group_by']);
            $query .= " GROUP BY {$options['group_by']}";
        }

        if (isset($options['order_by']) && $options['order_by']) {
            $options['order_by'] = sanitise_string($options['order_by']);
            $query .= " ORDER BY {$options['order_by']}, n_table.id";
        }

        if ($options['limit']) {
            $limit = sanitise_int($options['limit']);
            $offset = sanitise_int($options['offset'], false);
            $query .= " LIMIT $offset, $limit";
        }

        $dt = get_data($query, $options['callback']);
        return $dt;
    } else {
        $result = get_data_row($query);
        return $result->calculation;
    }
}

/**
 * Permite obtener anotaciones de anotaciones
 * @param array $options
 * @return type
 */
function elgg_get_annotations_to_annotations(array $options = array()) {

    // @todo remove support for count shortcut - see #4393
    if (isset($options['__egefac']) && $options['__egefac']) {
        unset($options['__egefac']);
    } else {
        // support shortcut of 'count' => true for 'annotation_calculation' => 'count'
        if (isset($options['count']) && $options['count']) {
            $options['annotation_calculation'] = 'count';
            unset($options['count']);
        }
    }

    $options['metastring_type'] = 'annotations';
    return elgg_get_metastring_based_objects_to_annotations($options);
}

/**
 * Permite obtener una lista paginable de los miembros del grupo
 * @param int $guid guid del grupo
 * @param int $limit cantidad de elementos que se desea obtener
 * @param int $offset número a partir del cual se desea que se liste los grupos de Investigación
 */
function elgg_get_lista_miembros($guid, $limit, $offset) {
    $query = array('type' => 'group', 'subtype' => 'grupo_investigacion');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'grupo_investigacion/miembros/lista/lista_miembros',
        'guid' => $guid);
    $content = elgg_list_paginable_entities_relationships($options);
    echo $content;
}

/**
 * Función que imprime en pantalla un listado paginable de las iniciativas de investigación pertenecientes a un grupo de investigación,
 * de acuerdo a los parámetros recibidos
 * @param type $limit - cantidad de elementos que se desea obtener
 * @param type $offset - número a partir del cual se desea que se listen las iniciativas de investigación
 * @param type $grupo - id del grupo de investigación para el que se van a listar las iniciativas de investigación
 */
function elgg_get_list_cuadernos_grupo($limit, $offset, $grupo) {
    $query = array('type' => 'group', 'subtype' => 'cuaderno_campo');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'cuaderno_campo/lista/lista_cuadernos', 'guid' => $grupo, 'relacion' => 'tiene_cuaderno_campo');
    $content = elgg_list_paginable_entities_relationships($options);
    echo $content;
}

/**
 * Función que imprime en pantalla un listado paginable de las investigaciones pertenecientes a un grupo de investigación,
 * de acuerdo a los parámetros recibidos
 * @param type $limit - cantidad de elementos que se desea obtener
 * @param type $offset - número a partir del cual se desea que se listen las investigaciones
 * @param type $grupo - id del grupo de investigación para el que se van a listar las iniciativas de investigación
 */
function elgg_get_list_investigaciones_grupo($limit, $offset, $grupo) {
    $query = array('type' => 'group', 'subtype' => 'investigacion');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'investigacion/lista/lista_investigaciones', 'guid' => $grupo, 'relacion' => 'tiene_la_investigacion');
    $content = elgg_list_paginable_entities_relationships($options);
    echo $content;
}

/**
 * Permite obtener una lista paginable con ajax de entidades de acuerdo a una relacion dada
 * @param array $options. Formato:
 *                      'query'=> String con la consulta,
 *                      'limit'=> int con la cantidad de elementos que se desea obtener
 *                      'offset'=> número a partir del cual se desea que se liste las entidades
 *                      'view'=> Vista que se va a mostrar
 *                      'guid'=> Id de la entidad dueña de la relación
 *                      'relacion'=> nombre de la relación a buscar
 *                      'inverse'=>TRUE|FALSE indicando si la busqueda es de una relación inversa    
 */
function elgg_list_paginable_entities_relationships($options) {

    $consulta = $options['query'];
    $consulta['limit'] = $options['limit'];
    $consulta['offset'] = $options['offset'];
    $consulta['relationship_guid'] = $options['guid'];
    $consulta['relationship'] = $options['relacion'];
    if (!$options['inverse']) {
        $options['inverse'] = false;
    }
    $consulta['inverse_relationship'] = $options['inverse'];
    $entities = elgg_get_entities_from_relationship($consulta);
    $options['entities'] = $entities;

    $consulta['count'] = true;
    $count = elgg_get_entities_from_relationship($consulta);
    $options['total'] = $count;
//    if($options['guid_entity']!=NULL){
//        $options['entities'] = elgg_investigaciones_entity($entities, $options['guid_entity']);
//        $options['total'] = sizeof($options['entities']);
//    }


    echo elgg_view($options['view'], $options);
    elgg_get_pagination($options);
}

/**
 * Metodo que permite buscar los integrantes registrados en un grupo de investigacion para despues listarlos
 * @param String $id_grupo
 * @param type $id_cuad- Id del cuaderno
 * @param type $clave- Caracteres ingresados en el cuadro de texto de busqueda
 * @return array Integrantes del grupo que coincidieron con el valor ingresado
 */
function elgg_buscar_integrantes_grupo($id_grupo, $id_cuad, $clave) {

    $grupo = new ElggGrupoInvestigacion($id_grupo);
    $integ_grupo = $grupo->getEntitiesFromRelationship('es_miembro_de', true);


    $cuaderno = new ElggCuadernoCampo($id_cuad);
    $integ_cuad = $cuaderno->getEntitiesFromRelationship('hace_parte_de', true);

    $all = elgg_get_all_usuarios_like($clave);
    $nuevos = array();
    foreach ($all as $user) {

        if ($user->getSubtype() == 'estudiante') {
            if (in_array($user, $integ_grupo) && !in_array($user, $integ_cuad)) {
                $us = array('id_usuario' => $user->guid, 'nombres_usuario' => $user->name, 'apellidos_usuario' => $user->apellidos);
                array_push($nuevos, $us);
            }
        }
    }
    return $nuevos;
}

/**
 * Metodo que permite buscar los maestros registrados en un grupo de investigacion para despues listarlos
 * @param String $id_grupo
 * @param type $id_cuad- Id del cuaderno
 * @param type $clave- Caracteres ingresados en el cuadro de texto de busqueda
 * @return array- Maestros del grupo que coincidieron con el valor ingresado
 */
function elgg_buscar_maestros($id_grupo, $id_cuad, $clave) {

    $grupo = new ElggGrupoInvestigacion($id_grupo);
    $integ_grupo = $grupo->getEntitiesFromRelationship('es_miembro_de', true);
    $admin = $grupo->getEntitiesFromRelationship('administrador', true);

    $cuaderno = new ElggCuadernoCampo($id_cuad);
    $colaborador_cuad = $cuaderno->getEntitiesFromRelationship('es_colaborador_de', true);

    $all = elgg_get_all_usuarios_like($clave);
    $nuevos = array();
    foreach ($all as $user) {

        if ($user->getSubtype() == 'maestro') {
            if ((in_array($user, $integ_grupo) || in_array($user, $admin)) && !in_array($user, $colaborador_cuad)) {
                $us = array('id_usuario' => $user->guid, 'nombres_usuario' => $user->name, 'apellidos_usuario' => $user->apellidos, 'especialidad' => $user->especialidad);
                array_push($nuevos, $us);
            }
        }
    }
    return $nuevos;
}

/**
 * Metodo que permite listar los integrantes de un cuaderno o de una Investigacion
 * @param String $id- Id del cuaderno o de la Investigación
 * @param type $tipo- false si es para listar los integrantes de un cuaderno/ true para listar integrantes de la investigacion
 * @return array Integrantes del grupo que coincidieron con el valor ingresado
 */
function elgg_listar_integrantes_cuaderno($id, $tipo) {

    if ($tipo = "false") {
        $cuaderno = new ElggCuadernoCampo($id);
        $integrantes = $cuaderno->getEntitiesFromRelationship('hace_parte_de', true);
    } else {
        $investigacion = new ElggInvestigacion($id);
        $integrantes = $investigacion->getEntitiesFromRelationship('hace_parte_de', true);
    }

    $listado = array();
    foreach ($integrantes as $user) {

        //calcular la edad
        $fecha = $user->fecha_nacimiento;
        list($Y, $m, $d) = explode("-", $fecha);
        $edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );

        $integ = array('id' => $user->guid, 'nombre' => $user->name, 'apellidos' => $user->apellidos, 'sexo' => $user->sexo, 'curso' => $user->curso, 'edad' => $edad, 'email' => $user->email, 'username' => $user->username, 'icono' => $user->getIconURL());
        array_push($listado, $integ);
    }
    return $listado;
}

/**
 * Metodo que permite listar los maestros de un cuaderno o de una Investigacion
 * @param String $id- Id del cuaderno o de la Investigación
 * @param type $tipo- false si es para listar los maestros de un cuaderno/true para listar los maestros de una investigacion
 * @return array Maestros del grupo que coincidieron con el valor ingresado
 */
function elgg_listar_maestros_cuaderno($id, $tipo) {


    if ($tipo = "false") {
        $cuaderno = new ElggCuadernoCampo($id);
        $maestros = $cuaderno->getEntitiesFromRelationship('es_colaborador_de', true);
    } else {
        $investigacion = new ElggInvestigacion($id);
        $maestros = $investigacion->getEntitiesFromRelationship('es_colaborador_de', true);
    }



    $listado = array();
    foreach ($maestros as $user) {
        $integ = array('id' => $user->guid, 'nombre' => $user->name, 'apellidos' => $user->apellidos, 'sexo' => $user->sexo, 'email' => $user->email, 'especialidad' => $user->especialidad, 'area' => $user->area_conocimiento, 'username' => $user->username, 'icono' => $user->getIconURL());
        array_push($listado, $integ);
    }
    return $listado;
}

/**
 * Permite obtener un JSON con la información de un evento. Formato(Calendar)
 * @param int $guid_grupo. Guid del grupo de investigación
 * @return String. JSON con la información del evento
 */
function elgg_get_json_eventos($guid_grupo) {
    $retorno = array();
    $eventos = elgg_get_eventos_grupo($guid_grupo);
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

function elgg_get_json_eventos_red($red) {
    $retorno = array();
    $eventos = elgg_get_eventos_red($red);
    foreach ($eventos as $evento) {
        $eve = array();
        $eve['id'] = $evento->guid;
        $eve['title'] = "Jornada de Asesoria";
        $eve['start'] = $evento->fecha;
        $eve['end'] = $evento->fecha;
        array_push($retorno, $eve);
    }
    return json_encode($retorno);
}

/**
 * Permite obtener un JSON con la información de un evento y de una asesoria. Formato(Calendar)
 * @param int $guid_grupo. Guid de la investigación
 * @return String. JSON con la información del evento
 */
function elgg_get_json_asesorias($guid) {
    $retorno = array();

    $options = array('type' => 'object',
        'subtype' => 'asesoria',
        'container_guid' => $guid);

    $eventos1 = elgg_get_entities($options);


    $eventos2 = elgg_get_eventos_grupo($guid);


    foreach ($eventos1 as $evento) {
        $eve = array();
        $eve['id'] = $evento->guid;
        $eve['title'] = $evento->title;
        $eve['start'] = $evento->fecha;
        $eve['color'] = "rgb(177,63,114)";

        array_push($retorno, $eve);
    }


    foreach ($eventos2 as $evento) {
        $eve = array();
        $eve['id'] = $evento->guid;
        $eve['title'] = $evento->nombre_evento;
        $eve['start'] = $evento->fecha_inicio;
        $eve['color'] = "rgb(145,216,247)";

        array_push($retorno, $eve);
    }

    return json_encode($retorno);
}

/**
 * Obtiene los eventos de un grupo de investigación
 * @param int $guid_grupo guid del grupo de investigación
 * @return array entities tipo grupo
 */
function elgg_get_eventos_grupo($guid_grupo) {
    $options = array('type' => 'object',
        'subtype' => 'evento',
        'container_guid' => $guid_grupo);
    $eventos = elgg_get_entities($options);
    return $eventos;
}

function elgg_get_eventos_red($red) {
    $options = array('type' => 'object',
        'subtype' => 'asesoria_red',
        'owner_guid' => $red);
    $eventos = elgg_get_entities($options);
    return $eventos;
}

function elgg_get_pregunta_investigacion($id_cuaderno) {
    $options = array(
        'type' => 'object',
        'relationship' => 'tiene_la_bitacora',
        'relationship_guid' => $id_cuaderno,
    );

    $preguntas = elgg_get_entities_from_relationship($options);

    $bitacora2 = null;
    foreach ($preguntas as $pre) {
        if ($pre->description == '2') {
            $bitacora2 = $pre;
        }
    }

    if ($bitacora2 != NULL) {

        return strip_tags($bitacora2->pregunta_seleccionada);
    }

    return false;
}

/**
 * Función que verifica el problema de investigación en la bitacora 3 de una investigacion
 * @param type $id_inv -> identificador del grupo de investigación
 * @return boolean|String -> false-si no encuentra | valor del problema de investigación
 */
function elgg_get_problema_investigacion($id_inv) {
    $options = array(
        'type' => 'object',
        'relationship' => 'tiene_la_bitacora',
        'relationship_guid' => $id_inv,
    );

    $preguntas = elgg_get_entities_from_relationship($options);

    $bitacora3 = null;
    foreach ($preguntas as $pre) {
        if ($pre->description == '3') {
            $bitacora3 = $pre;
        }
    }

    if ($bitacora3 != NULL) {

        return strip_tags($bitacora3->descripcion_problema);
    }

    return false;
}

/**
 * Permite obtener el diario de campo de un cuaderno o investigacion
 * @param type $guid /
 */
function elgg_get_diario_campo($guid) {


    $db_prefix = get_config('dbprefix');
    $options = array(
        'type' => 'object',
        'subtype' => 'diario_campo',
        'owner_guid' => $guid,
    );

    $diario = elgg_get_entities_from_metadata($options);

    return $diario[0];
}

/**
 * Permite obtener el cuaderno de Notas de un cuaderno o investigacion
 * @param type $user Usuario Logueado
 * @param type $guid /
 */
function elgg_get_cuaderno_nota($user, $guid) {


    $db_prefix = get_config('dbprefix');
    $options = array(
        'type' => 'object',
        'subtype' => 'cuaderno_nota',
        'owner_guid' => $guid,
        'container_guid' => $user,
    );

    $cuaderno_nota = elgg_get_entities_from_metadata($options);

    return $cuaderno_nota[0];
}

/**
 * Permite obtener la libreta de acompañante de un cuaderno o investigacion
 * @param type $user Usuario Logueado
 * @param type $guid /
 */
function elgg_get_libreta_acompanante($user, $guid) {


    $db_prefix = get_config('dbprefix');
    $options = array(
        'type' => 'object',
        'subtype' => 'libreta_acompanante',
        'owner_guid' => $guid,
        'container_guid' => $user,
    );

    $libreta_acompanante = elgg_get_entities_from_metadata($options);

    return $libreta_acompanante[0];
}
