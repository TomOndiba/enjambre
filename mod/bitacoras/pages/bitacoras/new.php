<?php

/**
 * Page que prepara las variables y redirecciona a el formulario "edit" para crear una bitacora
 * @author DIEGOX_CORTEX
 */
gatekeeper();

$container_guid = (int) get_input('guid');
$container = get_entity($container_guid);
$guid_grupo = get_input('guid_grupo');
$guid_cuaderno = get_input('guid_cuaderno');
$bitacora = get_input('bitacora');


if (!$container) {
    
}

$parent_guid = 0;
$page_owner = $container;
if (elgg_instanceof($container, 'object')) {
    $parent_guid = $container->getGUID();
    $page_owner = $container->getContainerEntity();
}


elgg_set_page_owner_guid($page_owner->getGUID());

$title = elgg_echo('pages:add');
//elgg_push_breadcrumb($title);

if ($bitacora == 1) {
    $vars = bitacoras_prepare_form_vars(null, $parent_guid, null, $guid_cuaderno, $guid_grupo);

} else if ($bitacora == 2) {
    $vars = bitacoras_prepare_form_b2_vars(null, $parent_guid, null, $guid_cuaderno, $guid_grupo);
    
} else if ($bitacora == 3) {
    $vars = bitacoras_prepare_form_b3_vars(null, $parent_guid, null, $guid_cuaderno, $guid_grupo);
   
//} else if ($bitacora == 4) {
//    $vars = bitacoras_prepare_form_b4_vars(null, $parent_guid, null, $guid_cuaderno, $guid_grupo);
//   
//} else if ($bitacora == 5) {
//    $vars = bitacoras_prepare_form_b5_vars(null, $parent_guid, null, $guid_cuaderno, $guid_grupo);
//   
} else if ($bitacora == 6) {
    $vars = bitacoras_prepare_form_b6_vars(null, $parent_guid, null, $guid_cuaderno, $guid_grupo);
    
} else if ($bitacora == 6.1) {
    $vars = bitacoras_prepare_form_b61_vars(null, $parent_guid, null, $guid_cuaderno, $guid_grupo);
   
} else if ($bitacora == 6.2) {
    $vars = bitacoras_prepare_form_b62_vars(null, $parent_guid, null, $guid_cuaderno, $guid_grupo);
    
}


elgg_load_css('logged');
$content = elgg_view_form('bitacoras/edit', array(), $vars);
$grup = new ElggGrupoInvestigacion($guid_grupo);
$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grup)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grup)); 

