<?php

/**
 * Page que prepara las variables y redirecciona a el formulario "edit" para editar una bitacora
 */
gatekeeper();




$page_guid = (int) get_input('guid');

$page = get_entity($page_guid);
$cuadern = elgg_get_relationship_inversa($page, 'tiene_la_bitacora');
$cuaderno=get_entity($cuadern[0]->guid);
$grupo = elgg_get_relationship_inversa($cuaderno, 'tiene_cuaderno_campo');


error_log("page de editar bitacora".$page_guid.", ".$cuaderno->name. ", ".$grupo[0]->name);
if (sizeof($grupo) == 0) {
    $grupo = elgg_get_relationship_inversa($cuaderno, 'tiene_la_investigacion');
}

$revision = (int) get_input('annotation_id');
$bitacora = $page->description;

if (!$page) {
    
    register_error(elgg_echo('noaccess'));
    forward('');
}


$container = $page->getContainerEntity();
if (!$container) {
     
    register_error(elgg_echo('noaccess'));
    forward('');
}

elgg_set_page_owner_guid($container->getGUID());

//elgg_push_breadcrumb($page->title, $page->getURL());
//elgg_push_breadcrumb(elgg_echo('edit'));

$title = elgg_echo("pages:edit");

if ($page->canEdit()) {

    if ($revision) {
        $revision = elgg_get_annotation_from_id($revision);
        if (!$revision || !($revision->entity_guid == $page_guid)) {
            register_error(elgg_echo('pages:revision:not_found'));
            forward(REFERER);
        }
    }

   error_log("page de editar bitacora if puede editar". $bitacora);
    if ($bitacora == 1) {
        $vars = bitacoras_prepare_form_vars($page, $page->parent_guid, $revision, $cuaderno->guid, $grupo[0]->guid);
        
    } else if ($bitacora == 2) {
        $vars = bitacoras_prepare_form_b2_vars($page, $page->parent_guid, $revision, $cuaderno->guid, $grupo[0]->guid);
    
    } else if ($bitacora == 3) {
        $vars = bitacoras_prepare_form_b3_vars($page, $page->parent_guid, $revision, $cuaderno->guid, $grupo[0]->guid);
       
    } else if ($bitacora == 4) {
        $vars = bitacoras_prepare_form_b4_vars($page, $page->parent_guid, $revision, $cuaderno->guid, $grupo[0]->guid);
     
    } else if ($bitacora == 5) {
        $vars = bitacoras_prepare_form_b5_vars($page, $page->parent_guid, $revision, $cuaderno->guid, $grupo[0]->guid);
  
    } else if ($bitacora == 6) {
        $vars = bitacoras_prepare_form_b6_vars($page, $page->parent_guid, $revision, $cuaderno->guid, $grupo[0]->guid);
     
    } else if ($bitacora == 6.1) {
        $vars = bitacoras_prepare_form_b61_vars($page, $page->parent_guid, $revision, $cuaderno->guid, $grupo[0]->guid);
     
    } else if ($bitacora == 6.2) {
        $vars = bitacoras_prepare_form_b62_vars_vars($page, $page->parent_guid, $revision, $cuaderno->guid, $grupo[0]->guid);
      
    }
   
    $content = elgg_view_form('bitacoras/edit', array(), $vars);
} else {
   
    $content = elgg_echo("pages:noaccess");
}

echo"<div class='overflow'>";
echo $content;
echo "</div>";


