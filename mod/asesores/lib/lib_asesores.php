<?php

function elgg_get_grupo_de_asesores() {
    $db_prefix = get_config('dbprefix');
    $options = array(
        'type' => 'group',
        'joins' => array("JOIN {$db_prefix}groups_entity us on us.guid = e.guid"),
        'wheres' => array("us.name= 'asesores'"),
    );
    $asesores = elgg_get_entities_from_metadata($options);
    return $asesores[0];
}

function elgg_get_asesores() {
    $grupo = elgg_get_grupo_de_asesores();
    $options = array('relationship' => 'asesor',
        'relationship_guid' => $grupo->guid,
        'inverse_relationship' => true,
        'limit' => 0
    );
    return elgg_get_entities_from_relationship($options);
}

function elgg_get_list_asesores($limit, $offset) {
    $grupo = elgg_get_grupo_de_asesores();
    $options = array('query' => $query,
        'limit' => $limit,
        'offset' => $offset,
        'view' => 'asesores/lista/listado_asesores',
        'guid' => $grupo->guid,
        'relacion' => 'asesor',
        'inverse' => true);
    $content = elgg_list_paginable_entities_relationships($options);
    echo $content;
}

function elgg_get_list_asesores_preinscritos_banco($limit, $offset) {
    $grupo = elgg_get_grupo_de_asesores();
    $options = array('query' => $query,
        'limit' => $limit,
        'offset' => $offset,
        'view' => 'asesores/lista_preinscritos/listado_asesores_preinscritos',
        'guid' => $grupo->guid,
        'relacion' => 'membership_request',
        'inverse' => true);
    $content = elgg_list_paginable_entities_relationships($options);
    echo $content;
}

/**
 * Función que devuelve el listado de líneas temáticas asociadas al asesor
 * @param type $guid -> guid del asesor
 * @return type -> array
 */
function elgg_get_lineas_asesor($guid) {
    $options = array('relationship' => 'asesor_de_linea',
        'relationship_guid' => $guid,
        'inverse_relationship' => false
    );
    $lineas = elgg_get_entities_from_relationship($options);
    return $lineas;
}

function elgg_es_asesor($user_guid) {
    $grupo = elgg_get_grupo_de_asesores();
    return check_entity_relationship($user_guid, "asesor", $grupo->guid);
}

function elgg_es_evaluador($user_guid) {
    $grupo = elgg_get_grupo_evaluadores();
    return check_entity_relationship($user_guid, "member", $grupo->guid);
}

function elgg_verificar_inscripcion_maestro_asesor() {

    $user = elgg_get_logged_in_user_entity();

    $banco = elgg_get_grupo_de_asesores();

    if (!elgg_is_rol_logged_user("Profesor")) {
        return true;
    }
    if (check_entity_relationship($user->guid, 'membership_request', $banco->guid) || check_entity_relationship($user->guid, 'asesor', $banco->guid)) {
        return true;
    } else {
        return false;
    }
}

function elgg_get_view_asesores_asignados_convocatoria($guid_convocatoria) {
    $asesores = elgg_get_asesores_asignados_convocatoria($guid_convocatoria);
    $vars = array('asesores' => $asesores,
        'asignado' => true,
        'convocatoria' => $guid_convocatoria);
    echo elgg_view("asesores/vincular/lista_aceptados/listar_asesores", $vars);
}

function elgg_get_asesores_asignados_convocatoria($guid_convocatoria) {
    $options = array('relationship' => 'asesor',
        'relationship_guid' => $guid_convocatoria,
        'inverse_relationship' => true
    );
    return elgg_get_entities_from_relationship($options);
}

function elgg_get_view_asesores_no_asignados_convocatoria($guid_convocatoria) {
    $asesores = elgg_get_asesores_no_asignados_convocatoria($guid_convocatoria);
    $vars = array('asesores' => $asesores,
        'asignado' => false,
        'convocatoria' => $guid_convocatoria);
    echo elgg_view("asesores/vincular/lista/listar_asesores", $vars);
}

function elgg_get_asesores_no_asignados_convocatoria($guid_convocatoria) {
    $options = array('relationship' => 'inscripcion_asesor',
        'relationship_guid' => $guid_convocatoria,
        'inverse_relationship' => true
    );
    return elgg_get_entities_from_relationship($options);
}

