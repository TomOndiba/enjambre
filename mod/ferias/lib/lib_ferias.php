<?php

/**
 * Función que devuelve todas las ferias almacenadas en base de datos
 * @return type->NULL|array
 */
function elgg_get_ferias() {
    $options = array(
        'type' => 'group',
        'subtype' => 'feria',
    );

    $ferias = elgg_get_entities($options);
    return $ferias;
}

/**
 * Función que imprime en pantalla un listado paginable de las ferias de acuerdo a los parámetros recibidos
 * @param type $limit - cantidad de elementos que se desea obtener
 * @param type $offset - número a partir del cual se desea que se listen las ferias
 */
function elgg_get_list_ferias($limit, $offset) {
    $query = array('type' => 'group', 'subtype' => 'feria');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'ferias/lista/lista_feria');
    $content = elgg_list_paginable_entities($options);
    echo $content;
}

/**
 * Función que imprime en pantalla un listado paginable de las ferias DESACTIVADAS de acuerdo a los parámetros recibidos
 * @param type $limit - cantidad de elementos que se desea obtener
 * @param type $offset - número a partir del cual se desea que se listen las ferias
 */
function elgg_get_list_ferias_inactivas($limit, $offset) {

//    $options = array(
//        'type' => 'group',
//        'subtype' => 'feria',
//    );
//
//    $entities = elgg_get_disabled_entities($options,false);
//    return $entities;
    //echo $entities;
    $query = array('type' => 'group', 'subtype' => 'feria');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'ferias/lista_inactivas/lista_feria_inactiva');
    $content = elgg_list_paginable_entities($options, false);
    echo $content;
}

/**
 * Permite obtener una lista de grupos de investigación filtrada por un nombre
 * @param int $limit cantidad de elementos que se desea obtener
 * @param int $offset numero apartir del cual se desea que se liste los grupos de Investigación
 * @param String $busqueda. Consulta que se desea que coincida con el nombre del grupo
 */
function elgg_get_list_ferias_publico_nombre($limit, $offset, $busqueda) {
    $db_prefix = get_config('dbprefix');
    $query = array('type' => 'group',
        'subtype' => 'feria',
        'joins' => array("JOIN {$db_prefix}groups_entity ge on ge.guid = e.guid"),
        'wheres' => array("ge.name  LIKE '%$busqueda%'"));

    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'ferias_publico/lista/lista_ferias');
    $content = elgg_list_paginable_entities($options);
    echo $content;
}

/**
 * Función que imprime en pantalla un listado paginable de las ferias que se van a mostrar al público de acuerdo a los parámetros recibidos
 * @param type $limit - cantidad de elementos que se desea obtener
 * @param type $offset - número a partir del cual se desea que se listen las ferias
 */
function elgg_get_list_ferias_publico($limit, $offset) {
    $query = array('type' => 'group', 'subtype' => 'feria');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'ferias_publico/lista/lista_ferias');
    $content = elgg_list_paginable_entities($options);
    echo $content;
}

/**
 * Función que devuelve el listado de las áreas asociadas a la feria.
 * @param type $guid_feria -> id de la feria que se desea verificar.
 * @return type -> array(Entity).
 */
function elgg_get_areas_de_feria($guid_feria) {
    return elgg_get_relationship(get_entity($guid_feria), 'tiene_el_area');
}

/**
 * Función que devuelve el listado de los niveles asociados a la feria.
 * @param type $guid_feria -> id de la feria que se desea verificar.
 * @return type -> array(Entity).
 */
function elgg_get_nivel_de_feria($guid_feria) {
    return elgg_get_relationship(get_entity($guid_feria), 'tiene_el_nivel');
}

/**
 * Función que devuelve listado de los niveles que no estan asociados a la feria
 * @param type $guid_feria -> guid de la feria que se desea verificar
 * @return type -> array
 */
function elgg_get_niveles_no_asociados_a_feria($guid_feria) {
    $ret = array();
    $niveles = listar_niveles_feria();
    foreach ($niveles as $n) {
        if (!check_entity_relationship($guid_feria, 'tiene_el_nivel', $n->guid)) {
            $niv_asociar = array('nombre' => $n->title, 'guid' => $n->guid);
            array_push($ret, $niv_asociar);
        }
    }
    return $ret;
}

