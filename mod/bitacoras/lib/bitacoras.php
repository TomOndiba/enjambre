<?php

/**
 * Libreria de Bitácoras
 * @author DIEGOX_CORTEX
 */

/**
 * Prepara los datos para los fomularios crear/editar de la Bitácora No. 1
 * @param ElggObject $page
 * @return array
 */
function bitacoras_prepare_form_vars($page = null, $parent_guid = 0, $revision = null, $guid_cuad, $guid_grupo) {

error_log("entra a la funcion de bitacoras_prepare_form_vars". $page->id."--".$guid_grupo);

    // input names => defaults
    $values = array(
        'title0' => 'BITACORA N° 1. ESTAR EN LA ONDA DE ONDAS',
        'institucion' => '',
        'departamento' => '',
        'municipio' => '',
        'direccion' => '',
        'telefono' => '',
        'email' => '',
        'nombre_grupo' => '',
        'descripcion' => '',
        'motivos' => '',
        'asesor_linea' => '',
        //'probando1'=>'',
        'access_id' => ACCESS_DEFAULT,
//		'write_access_id' => ACCESS_DEFAULT,
//		'tags' => '',
        'container_guid' => elgg_get_page_owner_guid(),
        'guid' => null,
        'entity' => $page,
        'parent_guid' => $parent_guid,
        'guid_cuaderno' => $guid_cuad,
        'guid_grupo' => $guid_grupo,
        'bitacora' => 1
    );



    if ($page) {
        foreach (array_keys($values) as $field) {
            if (isset($page->$field)) {
                $values[$field] = $page->$field;
            }
        }
    }

    if (elgg_is_sticky_form('bitacora')) {
        $sticky_values = elgg_get_sticky_values('bitacora');
        foreach ($sticky_values as $key => $value) {
            $values[$key] = $value;
        }
    }

    elgg_clear_sticky_form('bitacora');

    // load the revision annotation if requested
    if ($revision instanceof ElggAnnotation && $revision->entity_guid == $page->getGUID()) {
        $values['description'] = $revision->value;
    }



    //buscando la información de las instituciones
    $grupo = new ElggGrupoInvestigacion($guid_grupo);
error_log("grupo". $grupo->guid);

    if ($grupo != NULL) {
        $instituciones = $grupo->getEntitiesFromRelationship('pertenece_a', false);

        
        error_log("nombre de la institución".$instituciones[0]->name);
        $values['institucion'] = $instituciones[0]->name;
        $values['departamento'] = $instituciones[0]->departamento;
        $values['municipio'] = $instituciones[0]->municipio;
        $values['direccion'] = $instituciones[0]->direccion;
        $values['telefono'] = $instituciones[0]->telefono;
        $values['email'] = $instituciones[0]->email;
        $values['nombre_grupo'] = $grupo->name;
    }

    $values['integrantes'] = elgg_listar_integrantes_cuaderno($guid_cuad, "true");
    $values['maestros'] = elgg_listar_maestros_cuaderno($guid_cuad, "true");
    $values['guid_cuaderno'] = $guid_cuad;
    $values['guid_grupo'] = $guid_grupo;

    $values['bitacora'] = 1;


    return $values;
}

/* * fomuralios
 * Prepara los datos para los formularios  crear/editar de la Bitácora No. 2
 *
 * @param ElggObject $page
 * @return array
 */