function elgg_notificar_asesores_convocatoria($asignados, $no_asignados, $convocatoria) {
    $mensaje_aprobado = elgg_echo("mensaje:asesores:convocatoria:aprobado", array($convocatoria->name));
    $mensaje_rechazado = elgg_echo("mensaje:asesores:convocatoria:rechazado", array($convocatoria->name));
    elgg_notificar_grupo_asesores_convocatoria($asignados, $mensaje_aprobado);
    elgg_notificar_grupo_asesores_convocatoria($no_asignados, $mensaje_rechazado);
}

function elgg_notificar_grupo_asesores_convocatoria($asesores, $mensaje) {
    foreach ($asesores as $asesor) {
        $subject = "Mensaje de Notificacion Asesor";
        elgg_send_email("comunidadenjambre@gmail.com", $asesor->email, $subject, $mensaje);
        $result = messages_send($subject, $mensaje, $asesor->guid, 0, $reply);
    }
}

function elgg_get_hoja_de_vida($guid) {
    $options = array('type' => 'object',
        'subtype' => 'hoja_de_vida',
        'owner_guid' => $guid);
    return elgg_get_entities($options)[0]->guid;
}

function elgg_get_json($datos) {
    return json_decode($datos, true);
}

function elgg_depurar_array_cursos_terminados($array) {
    $retorno = array();
    $pos = 0;
    for ($i = 0; $i < count($array); $i++) {
        if (empty($array[$i]['nombre']) && empty($array[$i]['institucion']) && empty($array[$i]['fecha']) && empty($array[$i]['ciudad']) && empty($array[$i]['intensidad'])) {
            
        } else {
            $retorno[$pos] = $array[$i];
            $pos++;
        }
    }
    return $retorno;
}

function elgg_depurar_array_experiencia($array) {
    $retorno = array();
    $pos = 0;
    for ($i = 0; $i < count($array); $i++) {
        if (empty($array[$i]['universidad']) && empty($array[$i]['actividad']) && empty($array[$i]['mt']) && empty($array[$i]['tc']) && empty($array[$i]['cat']) && empty($array[$i]['desde']) && empty($array[$i]['hasta'])) {
            
        } else {
            $retorno[$pos] = $array[$i];
            $pos++;
        }
    }
    return $retorno;
}

function elgg_depurar_array_experiencia_docente($array) {
    $retorno = array();
    $pos = 0;
    for ($i = 0; $i < count($array); $i++) {
        if (empty($array[$i]['entidad']) && empty($array[$i]['cargo']) && empty($array[$i]['desde']) && empty($array[$i]['hasta'])) {
            
        } else {
            $retorno[$pos] = $array[$i];
            $pos++;
        }
    }
    return $retorno;
}

function elgg_depurar_array_estudios_terminados($array) {
    $retorno = array();
    $pos = 0;
    for ($i = 0; $i < count($array); $i++) {
        if (empty($array[$i]['clase']) && empty($array[$i]['institucion']) && empty($array[$i]['ciudad']) && empty($array[$i]['fecha']) && empty($array[$i]['resolucion'])) {
            
        } else {
            $retorno[$pos] = $array[$i];
            $pos++;
        }
    }
    return $retorno;
}

function elgg_depurar_array_investigaciones($array) {
    $retorno = array();
    $pos = 0;
    for ($i = 0; $i < count($array); $i++) {
        if (empty($array[$i]['titulo']) && empty($array[$i]['entidad_patrocinadora']) &&
                empty($array[$i]['fecha_fin'])) {
            
        } else {
            $retorno[$pos] = $array[$i];
            $pos++;
        }
    }
    return $retorno;
}

function elgg_depurar_array_pertenencia_grupos($array) {
    $retorno = array();
    $pos = 0;
    for ($i = 0; $i < count($array); $i++) {
        if (empty($array[$i]['nombre']) && empty($array[$i]['categoria']) &&
                empty($array[$i]['fecha_fin_pertenencia'])) {
            
        } else {
            $retorno[$pos] = $array[$i];
            $pos++;
        }
    }
    return $retorno;
}

function elgg_depurar_array_ponencias($array) {
    $retorno = array();
    $pos = 0;
    for ($i = 0; $i < count($array); $i++) {
        if (empty($array[$i]['nombre']) && empty($array[$i]['tipo']) &&
                empty($array[$i]['fecha']) && empty($array[$i]['evento'])) {
            
        } else {
            $retorno[$pos] = $array[$i];
            $pos++;
        }
    }
    return $retorno;
}