/**
 * Función que devuelve listado de las areas que no estan asociadas a la feria
 * @param type $guid_feria -> guid de la feria que se desea verificar
 * @return type -> array
 */
function elgg_get_areas_no_asociadas_a_feria($guid_feria) {
    $ret = array();
    $areas = listar_areas_feria();
    foreach ($areas as $a) {
        if (!check_entity_relationship($guid_feria, 'tiene_el_area', $a->guid)) {
            $ar_asociar = array('nombre' => $a->title, 'guid' => $a->guid);
            array_push($ret, $ar_asociar);
        }
    }
    return $ret;
}

/**
 * Función que retorna las ferias que se encuentran abiertas, de acuerdo a la validación de su fecha de apertura 
 * y fecha de cierre con respecto a la fecha actual
 * @return type->NULL|array
 */
function elgg_get_ferias_abiertas() {
    $fecha = date("Y-m-d");
    $options = array(
        'type' => 'group',
        'subtype' => 'feria',
        'wheres' => array(
            'name' => "(mts.string='fecha_inicio_inscripciones' and mts.id=mt.name_id and mt.value_id=mts2.id AND mt.entity_guid=s.guid AND mts2.string<='$fecha')
                        AND (mts3.string='fecha_fin_inscripciones' and mts3.id=mt2.name_id and mt2.value_id=mts4.id AND mt2.entity_guid=s.guid AND mts4.string>='$fecha')"
            . " AND e.guid=s.guid",
        ),
        'joins' => array(
            'name' => ', elgg_groups_entity s, elgg_metadata mt, elgg_metadata mt2, elgg_metastrings mts, elgg_metastrings mts2, elgg_metastrings mts3, elgg_metastrings mts4'
        ),
    );

    $ferias = elgg_get_entities($options);
    return $ferias;
}

function elgg_upload_file($upload, $id_file, $name, $error, $tmp_name, $type, $feria, $other_name, $obj_feria, $container_guid) {
    $title = htmlspecialchars($upload, ENT_QUOTES, 'UTF-8');
    $guid = (int) $id_file;
    elgg_make_sticky_form('file');

    if (!empty($name) && $error != 0) {
        forward(REFERER);
    }

    $new_file = true;
    if ($guid > 0) {
        $new_file = false;
    }

    if ($new_file) {
       
        $file = new FilePluginFile();
        $file->subtype = "file";

        // if no title on new upload, grab filename
        if (empty($title)) {
            $title = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        }
    } else {
        // load original file bject
        $file = new FilePluginFile();
        if (!$file) {
            //register_error(elgg_echo('file:cannotload'));
            forward(REFERER);
        }

        // user must be able to edit file
        if (!$file->canEdit()) {
            register_error(elgg_echo('file:noaccess'));
            forward(REFERER);
        }

        if (!$title) {
            // user blanked title, but we need one
            $title = $file->title;
        }
    }

    $nombre = "";
    if(empty($container_guid)){
        $nombre = $other_name . $feria;
    }else{
        $nombre = time();
    }
   
    $file->title = $nombre;
    $file->container_guid = elgg_get_logged_in_user_guid();
    $file->owner_guid = $feria;

    // we have a file upload, so process it
    if (isset($name) && !empty($name)) {
      
        if (!empty($obj_feria->$other_name)) {
            $fil = new FilePluginFile($obj_feria->$other_name);
            $re = $fil->delete();
           
            $options = array(
                'guid' => $feria,
                'metadata_name' => $other_name,
                'limit' => false
            );
            $del = elgg_delete_metadata($options);

         
        }

        $prefix = "file/";

        // if previous file, delete it
        if ($new_file == false) {
            $filename = $file->getFilenameOnFilestore();
            if (file_exists($filename)) {
                unlink($filename);
            }
            // use same filename on the disk - ensures thumbnails are overwritten
            $filestorename = $file->getFilename();
            $filestorename = elgg_substr($filestorename, elgg_strlen($prefix));
        } else {
            $filestorename = elgg_strtolower(time() . $name);
        }


        $file->setFilename($prefix . $filestorename);
        $mime_type = ElggFile::detectMimeType($tmp_name, $type);

        // hack for Microsoft zipped formats
        $info = pathinfo($name);
        $office_formats = array('docx', 'xlsx', 'pptx');
        if ($mime_type == "application/zip" && in_array($info['extension'], $office_formats)) {
            switch ($info['extension']) {
                case 'docx':
                    $mime_type = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
                    break;
                case 'xlsx':
                    $mime_type = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
                    break;
                case 'pptx':
                    $mime_type = "application/vnd.openxmlformats-officedocument.presentationml.presentation";
                    break;
            }
        }

        // check for bad ppt detection
        if ($mime_type == "application/vnd.ms-office" && $info['extension'] == "ppt") {
            $mime_type = "application/vnd.ms-powerpoint";
        }


        $file->setMimeType($mime_type);
        $file->originalfilename = $name;
        $file->simpletype = file_get_simple_type($mime_type);
        
        // Open the file to guarantee the directory exists
        $file->open("write");
        
        $file->close(); 
        move_uploaded_file($tmp_name, $file->getFilenameOnFilestore());

        $guid = $file->save();
        
        $result = create_metadata($feria, $other_name, $file->guid, 'text', $container_guid, ACCESS_PUBLIC);
       
    } else {
        // not saving a file but still need to save the entity to push attributes to database
        $file->save();
      
    }

    // file saved so clear sticky form
    elgg_clear_sticky_form('file');


    // handle results differently for new files and file updates
    if ($new_file) {
        if ($guid) {
           
            $message = elgg_echo("file:saved");
            return guid;
            //system_message($message);
        } else {
            // failed to save file object - nothing we can do about this
            $error = elgg_echo("file:uploadfailed");
            $file->delete();
        }
    } else {
        if ($guid) {
           
            //system_message(elgg_echo("file:saved"));
        } else {
            
        }
    }
}