function bitacoras_prepare_form_b2_vars($page = null, $parent_guid = 0, $revision = null, $guid_cuad, $guid_grupo) {



    // input names => defaults
    $values = array(
        'title1' => 'BITACORA N° 2. LA PREGUNTA',
        'pregunta1' => '',
        'pregunta2' => '',
        'pregunta3' => '',
        'pregunta4' => '',
        'pregunta5' => '',
        'pregunta_seleccionada' => '',
        'pregunta_nueva' => '',
        'sintesis_informacion' => '',
        'resumen' => '',
        'access_id' => ACCESS_DEFAULT,
        'container_guid' => elgg_get_page_owner_guid(),
        'guid' => null,
        'entity' => $page,
        'parent_guid' => $parent_guid,
        'guid_cuaderno' => $guid_cuad,
        'guid_grupo' => $guid_grupo,
        'bitacora' => 2
    );



    if ($page) {
        foreach (array_keys($values) as $field) {
            if (isset($page->$field)) {
                $values[$field] = $page->$field;
            }
        }
    }

    if (elgg_is_sticky_form('bitacora')) {
        $sticky_values = elgg_get_sticky_values('bitacora');
        foreach ($sticky_values as $key => $value) {
            $values[$key] = $value;
        }
    }

    elgg_clear_sticky_form('bitacora');

    // load the revision annotation if requested
    if ($revision instanceof ElggAnnotation && $revision->entity_guid == $page->getGUID()) {
        $values['description'] = $revision->value;
    }


    $values['integrantes'] = elgg_listar_integrantes_cuaderno($guid_cuad);
    $values['maestros'] = elgg_listar_maestros_cuaderno($guid_cuad);
    $values['guid_cuaderno'] = $guid_cuad;
    $values['guid_grupo'] = $guid_grupo;
    $values['bitacora'] = 2;


    return $values;
}

/**
 * Prepara los datos para los fomularios crear/editar de la Bitácora No. 3
 *
 * @param ElggObject $page
 * @return array
 */
function bitacoras_prepare_form_b3_vars($page = null, $parent_guid = 0, $revision = null, $guid_cuad, $guid_grupo) {



    // input names => defaults
    $values = array(
        'title2' => 'BITACORA N° 3. EL PROBLEMA DE INVESTIGACION',
        'descripcion_problema' => '',
        'importancia_problema' => '',
        'elementos_significativos' => '',
        'access_id' => ACCESS_DEFAULT,
        'container_guid' => elgg_get_page_owner_guid(),
        'guid' => null,
        'entity' => $page,
        'parent_guid' => $parent_guid,
        'guid_cuaderno' => $guid_cuad,
        'guid_grupo' => $guid_grupo,
        'bitacora' => 3
    );



    if ($page) {
        foreach (array_keys($values) as $field) {
            if (isset($page->$field)) {
                $values[$field] = $page->$field;
            }
        }
    }

    if (elgg_is_sticky_form('bitacora')) {
        $sticky_values = elgg_get_sticky_values('bitacora');
        foreach ($sticky_values as $key => $value) {
            $values[$key] = $value;
        }
    }

    elgg_clear_sticky_form('bitacora');

    // load the revision annotation if requested
    if ($revision instanceof ElggAnnotation && $revision->entity_guid == $page->getGUID()) {
        $values['description'] = $revision->value;
    }


    $values['integrantes'] = elgg_listar_integrantes_cuaderno($guid_cuad);
    $values['maestros'] = elgg_listar_maestros_cuaderno($guid_cuad);
    $values['guid_cuaderno'] = $guid_cuad;
    $values['guid_grupo'] = $guid_grupo;
    $values['bitacora'] = 3;


    return $values;
}

/**
 * Prepara los datos para los fomularios crear/editar de la Bitácora No. 4
 *
 * @param ElggObject $page
 * @return array
 */
