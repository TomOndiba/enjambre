<?php

/**
 * Verifica si existe una Red Tematica con un nombre
 * @param String $nombre nombre de la Red Temática
 * @return boolean 
 */
function elgg_existe_red($nombre) {
    $db_prefix = get_config('dbprefix');
    $opt = array(
        'type' => 'group',
        'subtype' => 'red_tematica',
        'joins' => array("JOIN {$db_prefix}groups_entity ge on ge.guid = e.guid"),
        'wheres' => array("ge.name = '$nombre'"),
    );

    $red = elgg_get_entities($opt);
    if ($red) {
        return true;
    }
    return false;
}


/**
 * Permite obtener una lista de redes tematicas
 * @param int $limit cantidad de elementos que se desea obtener
 * @param int $offset número a partir del cual se desea que se liste las redes tematicas
 */
function elgg_get_list_redes_tematicas($limit, $offset) {
    $query = array('type' => 'group', 'subtype' => 'red_tematica');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'redes_tematicas/lista/lista_redes_tematicas');
    $content = elgg_list_paginable_entities($options);
    echo $content;
}

/**
 * Permite obtener una lista de archivos de la Red
 * @param int $limit cantidad de elementos que se desea obtener
 * @param int $offset número a partir del cual se desea que se liste 
 */
function elgg_get_archivos($limit, $offset, $guid, $categoria) {
        
    $query = array('type' => 'object', 'subtype' => 'file', 'container_guid'=>$guid, 'metadata_names'=>'categoria', 'metadata_values'=>$categoria);
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'archivos/lista_archivos', 'guid'=>$guid);
    $content = elgg_list_paginable_entities_metadata($options);
    echo $content;
}


function elgg_list_paginable_entities_metadata($options) {
    $consulta = $options['query'];
    
    $consulta['limit'] = $options['limit'];
    $consulta['offset'] = $options['offset'];
    $entities = elgg_get_entities_from_metadata($consulta);
    $options['entities'] = $entities;
    $consulta['count'] = true;
    $count = elgg_get_entities_from_metadata($consulta);
    $options['total'] = $count;
    echo elgg_view($options['view'], $options);
    elgg_get_pagination($options);
}

function elgg_list_paginable_entities_metadata_2($options) {
    $consulta = $options['query'];
    $consulta['limit'] = $options['limit'];
    $consulta['offset'] = $options['offset'];
    $entities = elgg_get_entities_from_metadata($consulta);
    $options['entities'] = $entities;
    $consulta['count'] = true;
    $count = elgg_get_entities_from_metadata($consulta);
    $options['total'] = $count;
    echo elgg_view($options['view'], $options);
    elgg_get_pagination($options);
}



/**
 * Permite obtener una lista de archivos filtrada por un nombre
 * @param int $limit cantidad de elementos que se desea obtener
 * @param int $offset numero apartir del cual se desea que se liste los archivos
 * @param String $busqueda. Consulta que se desea que coincida con el nombre del archivo
 * @param int $guid Guid delarchivo
 * @param String $categoria Categoria o tipo de archivo
 */
function elgg_get_archivos_nombre($limit, $offset, $busqueda, $guid,  $categoria) {
 
    
    $db_prefix = get_config('dbprefix');
    $query = array('type' => 'object',
        'subtype' => 'file',
        'container_guid'=>$guid,
        'metadata_names'=>'categoria',
        'metadata_values'=>$categoria,
        'joins' => array("JOIN {$db_prefix}objects_entity ge on ge.guid = e.guid"),
        'wheres' => array("ge.title  LIKE '%$busqueda%'"));

    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'archivos/lista_archivos', 'guid'=>$guid);
    $content = elgg_list_paginable_entities_metadata($options);
    echo $content;
}



/**
 * Permite obtener una lista de discusiones_foros de la Red
 * @param int $limit cantidad de elementos que se desea obtener
 * @param int $offset número a partir del cual se desea que se liste 
 * @param int $guid Guid entidad contenedora de la discusion
 */
function elgg_get_discusiones($limit, $offset, $guid) {
    $query = array('type' => 'object', 'subtype' => 'groupforumtopic', 'container_guid'=>$guid);
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'discusiones/lista_discusiones', 'guid'=>$guid);
    $content = elgg_list_paginable_entities($options);
    echo $content;
}


/**
 * Permite obtener una lista de discusiones filtrados por un nombre
 * @param int $limit cantidad de elementos que se desea obtener
 * @param int $offset numero apartir del cual se desea que se liste las discusiones
 * @param String $busqueda. Consulta que se desea que coincida con el nombre de la discusion
 * @param int $guid Guid de la discusion.
 */
function elgg_get_discusiones_nombre($limit, $offset, $busqueda, $guid) {
   
    $db_prefix = get_config('dbprefix');
    $query = array('type' => 'object',
        'subtype' => 'groupforumtopic',
        'container_guid'=>$guid,
        'joins' => array("JOIN {$db_prefix}objects_entity ge on ge.guid = e.guid"),
        'wheres' => array("ge.title  LIKE '%$busqueda%'"));

    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'discusiones/lista_discusiones', 'guid'=>$guid);
    $content = elgg_list_paginable_entities($options);
    echo $content;
}