/**
 * Función que retorna los patrocinadores asociados a la Feria.
 * @param type $guid -> Identificador del patrocinador
 * @return type -> array();
 */
function elgg_get_patrocinador_de_feria($guid) {
    return elgg_get_relationship(get_entity($guid), 'tiene_el_patrocinador');
}

/**
 * Función que devuelve listado de los patrocinadores que no estan asociados a la feria
 * @param type $guid_feria -> guid de la feria que se desea verificar
 * @return type -> array();
 */
function elgg_get_patrociandores_no_asociados_a_feria($guid_feria) {
    $ret = array();
    $patrocinadores = listar_patrocinadores();
    foreach ($patrocinadores as $p) {
        if (!check_entity_relationship($guid_feria, 'tiene_el_patrocinador', $p->guid)) {
            $patro_asociar = array('nombre' => $p->title, 'guid' => $p->guid, 'logo' => $p->logo);
            array_push($ret, $patro_asociar);
        }
    }
    return $ret;
}

/**
 * Función que imprime en pantalla las investigaciones que se se encuentran inscritas a una feria dada, con una 
 * área temática dada
 * @param type $limit - cantidad de elementos que se desea obtener
 * @param type $offset - número a partir del cual se desea que se listen las investigaciones
 * @param type $id_feria - id de la feria
 * @param type $id_area - id de la área
 * @param String $tipo_relacion -identifica si se listan las innvestigaciones inscritas o las acreditadas
 */
function elgg_get_investigaciones_feria($limit, $offset, $id_feria, $tipo_relacion) {
   
    if ($tipo_relacion == "inscritas") {
        $relation_linea = "inscrita_en";
    } else if ($tipo_relacion == "acreditadas") {
        $relation_linea = "acreditada_en";
    } else if ($tipo_relacion == "evaluadas_inicialmente") {
        $relation_linea = "evaluada_inicialmente_en";
    } else if ($tipo_relacion == "evaluadas_en_sitio") {
        $relation_linea = "evaluada_en_sitio_en";
       
    } else if ($tipo_relacion == "finalistas") {
        $relation_linea = "finalista_en";
    }

   
    $query = array('type' => 'group', 'subtype' => 'investigacion');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => "investigaciones_feria/{$tipo_relacion}/lista_{$tipo_relacion}",
        'guid' => $id_feria, 'tipo' => $tipo_relacion, 'relacion' => $relation_linea,
        'inverse' => 'true');
    $content = elgg_list_paginable_entities_relationships($options);
    return $content;
}