function bitacoras_prepare_form_b4_vars($page = null, $parent_guid = 0, $revision = null, $guid_cuad, $guid_grupo) {

//
//    // input names => defaults
//    $values = array(
//        'title3' => 'BITACORA No. 4. DEFINICIÓN DE LA TRAYECTORIA DE INDAGACIÓN',
//        'inicio' => '',
//        'indagacion' => '',
//        'paso' => '',
//        'dificultades' => '',
//        'fortalezas' => '',
//        'caracteristicas' => '',
//        'importancia' => '',
//        'preguntas' => '',
//        'access_id' => ACCESS_DEFAULT,
//        'container_guid' => elgg_get_page_owner_guid(),
//        'guid' => null,
//        'entity' => $page,
//        'parent_guid' => $parent_guid,
//        'guid_cuaderno' => $guid_cuad,
//        'guid_grupo' => $guid_grupo,
//        'bitacora' => 4
//    );
//
//
//
//    if ($page) {
//        foreach (array_keys($values) as $field) {
//            if (isset($page->$field)) {
//                $values[$field] = $page->$field;
//            }
//        }
//    }
//
//    if (elgg_is_sticky_form('bitacora')) {
//        $sticky_values = elgg_get_sticky_values('bitacora');
//        foreach ($sticky_values as $key => $value) {
//            $values[$key] = $value;
//        }
//    }
//
//    elgg_clear_sticky_form('bitacora');
//
//    // load the revision annotation if requested
//    if ($revision instanceof ElggAnnotation && $revision->entity_guid == $page->getGUID()) {
//        $values['description'] = $revision->value;
//    }
//
//
//    $values['integrantes'] = elgg_listar_integrantes_cuaderno($guid_cuad);
//    $values['maestros'] = elgg_listar_maestros_cuaderno($guid_cuad);
//    $values['guid_cuaderno'] = $guid_cuad;
//    $values['guid_grupo'] = $guid_grupo;
//    $values['bitacora'] = 4;
//
//    return $values;
}

function bitacoras_prepare_form_b5_vars($page = null, $parent_guid = 0, $revision = null, $guid_cuad, $guid_grupo) {

//
//    // input names => defaults
//    $values = array(
//        'title4' => 'BITACORA No. 5. PRESUPUESTO',
//        //Segmento 1
//        'segmento1' => '',
//        'total_insumo' => '',
//        'total_insumo1' => '','total_insumo2' => '','total_insumo3' => '','total_insumo4' => '',
//        'porcentaje_insumo' => '',
//        'total_papeleria' => '',
//        'porcentaje_papeleria' => '',
//        'total_transporte' => '',
//        'porcentaje_transporte' => '',
//        'total_internet' => '',
//        'porcentaje_internet' => '',
//        'total_materiales' => '',
//        'porcentaje_materiales' => '',
//        'total_refrigerios' => '',
//        'porcentaje_refrigerios' => '',
//        //'subtotal_semento1' => '',
//        //Segmento 2
//        'segmento2' => 'hidden',
//        'total_insumo_2' => '',
//        'porcentaje_insumo_2' => '',
//        'total_papeleria_2' => '',
//        'porcentaje_papeleria_2' => '',
//        'total_transporte_2' => '',
//        'porcentaje_transporte_2' => '',
//        'total_internet_2' => '',
//        'porcentaje_internet_2' => '',
//        'total_materiales_2' => '',
//        'porcentaje_materiales_2' => '',
//        'total_refrigerios_2' => '',
//        'porcentaje_refrigerios_2' => '',
//        //'subtotal_semento2' => '',
//        //Segmento 3
//        'segmento3' => 'hidden',
//        'total_insumo_3' => '',
//        'porcentaje_insumo_3' => '',
//        'total_papeleria_3' => '',
//        'porcentaje_papeleria_3' => '',
//        'total_transporte_3' => '',
//        'porcentaje_transporte_3' => '',
//        'total_internet_3' => '',
//        'porcentaje_internet_3' => '',
//        'total_materiales_3' => '',
//        'porcentaje_materiales_3' => '',
//        'total_refrigerios_3' => '',
//        'porcentaje_refrigerios_3' => '',
//        //'subtotal_semento3' => '',
//        'access_id' => ACCESS_DEFAULT,
//        'container_guid' => elgg_get_page_owner_guid(),
//        'guid' => null,
//        'entity' => $page,
//        'parent_guid' => $parent_guid,
//        'guid_cuaderno' => $guid_cuad,
//        'guid_grupo' => $guid_grupo,
//        'bitacora' => 5
//    );
//
//
//
//    if ($page) {
//        foreach (array_keys($values) as $field) {
//            if (isset($page->$field)) {
//                $values[$field] = $page->$field;
//            }
//        }
//    }
//
//    if (elgg_is_sticky_form('bitacora')) {
//        $sticky_values = elgg_get_sticky_values('bitacora');
//        foreach ($sticky_values as $key => $value) {
//            $values[$key] = $value;
//        }
//    }
//
//    elgg_clear_sticky_form('bitacora');
//
//    // load the revision annotation if requested
//    if ($revision instanceof ElggAnnotation && $revision->entity_guid == $page->getGUID()) {
//        $values['description'] = $revision->value;
//    }
//
//
//    $values['integrantes'] = elgg_listar_integrantes_cuaderno($guid_cuad);
//    $values['maestros'] = elgg_listar_maestros_cuaderno($guid_cuad);
//    $values['guid_cuaderno'] = $guid_cuad;
//    $values['guid_grupo'] = $guid_grupo;
//    $values['bitacora'] = 5;
//
//    return $values;
}