/**
 * Permite obtener una lista de marcadores de la Red o Grupo
 * @param int $limit cantidad de elementos que se desea obtener
 * @param int $offset número a partir del cual se desea que se liste 
 * @param int $guid Guid entidad contenedora 
 */
function elgg_get_marcadores($limit, $offset, $guid) {
    $query = array('type' => 'object', 'subtype' => 'bookmarks', 'container_guid'=>$guid);
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'marcadores/lista_marcadores', 'guid'=>$guid);
    $content = elgg_list_paginable_entities($options);
    echo $content;
}

/**
 * Permite obtener una lista de marcadores filtrada por un nombre
 * @param int $limit cantidad de elementos que se desea obtener
 * @param int $offset numero apartir del cual se desea que se liste los marcadores
 * @param String $busqueda. Consulta que se desea que coincida con el nombre del marcador
 * @param int $guid Guid del marcador
 */
function elgg_get_marcadores_nombre($limit, $offset, $busqueda, $guid) {
   
    $db_prefix = get_config('dbprefix');
    $query = array('type' => 'object',
        'subtype' => 'bookmarks',
        'container_guid'=>$guid,
        'joins' => array("JOIN {$db_prefix}objects_entity ge on ge.guid = e.guid"),
        'wheres' => array("ge.title  LIKE '%$busqueda%'"));

    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'marcadores/lista_marcadores','guid'=>$guid);
    $content = elgg_list_paginable_entities($options);
    echo $content;
}



/**
 * Permite obtener una lista de las redes tematicas filtrada por un nombre
 * @param int $limit cantidad de elementos que se desea obtener
 * @param int $offset numero apartir del cual se desea que se liste las redes
 * @param String $busqueda. Consulta que se desea que coincida con el nombre de la Red Tematica
 */
function elgg_get_list_redes_tematicas_nombre($limit, $offset, $busqueda) {
    $db_prefix = get_config('dbprefix');
    $query = array('type' => 'group',
        'subtype' => 'red_tematica',
        'joins' => array("JOIN {$db_prefix}groups_entity ge on ge.guid = e.guid"),
        'wheres' => array("ge.name  LIKE '%$busqueda%'"));

    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'redes_tematicas/lista/lista_redes_tematicas');
    $content = elgg_list_paginable_entities($options);
    echo $content;
}


/* * Tomado de la libreria groups.php del plugin groups para cargar los valores que tiene la Red Tematica y enviarlos al formulario 
 * que edita */