function elgg_depurar_array_publicaciones($array) {
    $retorno = array();
    $pos = 0;
    for ($i = 0; $i < count($array); $i++) {
        if (empty($array[$i]['titulo']) && empty($array[$i]['categoria']) &&
                empty($array[$i]['fecha']) && empty($array[$i]['ciudad']) &&
                empty($array[$i]['isbn']) && empty($array[$i]['issn']) &&
                empty($array[$i]['indexada'])
        ) {
            
        } else {
            $retorno[$pos] = $array[$i];
            $pos++;
        }
    }
    return $retorno;
}

function elgg_get_evaluacion_asesores($asesor, $convocatoria) {

    $options = array('type' => 'object',
        'subtype' => 'evaluacion_asesor',
        'owner_guid' => $convocatoria,
        'container_guid' => $asesor
    );
    $evaluacion = elgg_get_entities_from_metadata($options)[0]->guid;

    return $evaluacion;
}

function elgg_get_asesorias($limit, $offset, $id_inv, $id_conv) {
    $query = array('type' => 'object', 'subtype' => 'asesoria', 'container_guid' => $id_inv,
        'order_by_metadata' => array('name' => 'fecha', 'direction' => 'DESC'));
    $options = array(
        'query' => $query,
        'limit' => $limit,
        'offset' => $offset,
        'view' => 'asesorias/lista/list',
        'container_guid' => $id_inv,
        'inverse' => 'true',
        'guid' => $id_conv,
        'relacion' => 'pertenece',
    );
    return elgg_list_paginable_entities_relationships($options);
}

function elgg_get_asesorias_red($limit, $offset, $red) {
    $query = array('type' => 'object',
        'subtype' => 'asesoria_red', 
        'owner_guid' => $red);
    $options = array(
        'query' => $query,
        'limit' => $limit,
        'offset' => $offset,
        'view' => 'asesorias/lista_red/list',
    );
    return elgg_list_paginable_entities($options);
}

function elgg_get_asesorias_red_asesoria($limit, $offset, $asesoria) {
    $query = array('type' => 'object',
        'subtype' => 'asesoria', 
        'owner_guid' => $asesoria);
    $options = array(
        'query' => $query,
        'limit' => $limit,
        'offset' => $offset,
        'view' => 'asesorias/lista_2/list',
    );
    return elgg_list_paginable_entities($options);
}
function elgg_get_asesorias_realizadas($guid_inv) {

    $fecha_actual = new DateTime("now");

    $options = array(
        'type' => 'object',
        'subtype' => 'asesoria',
        'container_guid' => $guid_inv,
    );

    $asesorias = elgg_get_entities($options);
    $asesorias_realizadas = array();

    foreach ($asesorias as $asesoria) {

        $fecha_asesoria = new DateTime($asesoria->fecha);

        if ($fecha_asesoria < $fecha_actual) {
            array_push($asesorias_realizadas, $asesoria);
        }
    }



    return $asesorias_realizadas;
}

/**
 * Funcion que obtiene los archivos de una asesoria
 * @param type $asesoria -> guid de asesoria
 * @return type -> array
 */
function elgg_get_archivos_asesora($asesoria) {
    $archivos = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'file',
        'owner_guid' => $asesoria,
    ));
    return $archivos;
}

function elgg_upload_fileS($upload, $id_file, $name, $error, $tmp_name, $type, $feria, $other_name, $obj_feria, $container_guid) {
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
    if (empty($container_guid)) {
        $nombre = $other_name . $feria;
    } else {
        $nombre = time();
    }

    $file->title = $nombre;
    $file->container_guid = elgg_get_logged_in_user_guid();
    $file->owner_guid = $feria;

    // we have a file upload, so process it
    if (isset($name) && !empty($name)) {

        if (!empty($obj_feria->$other_name)) {
//            $fil = new FilePluginFile($obj_feria->$other_name);
//            $re = $fil->delete();
//            
//            $options = array(
//                'guid' => $feria,
//                'metadata_name' => $other_name,
//                'limit' => false
//            );
//            $del = elgg_delete_metadata($options);
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