/**
 * Prepara los datos para los fomularios crear/editar de la Bitácora No. 6
 *
 * @param ElggObject $page
 * @return array
 */
function bitacoras_prepare_form_b6_vars($page = null, $parent_guid = 0, $revision = null, $guid_cuad, $guid_grupo) {



    // input names => defaults
    $values = array(
        'title5' => 'BITACORA No. 6. Recorrido del primer segmento o trayecto:',
        'retomar_trayectoria' => '',
        'organizar_archivo' => '',
        'recoleccion_informacion' => '',
        'estado_del_arte' => '',
        'tecnicas_e_instrumentos' => '',
        'describir_dificultades' => '',
        'describir_fortalezas' => '',
        'despues_de_trayectoria' => '',
        'acciones_del_recorrido' => '',
        'luz_de_las_etapas' => '',
        'mencione_los_logros' => '',
        'access_id' => ACCESS_DEFAULT,
        'container_guid' => elgg_get_page_owner_guid(),
        'guid' => null,
        'entity' => $page,
        'parent_guid' => $parent_guid,
        'guid_cuaderno' => $guid_cuad,
        'guid_grupo' => $guid_grupo,
        'bitacora' => 6
    );



    if ($page) {
        foreach (array_keys($values) as $field) {
            if (isset($page->$field)) {
                $values[$field] = $page->$field;
            }
        }
    }

    if (elgg_is_sticky_form('bitacora')) {
        $sticky_values = elgg_get_sticky_values('bitacora');
        foreach ($sticky_values as $key => $value) {
            $values[$key] = $value;
        }
    }

    elgg_clear_sticky_form('bitacora');

    // load the revision annotation if requested
    if ($revision instanceof ElggAnnotation && $revision->entity_guid == $page->getGUID()) {
        $values['description'] = $revision->value;
    }


    $values['integrantes'] = elgg_listar_integrantes_cuaderno($guid_cuad);
    $values['maestros'] = elgg_listar_maestros_cuaderno($guid_cuad);
    $values['guid_cuaderno'] = $guid_cuad;
    $values['guid_grupo'] = $guid_grupo;
    $values['bitacora'] = 6;

    return $values;
}

/**
 * Prepara los datos para los fomularios crear/editar de la Bitácora No. 6.1
 *
 * @param ElggObject $page
 * @return array
 */
