<?php

/**
 * Action que edita la información de una bitácora
 * @author DIEGOX_CORTEX
 */


$bitacora=  get_input('bitacora');
$page_guid = (int) get_input('page_guid');
$input = array();


if($bitacora==1){
    $variables = elgg_get_config('bitacoras');
    foreach ($variables as $name => $type) {//    
        if ($name == 'title0') {
            $input['title'] = htmlspecialchars(get_input($name, '', false), ENT_QUOTES, 'UTF-8');
            //$anot.=$input[$name]. '<br>';
        } else {
            $input[$name] = get_input($name);
            //$anot.=$input[$name];
            if ($name == 'institucion') {
                $anot.=elgg_echo('pages:institucion') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'departamento') {
                $anot.=elgg_echo('pages:departamento') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'municipio') {
                $anot.=elgg_echo('pages:municipio') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'direccion') {
                $anot.=elgg_echo('pages:direccion') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'telefono') {
                $anot.=elgg_echo('pages:telefono') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'email') {
                $anot.=elgg_echo('pages:email') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'nombre_grupo') {
                $anot.=elgg_echo('pages:nombre_grupo') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'descripcion') {
                $anot.=elgg_echo('pages:descripcion') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'motivos') {
                $anot.=elgg_echo('pages:motivos') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'asesor_linea') {
                $anot.=elgg_echo('pages:asesor_linea') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
        }
        if ($type == 'tags') {
            $input[$name] = string_to_tag_array($input[$name]);
        }
    }   
    if (!$input['title']) {
        register_error(elgg_echo('pages:error:no_title'));
        forward(REFERER);
    }
}else if($bitacora==2){
    $variables = elgg_get_config('bitacoras2');
    foreach ($variables as $name => $type) {//    
        if ($name == 'title1') {
            $input['title'] = htmlspecialchars(get_input($name, '', false), ENT_QUOTES, 'UTF-8');
            //$anot.=$input[$name]. '<br>';
        } else {
            $input[$name] = get_input($name);
            //$anot.=$input[$name];
            if ($name == 'pregunta1') {
                $anot.=elgg_echo('pages:pregunta1') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'pregunta2') {
                $anot.=elgg_echo('pages:pregunta2') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'pregunta3') {
                $anot.=elgg_echo('pages:pregunta3') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'pregunta4') {
                $anot.=elgg_echo('pages:pregunta4') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'pregunta5') {
                $anot.=elgg_echo('pages:pregunta5') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'pregunta_seleccionada') {
                $anot.=elgg_echo('pages:pregunta_seleccionada') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'pregunta_nueva') {
                $anot.=elgg_echo('pages:pregunta_nueva') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'sintesis_informacion') {
                $anot.=elgg_echo('pages:sintesis_informacion') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
        }
        if ($type == 'tags') {
            $input[$name] = string_to_tag_array($input[$name]);
        }
    }
    
    if (!$input['title']) {
        register_error(elgg_echo('pages:error:no_title'));
        forward(REFERER);
    }
}else if($bitacora==3){
    $variables = elgg_get_config('bitacoras3');
    foreach ($variables as $name => $type) {//   
        if ($name == 'title2') {
            $input['title'] = htmlspecialchars(get_input($name, '', false), ENT_QUOTES, 'UTF-8');
            //$anot.=$input[$name]. '<br>';
        } else {
            $input[$name] = get_input($name);
            //$anot.=$input[$name];
            if ($name == 'descripcion_problema') {
                $anot.=elgg_echo('pages:descripcion_problema') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'importancia_problema') {
                $anot.=elgg_echo('pages:importancia_problema') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'elementos_significativos') {
                $anot.=elgg_echo('pages:elementos_significativos') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
        }
        if ($type == 'tags') {
            $input[$name] = string_to_tag_array($input[$name]);
        }
    }
    
    if (!$input['title']) {
        register_error(elgg_echo('pages:error:no_title'));
        forward(REFERER);
    }
}else if($bitacora==6){
    $variables = elgg_get_config('bitacoras6');
    foreach ($variables as $name => $type) {
        if ($name == 'title5') {
            $input['title'] = htmlspecialchars(get_input($name, '', false), ENT_QUOTES, 'UTF-8');
            //$anot.=$input[$name]. '<br>';
        } else {
            $input[$name] = get_input($name);
            //$anot.=$input[$name];
            if ($name == 'retomar_trayectoria') {
                $anot.=elgg_echo('pages:retomar_trayectoria') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'organizar_archivo') {
                $anot.=elgg_echo('pages:organizar_archivo') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'recoleccion_informacion') {
                $anot.=elgg_echo('pages:recoleccion_informacion') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'estado_del_arte') {
                $anot.=elgg_echo('pages:estado_del_arte') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'tecnicas_e_instrumentos') {
                $anot.=elgg_echo('pages:tecnicas_e_instrumentos') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'describir_dificultades') {
                $anot.=elgg_echo('pages:describir_dificultades') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'despues_de_trayectoria') {
                $anot.=elgg_echo('pages:despues_de_trayectoria') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'acciones_del_recorrido') {
                $anot.=elgg_echo('pages:acciones_del_recorrido') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'luz_de_las_etapas') {
                $anot.=elgg_echo('pages:luz_de_las_etapas') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
            if ($name == 'mencione_los_logros') {
                $anot.=elgg_echo('pages:mencione_los_logros') . '<br>';
                $anot.=$input[$name] . '<br><br>';
            }
        }
        if ($type == 'tags') {
            $input[$name] = string_to_tag_array($input[$name]);
        }
    }
    
    if (!$input['title']) {
        register_error(elgg_echo('pages:error:no_title'));
        forward(REFERER);
    }
}

$anot.=elgg_echo('pages:informacion') . '<br>';

// Get guids

$container_guid = (int) get_input('container_guid');
$parent_guid = (int) get_input('parent_guid');
$guid_grupo=  get_input('guid_grupo');
$guid_cuaderno= get_input('guid_cuaderno');
$cuaderno= new ElggCuadernoCampo($guid_cuaderno);
$subtype=$cuaderno->getSubtype();
elgg_make_sticky_form('bitacoras');



if ($page_guid) {
    $page = get_entity($page_guid);
    if (!$page || !$page->canEdit()) {
        register_error(elgg_echo('pages:error:no_save'));
        forward(REFERER);
    }
    $new_page = false;
} else {
    $page = new ElggObject();
    if ($parent_guid) {
        $page->subtype = 'bitacora';
    } else {
        $page->subtype = 'bitacora_top';
    }
    $new_page = true;
}

if (sizeof($input) > 0) {
    // don't change access if not an owner/admin
    $user = elgg_get_logged_in_user_entity();
    $can_change_access = true;

    if ($user && $page) {
        $can_change_access = $user->isAdmin() || $user->getGUID() == $page->owner_guid;
    }

    foreach ($input as $name => $value) {
        if (($name == 'access_id' || $name == 'write_access_id') && !$can_change_access) {
            continue;
        }
        if ($name == 'parent_guid') {
            continue;
        }

        $page->$name = $value;
    }
}

// need to add check to make sure user can write to container
$page->container_guid = $container_guid;

if ($parent_guid && $parent_guid != $page_guid) {
    // Check if parent isn't below the page in the tree
    if ($page_guid) {
        $tree_page = get_entity($parent_guid);
        while ($tree_page->parent_guid > 0 && $page_guid != $tree_page->guid) {
            $tree_page = get_entity($tree_page->parent_guid);
        }
        // If is below, bring all child elements forward
        if ($page_guid == $tree_page->guid) {
            $previous_parent = $page->parent_guid;
            $children = elgg_get_entities_from_metadata(array(
                'metadata_name' => 'parent_guid',
                'metadata_value' => $page->getGUID()
            ));
            if ($children) {
                foreach ($children as $child) {
                    $child->parent_guid = $previous_parent;
                }
            }
        }
    }
    $page->parent_guid = $parent_guid;
}



$page->description=$bitacora;

if ($page->save()) {

    elgg_clear_sticky_form('bitacoras');

    // Now save description as an annotation  $anot
    //$page->annotate('bitacora', $page->description, $page->access_id);
    $page->annotate('bitacora', $anot, $page->access_id);

    if ($new_page) {
        add_to_river('river/object/bitacoras/create', 'create', elgg_get_logged_in_user_guid(), $page->guid);
        
        $id_cuad=  get_input('guid_cuaderno');
        $cuaderno=new ElggCuadernoCampo($id_cuad);
        if(!check_entity_relationship($cuaderno->guid, "tiene_la_bitacora", $page->guid)){
            if($cuaderno->addRelationship($page->guid, "tiene_la_bitacora")){
            $user = elgg_get_logged_in_user_entity();
            if($bitacora==1){
                forward("/bitacoras/add/{$user->guid}/$guid_grupo/$guid_cuaderno/2");
            }else if($bitacora==2){
                forward("/bitacoras/add/{$user->guid}/$guid_grupo/$guid_cuaderno/3");
            }else if($bitacora==3){
                if($subtype=='cuaderno_campo'){
                forward("/grupo_investigacion/ver_cuaderno/$guid_grupo/$guid_cuaderno/");
                }
                else if($subtype=='investigacion'){
                forward("/investigaciones/ver/$guid_cuaderno/grupo/$guid_grupo");
              }
            }
            else if($bitacora==6||$bitacora==6.1||$bitacora==6.2){
                forward(REFERER);
            }
            }
            else{
            register_error(elgg_echo("bitacora$bitacora:error:asociacion"));
            forward(REFERER);
        }
    }else{
        system_message(elgg_echo('pages:saved'));
        if($subtype=='cuaderno_campo'){
            forward("/grupubtype=='cuaderno_campo'){o_investigacion/ver/$guid_grupo/cuadernos/$guid_cuaderno/");
        }else if($subtype=='investigacion'){
            forward("/investigaciones/ver/$guid_cuaderno/grupo/$guid_grupo");
            }
        }
        
    }
}
        
 