function red_tematica_prepare_form_vars($group = null) {
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
 * Permite conocer si un usuario es administrador de una Red Tematica
 * @param int $red Guid de Red Tematica
 * @param int $user Guid Usuario
 * @return boolean 
 */
function elgg_is_admin_red($red, $user) {
    if (check_entity_relationship($user, "administrador", $red)) {
        return true;
    }
    return false;
}

/**
 * Permite conocer si un usuario es miembro de una Red Tematica
 * @param int $red Guid de Red Tematica
 * @param int $user Guid Usuario
 * @return boolean 
 */
function elgg_is_member_red($red, $user) {
    if (check_entity_relationship($user, "es_miembro_de", $red)) {
        return true;
    }
    return false;
}

/**
 * Permite conocer si un usuario esta en espera de ser aceptado en una Red Tematica
 * @param int $red Guid de Red Tematica
 * @param int $user Guid Usuario
 * @return boolean 
 */
function elgg_is_request_red($red, $user) {
    if (check_entity_relationship($user, "peticionUnirse", $red)) {
        return 1;
    }
}

/**
 * Permite conocer si un usuario es miembro o admininstrador en un grupo de investigacion
 * @param int $red Red Tematica
 * @param int $user Usuario 
 * @return string|boolean String con el rol del usuario 
 */
function elgg_is_miembro_en_red_tematica($red, $user) {
    if (elgg_is_admin_red($red, $user)) {
        return "admin";
    } else if (elgg_is_member_red($red, $user)) {
        return "leer";
    } else {
        return false;
    }
}




/**
 * Permite listar los usuarios con solicitud de unirse a una Red Tematica
 * @param int $guid Guid de la Red Tematica
 * @return array de lista de miembros: Formato:
 *                                           'nombre'=> Nombre del usuario
 *                                           'href_a'=> Url para aceptar al usuario
 *                                           'href_r'=> Url de action para rechazar al usuario
 *                                           'imagen'=> url de la imagen del perfil del usuario      
 */
function elgg_listar_solicitud_miembro_red($guid) {

    $red_tematica = new ElggRedTematica($guid);
    $miembros = $red_tematica->getEntitiesFromRelationship("peticionUnirse", true);
    $listado = array();
    
    foreach ($miembros as $miembro) {
        $acepta = elgg_get_site_url() . "action/redes_tematicas/miembro_red?id=" . $guid . "&id_miembro=" . $miembro->guid . "&acepta=true";
        $rechaza = elgg_get_site_url(). "action/redes_tematicas/miembro_red?id=" . $guid . "&id_miembro=" . $miembro->guid . "&acepta=false";
        $url_acepta = elgg_add_action_tokens_to_url($acepta);
        $url_rechaza = elgg_add_action_tokens_to_url($rechaza);

        $m = array('nombre' => $miembro->name, 'href_a' => $url_acepta, 'href_r' => $url_rechaza, 'imagen' => $miembro->getIconURL(), 'profile' => $miembro->getURL());
        array_push($listado, $m);
    }
    return $listado;
}


/**
 * tomado del Start de Groups
 * Prepare discussion topic form variables
 *
 * @param ElggObject $topic Topic object if editing
 * @return array
 */
function discussiones_prepare_form_vars($topic = NULL) {
	// input names => defaults
	$values = array(
		'title' => '',
		'description' => '',
		'status' => '',
		'access_id' => ACCESS_DEFAULT,
		'tags' => '',
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $topic,
	);

	if ($topic) {
		foreach (array_keys($values) as $field) {
			if (isset($topic->$field)) {
				$values[$field] = $topic->$field;
			}
		}
	}

	if (elgg_is_sticky_form('topic')) {
		$sticky_values = elgg_get_sticky_values('topic');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('topic');

	return $values;
}


/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $bookmark A bookmark object.
 * @return array
 */
function marcadores_prepare_form_vars($bookmark = null) {
	// input names => defaults
	$values = array(
		'title' => get_input('title', ''), // bookmarklet support
		'address' => get_input('address', ''),
		'description' => '',
		'access_id' => ACCESS_DEFAULT,
		'tags' => '',
		'shares' => array(),
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $bookmark,
	);

	if ($bookmark) {
		foreach (array_keys($values) as $field) {
			if (isset($bookmark->$field)) {
				$values[$field] = $bookmark->$field;
			}
		}
	}

	if (elgg_is_sticky_form('bookmarks')) {
		$sticky_values = elgg_get_sticky_values('bookmarks');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('bookmarks');

	return $values;
}

/**
 * Permite obtener el numero de miembros de una Red: miembros 
 * @param ElggRedTematica $grupo
 * @return array
 */
function elgg_get_miembros_red_tematica(ElggRedTematica $red) {
    
    
    $miembros = array();
    $admin = $red->getEntitiesFromRelationship("administrador", true);
    foreach ($admin as $miembro) {
        array_push($miembros, array(
            'rol' => 'admin',
            'usuario' => $miembro
        ));
    }

     $member = $red->getEntitiesFromRelationship("es_miembro_de", true);
    foreach ($member as $miembro) {
        array_push($miembros, array(
            'rol' => 'leer',
            'usuario' => $miembro
        ));
    }
    
    
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


function elgg_get_mis_redes_tematicas($user_guid) {
  
    $todos = array();
    $options = array('relationship' => 'administrador',
        'relationship_guid' => $user_guid,
        'inverse_relationship' => FALSE
    );
    $todos=array_merge($todos, elgg_get_entities_from_relationship($options));
    $options = array('relationship' => 'editar',
        'relationship_guid' => $user_guid,
        'inverse_relationship' => FALSE
    );
    $todos=array_merge($todos, elgg_get_entities_from_relationship($options));
    $options = array('relationship' => 'es_miembro_de',
        'relationship_guid' => $user_guid,
        'inverse_relationship' => FALSE
    );
    $todos=array_merge($todos, elgg_get_entities_from_relationship($options));
    
    $final=array();
    foreach($todos as $red){
        if($red->getSubtype()=='red_tematica'){
            array_push($final, $red);
        }
    }
    
    return $final;
}

function elgg_get_miembros_red_like_paginable($clave, $guid_red, $limit, $offset) {
    $options = array(
        'type' => 'user',
        'wheres' => array(
            'name' => 'mts.string=\'apellidos\' and mts.id=mt.name_id and mt.value_id=mts2.id and concat_ws(\' \', s.name, mts2.string) LIKE \'%' . $clave . '%\' AND mt.entity_guid=s.guid '
            . "AND e.guid=s.guid AND e.guid=r.guid_one AND r.relationship='es_miembro_de' AND r.guid_two=$guid_red",
        ),
        'joins' => array(
            'name' => ', elgg_users_entity s, elgg_metadata mt, elgg_metastrings mts, elgg_metastrings mts2, elgg_entity_relationships r'
        ),
    );
    
    $users = elgg_list_paginable_entities_metadata(array('query'=>$options, 'view' => 'redes_tematicas/integrantes/lista', 'limit' => $limit, 'offset' => $offset,'red'=>$guid_red));
    return $users;
}