function bitacoras_prepare_form_b61_vars($page = null, $parent_guid = 0, $revision = null, $guid_cuad, $guid_grupo) {


    // input names => defaults
    $values = array(
        'title6' => 'BITACORA No. 6,1. Recorrido  del segundo, tercer y cuarto segmento o trayecto:',
        'archivo_y_asignar' => '',
        'resultados_de_las_tecnicas' => '',
        'resultados_salida' => '',
        'organización_adecuada' => '',
        'actividades_no_propuestas' => '',
        'access_id' => ACCESS_DEFAULT,
        'container_guid' => elgg_get_page_owner_guid(),
        'guid' => null,
        'entity' => $page,
        'parent_guid' => $parent_guid,
        'guid_cuaderno' => $guid_cuad,
        'guid_grupo' => $guid_grupo,
        'bitacora' => 6.1
    );



    if ($page) {
        foreach (array_keys($values) as $field) {
            if (isset($page->$field)) {
                $values[$field] = $page->$field;
            }
        }
    }

    if (elgg_is_sticky_form('bitacora')) {
        $sticky_values = elgg_get_sticky_values('bitacora');
        foreach ($sticky_values as $key => $value) {
            $values[$key] = $value;
        }
    }

    elgg_clear_sticky_form('bitacora');

    // load the revision annotation if requested
    if ($revision instanceof ElggAnnotation && $revision->entity_guid == $page->getGUID()) {
        $values['description'] = $revision->value;
    }


    $values['integrantes'] = elgg_listar_integrantes_cuaderno($guid_cuad);
    $values['maestros'] = elgg_listar_maestros_cuaderno($guid_cuad);
    $values['guid_cuaderno'] = $guid_cuad;
    $values['guid_grupo'] = $guid_grupo;
    $values['bitacora'] = 6.1;

    return $values;
}

/**
 * Prepara los datos para los fomularios crear/editar de la Bitácora No. 6.2
 *
 * @param ElggObject $page
 * @return array
 */
function bitacoras_prepare_form_b62_vars($page = null, $parent_guid = 0, $revision = null, $guid_cuad, $guid_grupo) {


    // input names => defaults
    $values = array(
        'title7' => 'BITACORA No. 6,2. Recorrido  del segundo, tercer y cuarto segmento o trayecto:',
        'describir_las_dificultades' => '',
        'describir_las_fortalezas' => '',
        'despues_de_desarrollar' => '',
        'etapas_de_investigación' => '',
        'mencione_logros' => '',
        'access_id' => ACCESS_DEFAULT,
        'container_guid' => elgg_get_page_owner_guid(),
        'guid' => null,
        'entity' => $page,
        'parent_guid' => $parent_guid,
        'guid_cuaderno' => $guid_cuad,
        'guid_grupo' => $guid_grupo,
        'bitacora' => 6.2
    );



    if ($page) {
        foreach (array_keys($values) as $field) {
            if (isset($page->$field)) {
                $values[$field] = $page->$field;
            }
        }
    }

    if (elgg_is_sticky_form('bitacora')) {
        $sticky_values = elgg_get_sticky_values('bitacora');
        foreach ($sticky_values as $key => $value) {
            $values[$key] = $value;
        }
    }

    elgg_clear_sticky_form('bitacora');

    // load the revision annotation if requested
    if ($revision instanceof ElggAnnotation && $revision->entity_guid == $page->getGUID()) {
        $values['description'] = $revision->value;
    }


    $values['integrantes'] = elgg_listar_integrantes_cuaderno($guid_cuad);
    $values['maestros'] = elgg_listar_maestros_cuaderno($guid_cuad);
    $values['guid_cuaderno'] = $guid_cuad;
    $values['guid_grupo'] = $guid_grupo;
    $values['bitacora'] = 6.2;

    return $values;
}

/**
 * Recurses the page tree and adds the breadcrumbs for all ancestors
 *
 * @param ElggObject $page Page entity
 */
function bitacoras_prepare_parent_breadcrumbs($page) {
    if ($page && $page->parent_guid) {
        $parents = array();
        $parent = get_entity($page->parent_guid);
        while ($parent) {
            array_push($parents, $parent);
            $parent = get_entity($parent->parent_guid);
        }
        while ($parents) {
            $parent = array_pop($parents);
            //elgg_push_breadcrumb($parent->title, $parent->getURL());
        }
    }
}

/**
 * Produce the navigation tree
 * 
 * @param ElggEntity $container Container entity for the pages
 */