/**
 * Función que devuelve los evaluadores aceptados de la feria
 * @param type $feria -> entidad feria
 * @return type -> Array
 */
function elgg_get_evaluadores_aceptados_feria($feria) {
    return elgg_get_relationship_inversa($feria, 'es_evaluador_feria');
}

/**
 * Función que verifica si un usuario ya es evaluador de la feria
 * @param type $guid_conv -> idenificador de la convocatoria
 * @param type $user_guid -> identificador del ususario
 * @return boolean -> true si ya esta inscrito como evaluador a la feria o false si no lo esta.
 */
function elgg_es_evaludor_feria($guid_fer, $user_guid) {
    $ins = check_entity_relationship($user_guid, 'es_evaluador_feria', $guid_fer);
    if ($ins) {
        return true;
    }
    return false;
}

/**
 * Función que devuelve los evaluadores preinscritos a una feria.
 * @param type $guid_convocatoria -> identificador de la convocatoria.
 */
function elgg_get_evaluadores_preinscritos_feria($guid_feria) {

    $options = array('relationship' => 'preinscrito_evaluador_feria',
        'relationship_guid' => $guid_feria,
        'inverse_relationship' => true
    );
    $evaluadores = elgg_get_entities_from_relationship($options);
    $vars = array('entities' => $evaluadores, 'guid' => $guid_feria);
    echo elgg_view("evaluadores_feria/lista/lista_evaluadores", $vars);
}

/**
 * Función que devuelve los evaluadores aceptados en una feria.
 * @param type $guid_feria -> identificador de la feria.
 */
function elgg_get_evaluadores_feria($guid_feria) {

    $options = array('relationship' => 'es_evaluador_feria',
        'relationship_guid' => $guid_feria,
        'inverse_relationship' => true
    );
    $evaluadores = elgg_get_entities_from_relationship($options);
    $vars = array('entities' => $evaluadores, 'guid' => $guid_feria);
    echo elgg_view("evaluadores_feria/lista_aceptados/lista_evaluadores", $vars);
}

/**
 * Función que compara los puntajes de dos investigaciones en orden descendente
 * @param type $inv1 array con la información de la investigación 1
 * @param type $inv2 array con la información de la investigacion 2
 * @return int  0 si los puntajes son iguales
 *              1 si el puntaje de la inv1 es menor que el de la inv2,
 *              2 si el puntaje de la inv1 es mayor que el de la inv2
 */
function cmpPuntajesDesc($inv1, $inv2) {
    if ($inv1["puntaje_total"] == $inv2["puntaje_total"]) {
        return 0;
    }
    //Si inv1 > 2 se devuelve 1 y por lo contrario -1
    if ($inv1["puntaje_total"] < $inv2["puntaje_total"]) {
        return 1;
    }
    return -1;
}

/**
 * Función que busca las ferias disponibles de los municipios pertenecientes a un departamento dado. 
 * Una feria disponible es aquella que no ha participado en ninguna otra feria departamental.
 * @param type $departamento departamento del cual se va a realizar la búsqueda.
 * @return type listado de ferias municipales disponibles
 */
function elgg_get_ferias_municipales_disponibles($departamento) {

    $options = array(
        'type' => 'group',
        'subtype' => 'feria',
        'metadata_name_value_pair' => array(
            array('name' => 'tipo_feria', 'value' => 'Municipal'),
            array('name' => 'departamento', 'value' => $departamento),
            array('name' => 'participo_en_departamental', 'value' => 'false'),
        )
    );

    $entities = elgg_get_entities_from_metadata($options);
    return $entities;
}



/**
 * Función que busca las ferias según el tipo seleccionado 
 * @param type $tipo Tipo de Feria del cual se va a realizar la búsqueda.
 */
function elgg_get_ferias_tipo($tipo){
    
        $options = array(
        'type' => 'group',
        'subtype' => 'feria',
        'metadata_names' => 'tipo_feria',
        'metadata_values' => $tipo
    );

    $entities = elgg_get_entities_from_metadata($options);
    return $entities;
    
}