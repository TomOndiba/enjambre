<?php

/**
 * Page que prepara las variables y redirecciona a el formulario "edit" para editar una bitacora
 */
gatekeeper();

$page_guid = (int) get_input('guid');
$page = get_entity($page_guid);
$cuaderno = elgg_get_relationship_inversa($page, 'tiene_la_bitacora');
$grupo = elgg_get_relationship_inversa($cuaderno[0], 'tiene_cuaderno_campo');

if (sizeof($grupo) == 0) {
    $grupo = elgg_get_relationship_inversa($cuaderno[0], 'tiene_la_investigacion');
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

   
    if ($bitacora == 1) {
        $vars = bitacoras_prepare_form_vars($page, $page->parent_guid, $revision, $cuaderno[0]->guid, $grupo[0]->guid);
        
    } else if ($bitacora == 2) {
        $vars = bitacoras_prepare_form_b2_vars($page, $page->parent_guid, $revision, $cuaderno[0]->guid, $grupo[0]->guid);
    
    } else if ($bitacora == 3) {
        $vars = bitacoras_prepare_form_b3_vars($page, $page->parent_guid, $revision, $cuaderno[0]->guid, $grupo[0]->guid);
       
    } else if ($bitacora == 4) {
        $vars = bitacoras_prepare_form_b4_vars($page, $page->parent_guid, $revision, $cuaderno[0]->guid, $grupo[0]->guid);
     
    } else if ($bitacora == 5) {
        $vars = bitacoras_prepare_form_b5_vars($page, $page->parent_guid, $revision, $cuaderno[0]->guid, $grupo[0]->guid);
  
    } else if ($bitacora == 6) {
        $vars = bitacoras_prepare_form_b6_vars($page, $page->parent_guid, $revision, $cuaderno[0]->guid, $grupo[0]->guid);
     
    } else if ($bitacora == 6.1) {
        $vars = bitacoras_prepare_form_b61_vars($page, $page->parent_guid, $revision, $cuaderno[0]->guid, $grupo[0]->guid);
     
    } else if ($bitacora == 6.2) {
        $vars = bitacoras_prepare_form_b62_vars_vars($page, $page->parent_guid, $revision, $cuaderno[0]->guid, $grupo[0]->guid);
      
    }
   
    $site_url=  elgg_get_site_url();
    $boton='<a href="' . $site_url . 'grupo_investigacion/ver/'.$grupo[0]->guid.'/cuadernos/'.$cuaderno[0]->guid.'" > Volver Bitacoras</a>';
    $content = "<div class='box'>{$boton}".elgg_view_form('bitacoras/edit', array(), $vars)."</div>";
} else {
    $content = elgg_echo("pages:noaccess");
}

elgg_load_css('logged');

$grup = new ElggGrupoInvestigacion($grupo[0]->guid);
$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grup)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grup)); 