function bitacoras_get_navigation_tree($container) {
    if (!$container) {
        return;
    }

    $top_pages = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'bitacora_top',
        'container_guid' => $container->getGUID(),
        'limit' => 0,
    ));

    if (!$top_pages) {
        return;
    }

    $tree = array();
    $depths = array();

    foreach ($top_pages as $page) {
        $tree[] = array(
            'guid' => $page->getGUID(),
            'title' => $page->title,
            'url' => $page->getURL(),
            'depth' => 0,
        );
        $depths[$page->guid] = 0;

        $stack = array();
        array_push($stack, $page);
        while (count($stack) > 0) {
            $parent = array_pop($stack);
            $children = elgg_get_entities_from_metadata(array(
                'type' => 'object',
                'subtype' => 'bitacora',
                'metadata_name' => 'parent_guid',
                'metadata_value' => $parent->getGUID(),
                'limit' => 0,
            ));

            if ($children) {
                foreach ($children as $child) {
                    $tree[] = array(
                        'guid' => $child->getGUID(),
                        'title' => $child->title,
                        'url' => $child->getURL(),
                        'parent_guid' => $parent->getGUID(),
                        'depth' => $depths[$parent->guid] + 1,
                    );
                    $depths[$child->guid] = $depths[$parent->guid] + 1;
                    array_push($stack, $child);
                }
            }
        }
    }
    return $tree;
}

/**
 * Register the navigation menu
 * 
 * @param ElggEntity $container Container entity for the pages
 */
function bitacoras_register_navigation_tree($container) {
    $pages = bitacoras_get_navigation_tree($container);
    if ($pages) {
        foreach ($pages as $page) {
            elgg_register_menu_item('pages_nav', array(
                'name' => $page['guid'],
                'text' => $page['title'],
                'href' => $page['url'],
                'parent_name' => $page['parent_guid'],
            ));
        }
    }
}

/**
 * Función que devuelve e array con la información de los estudiantes vinculados al cuaderno
 * @param type $cuaderno -> cuaderno al que estan vinculados los estudiantes
 * @return type -> array
 */
function elgg_get_estudiantes_cuaderno($cuaderno) {
    $ret = array();
    $objs = elgg_get_relationship_inversa($cuaderno, 'hace_parte_de');

    for ($i = 0; $i < sizeof($objs); $i++) {

        //calcular la edad
        $fecha = $objs[$i]->fecha_nacimiento;
        list($Y, $m, $d) = explode("-", $fecha);
        $edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );

        $ret[$i] = array(utf8_decode($objs[$i]->name . ' ' . $objs[$i]->apellidos), $edad, $objs[$i]->curso, utf8_decode($objs[$i]->rol), $objs[$i]->sexo, $objs[$i]->email);
    }
    return $ret;
}

/**
 * Función que devuelve el array con la infomacion de los colaboradores vinculados al cuaderno
 * @param type $cuaderno -> cuaderno para verificar los que estan vinculados a él
 * @return type -> array
 */
function elgg_get_maestro_cuaderno($cuaderno) {
    $maes = $cuaderno->getEntitiesFromRelationship('es_colaborador_de', true);
    //array en el que guardo la informacion de los colaboradores para imprimir en la tabla
    $mas = array();
    for ($i = 0; $i < sizeof($maes); $i++) {
        $mas[$i] = array(utf8_decode($maes[$i]->name . ' ' . $maes[$i]->apellidos), $maes[$i]->area_conocimiento);
    }
    return $mas;
}

function elgg_get_grupo_cuaderno($cuaderno_guid) {
    $options = array('relationship' => 'tiene_cuaderno_campo',
        'relationship_guid' => $cuaderno_guid,
        'inverse_relationship' => TRUE);
    
    $grupo=elgg_get_entities_from_relationship($options);
    return $grupo[0];
}

function elgg_get_actividades_bitacora($bitacora) {
    $actividades = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'actividad_bitacora4',
        'owner_guid' => $bitacora,
    ));
    return $actividades;
}

/**
 * Funcion que obtiene los trayectos que son propios de la bitacora 5
 * @param type $bitacora -> guid de la bitacora 5 
 * @return type -> array
 */
function elgg_get_trayectos_bitacora5($bitacora) {
    $trayectos = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'trayecto_bit5',
        'owner_guid' => $bitacora,
    ));
    return $trayectos;
}

