<?php

/**
 * Verifica si exite un rol con un nombre en el sistema
 * @param String $titulo nombre del rol
 * @return boolean
 */
function elgg_existe_rol($titulo) {
    $db_prefix = get_config('dbprefix');
    $options = array(
        'type' => 'object',
        'subtype' => 'rol',
        'joins' => array("JOIN {$db_prefix}objects_entity ob on ob.guid = e.guid"),
        'wheres' => array("ob.title = '$titulo'"),
    );
    $roles = elgg_get_entities_from_metadata($options);
    if ($roles) {
        return true;
    }
    return false;
}

/**
 * Obteniene la lista de roles del sistema
 * @return array informacion de los roles
 */
function elgg_get_list_roles() {
    $options = array(
        'type' => 'object',
        'subtype' => 'rol',
    );
    $roles = elgg_get_entities($options);
    $retorno = array();
    foreach ($roles as $rol) {
        $url = elgg_get_site_url() . "action/admin/roles/eliminar?id=" . $rol->guid;
        $url_eliminar = elgg_add_action_tokens_to_url($url);
        $datos_rol = array('guid' => $rol->guid,
            'nombre' => $rol->title,
            'descripcion' => $rol->description,
            'href' => $url_eliminar
        );
        $nombre = $rol->title;
        if ($nombre != "SuperAdmin") {
            array_push($retorno, $datos_rol);
        }
    }
    return $retorno;
}

/**
 * Asigna un rol a usuario
 * @param int $id_rol guid del rol
 * @param int $guid guid del usuario
 * @return boolean Si se pudo o no asignar el rol al usuario
 */
function elgg_asignar_rol_usuario($id_rol, $guid) {
    $rol = new ElggRol($id_rol);
    $usuario = elgg_get_usuario_byId($guid);
    if (!$guid) {
        return false;
    }
    $user = new ElggUser($usuario['guid']);
    return $user->addRelationship($rol->guid, "Tiene_el_rol_de");
}

/**
 * Asigna el rol a un nuevo usuario
 * @param int $guidUser guid del usuario 
 * @param String $rol nombre del rol que se va asignar
 * @return boolean si el rol se pudo asignar o no al asuario
 */
function elgg_asignar_rol_new_usuario($guidUser, $rol) {
    $aux = elgg_get_rol_by_name($rol);
    return elgg_asignar_rol_usuario($aux->guid, $guidUser);
}

/**
 * Permite obtener los roles de un usuario
 * @param int $guid guid del usuario
 * @return array Formato. 'nombre'=> nombre del rol
 *                        'guid'=> guid del rol  
 *  */
function elgg_get_roles_usuario($user) {
    $options = array('relationship' => 'Tiene_el_rol_de',
        'relationship_guid' => $user,);
    $roles = elgg_get_entities_from_relationship($options);
    $retorno = array();
    foreach ($roles as $rol) {
        array_push($retorno, array(
            'nombre' => $rol->title,
            'guid' => $rol->guid));
    }
    $grupo_asesores = elgg_get_grupo_asesores();
    if (check_entity_relationship($user, 'asesor', $grupo_asesores->guid)) {
        array_push($retorno, array(
            'nombre' => "asesor"));
    }
    $grupo_evaluadores = elgg_get_grupo_evaluadores();
    if (check_entity_relationship($user, "member", $grupo_evaluadores->guid)) {
        array_push($retorno, array(
            'nombre' => "evaluador"));
    }

    return $retorno;
}

/**
 * Permite desasignar un rol a un usuario
 * @param int $id_rol guid del rol a desaignar
 * @param int $guid guid del usuario
 * @return boolean. Si se realizo o no la operación de manera correcta
 */
function elgg_desasignar_rol_usuario($id_rol, $guid) {
    $rol = new ElggRol($id_rol);
    $usuario = elgg_get_usuario_byId($guid);
    $user = new ElggUser($usuario['guid']);
    return $user->removeRelationship($rol->guid, "Tiene_el_rol_de");
}

/**
 * Consulta los usuarios filtrados por su nombre
 * @param String $nombre
 * @return array. Formato: 'guid'=> guid del usuario,
 *                         'nombre'=>  Nombre del usuario,
 *                         'icono' =>  Imagen de perfil del usuario  
 */
function elgg_get_usuarios_by_nombre($nombre) {
    $usuarios = elgg_get_all_usuarios_like($nombre);
    $todos = array();
    foreach ($usuarios as $usuario) {
        array_push($todos, array(
            'guid' => $usuario->guid,
            'nombre' => $usuario->name . " " . $usuario->apellidos,
            'icono' => $usuario->getIconURL(),
        ));
    }

    return $todos;
}

/**
 * Obtiene un rol por nombre
 * @param String  $name nombre del rol a consultar
 * @return Entity entidad de tipo rol
 */
function elgg_get_rol_by_name($name = '') {
    $db_prefix = get_config('dbprefix');
    if ($name === '') {
        return elgg_get_list_roles();
    }
    $options = array(
        'type' => 'object',
        'subtype' => 'rol',
        'joins' => array("JOIN {$db_prefix}objects_entity ob on ob.guid = e.guid"),
        'wheres' => array("ob.title = '$name'"),
    );
    $lista = elgg_get_entities_from_metadata($options);
    return $lista[0];
}

/**
 * Obtener un usuario por id
 * @param int $guid guid del usuario
 * @return array Datos del usuario. Formato: 'nombre'=> Nombre del usuario,
 *                                           'apellidos' => apellidos del usuario,
 *                                          'guid'=> Guid del usuario   
 */
function elgg_get_usuario_by_ID($guid) {
    $usuario = elgg_get_usuario_byId($guid);
    $user = array("nombre" => $usuario->name,
        "apellidos" => $usuario->apellidos,
        "guid" => $usuario->guid);
    return $user;
}

/**
 * Verifica si un usuario logueado en la sesión tiene asignado un rol
 * @param String $rol nombre del rol a consultar
 * @return boolean
 */
function elgg_is_rol_logged_user($rol) {
    $roles = $_SESSION['roles'];
    if ($roles) {
        foreach ($roles as $aux) {
            if ($rol == $aux) {
                return true;
            }
        }
    }
    return false;
}

function elgg_get_grupo_asesores() {
    $db_prefix = get_config('dbprefix');
    $options = array(
        'type' => 'group',
        'joins' => array("JOIN {$db_prefix}groups_entity us on us.guid = e.guid"),
        'wheres' => array("us.name= 'asesores'"),
    );
    $asesores = elgg_get_entities_from_metadata($options);
    return $asesores[0];
}