/**
 * Función que obtiene los items de los trayectos agregados en la bitacora 5
 * @param type $bit -> guid bitacora 5
 * @param type $tray -> guid del trayecto
 * @return type -> array
 */
function elgg_items_trayectos_bitacora5($bit, $tray) {
    $items = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'item_trayecto_bit5',
        'owner_guid' => $tray,
        'container_guid' => $bit,
    ));
    return $items;
}

/**
 * Función que obtiene los rubros de la bitacor 5.1
 * @param type $bit -> guid bitacora 5.1
 * @param type $tray -> guid del trayecto
 * @return type -> array
 */
function elgg_rubros_bitacora51($bit, $tray) {
    $items = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'rubro_bit5_1',
        'owner_guid' => $tray,
        'container_guid' => $bit,
    ));
    return $items;
}

/**
 * Función que prepara la tabla donde se mostrarán los datos de los trayectos y sus items en la bitácora 5
 * @param type $bit -> guid de la bitácora 5
 * @param type $tray -> guid del trayecto
 * @return string -> tabla con el contenido / mensaje de edatos vacios
 */
function cargar_tabla_items_trayecto_bit5($bit, $owner_inv) {
    $tabla = "";
    //Verifico los trayectos asociados a la bitacora 5
    $trayectos_b5 = elgg_get_trayectos_bitacora5($bit);
    if (sizeof($trayectos_b5) > 0) {
        $tabla = "<table class='tabla-integrantes'>";
        $i = 1;
        $total1 = 0;
        $total2 = 0;
        $total3 = 0;
        $total4 = 0;
        foreach ($trayectos_b5 as $t) {

            $tabla .= "<tr>"
                    . "<th colspan='5'>$t->nombre</th>";
            if (elgg_get_logged_in_user_guid() == $owner_inv) {
                $tabla.= "<th><input type='button' onclick='cargarCrearItemTrayecto($bit, $t->guid)' id='boton-agregar-itembit5' value='Agregar Item'></th>";
            }
            $tabla.= "</tr>"
                    . "<tr>"
                    . "<th>Nombre</th>"
                    . "<th>Total Aprobado</th>"
                    . "<th>Total Desembolsado</th>"
                    . "<th>Ejecutado</th>"
                    . "<th>Saldo</th>"
                    . "<th COLSPAN=2>Opción</th>"
                    . "</tr>";
            $items_tray = elgg_items_trayectos_bitacora5($bit, $t->guid);
            if (sizeof($items_tray) > 0) {
                foreach ($items_tray as $it) {
                    $total1 += $it->totalAp;
                    $total2 += $it->totalDs;
                    $total3 += $it->ejecutado;
                    $total4 += $it->saldo;
                    $tabla .= "<tr>"
                            . "<th>$it->title</th>"
                            . "<td><input type='number' id='item-creado' name='item$i' readonly value='$it->totalAp'></td>"
                            . "<td><input type='number' id='item-creado' name='item$i' readonly value='$it->totalDs'></td>"
                            . "<td><input type='number' id='item-creado' name='item$i' readonly value='$it->ejecutado'></td>"
                            . "<td><input type='number' id='item-creado' name='item$i' readonly value='$it->saldo'></td>";
                    if (elgg_get_logged_in_user_guid() == $owner_inv) {
                        $tabla .= "<td><a onclick='cargarCrearItemTrayecto($bit, $t->guid, $it->guid)'>Editar</a></td>"
                                . "<td><a onclick='eliminarItemTrayBit5($it->guid, $bit)'>Eliminar</a></td>";
                    }
                    $tabla.= "</tr>";
                }
            } else {
                $tabla .= "<tr>"
                        . "<td COLSPAN=5>No hay items en este trayecto...</td>"
                        . "</tr>";
            }
            $i++;
        }
        $tabla .= "<th>TOTAL</th>"
                . "<td><input type='number' name='total_totalAp' value='$total1' readonly></td>"
                . "<td><input type='number' name='total_totalDs' value='$total2' readonly></td>"
                . "<td><input type='number' name='total_ejecutado' value='$total3' readonly></td>"
                . "<td><input type='number' name='total_saldo' value='$total4' readonly></td>"
                . "</table>";
    } else {
        $tabla = "No hay Segmentos o trayectos registrados";
    }
    return $tabla;
}

/**
 * Función que prepara la tabla donde se mostrarán los datos de los trayectos y sus items en la bitácora 51
 * @param type $bit -> guid de la bitácora 5
 * @param type $owner_inv -> owner de la inv
 * @return string -> tabla con el contenido / mensaje de edatos vacios
 */
function cargar_tabla_items_trayecto_bit51($bit, $owner_inv) {
    $tabla = "";

    //Verifico los trayectos asociados a la bitacora 5
    $trayectos_b5 = elgg_get_trayectos_bitacora5($bit);
    if (sizeof($trayectos_b5) > 0) {
        $tabla = "<table class='tabla-integrantes'>";
        $i = 1;
        $total1 = 0;
        $total2 = 0;
        $total3 = 0;
        $total4 = 0;
        foreach ($trayectos_b5 as $t) {

            $tabla .= "<tr>"
                    . "<th colspan='6'>$t->nombre</th>"
                    //. "<th><input type='button' onclick='cargarCrearRubro51($bit, $t->guid, $bit51)' id='boton-agregar-itembit5' value='Agregar Item'></th>"
                    . "</tr>"
                    . "<tr>"
                    . "<th>Nombre</th>"
                    . "<th>Descricón del gasto</th>"
                    . "<th>Valor Unitario</th>"
                    . "<th>Valor Total del Rubro</th>"
                    . "<th>Valor Total</th>"
                    . "<th>Opción</th>"
                    . "</tr>";
            $items_tray = elgg_items_trayectos_bitacora5($bit, $t->guid);
            if (sizeof($items_tray) > 0) {
                foreach ($items_tray as $it) {
                    $total1 += $it->desc_gasto;
                    $total2 += $it->valr_unit;
                    $total3 += $it->vlr_tot_rub;
                    $total4 += $it->total;
                    $tabla .= "<tr>"
                            . "<th>$it->title</th>"
                            . "<td><input type='text' id='item-creado' name='item$i' readonly value='$it->desc_gasto'></td>"
                            . "<td><input type='number' id='item-creado' name='item$i' readonly value='$it->valr_unit'></td>"
                            . "<td><input type='number' id='item-creado' name='item$i' readonly value='$it->vlr_tot_rub'></td>"
                            . "<td><input type='number' id='item-creado' name='item$i' readonly value='$it->total'></td>";

                    if (elgg_get_logged_in_user_guid() == $owner_inv) {
                        $tabla .= "<td><a onclick='cargarEditarRubro51($bit, $t->guid, $it->guid)'>Editar</a></td>";
                    }
                    $tabla .="</tr>";
                }
            } else {
                $tabla .= "<tr>"
                        . "<td COLSPAN=5>No hay items en este trayecto...</td>"
                        . "</tr>";
            }
            $i++;
        }
        $tabla .= "<th COLSPAN=2>TOTAL</th>"
                . "<td><input type='number' name='total_totalDs' value='$total2' readonly></td>"
                . "<td><input type='number' name='total_ejecutado' value='$total3' readonly></td>"
                . "<td><input type='number' name='total_saldo' value='$total4' readonly></td>"
                . "</table>";
    } else {
        $tabla = "No hay Segmentos o trayectos registrados";
    }
    return $tabla;
}

function elgg_existe_trayecto_actividad($actividad) {
    $trayectos = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'trayecto_bit5',
        'container_guid' => $actividad,
    ));
    return (sizeof($trayectos) > 0);
}

/**
 * Funcion que obtiene los rubros que son propios de la bitacora 5.2
 * @param type $bitacora -> guid de la bitacora 5.2
 * @return type -> array
 */
function elgg_get_rubros_bitacora52($bitacora) {
    $trayectos = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'rubro_bit5_2',
        'owner_guid' => $bitacora,
    ));
    return $trayectos;
}
