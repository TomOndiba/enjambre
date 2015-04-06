<?php

/**
 * View a single page
 *
 * @package ElggPages
 */
$page_guid = get_input('guid');
$cuaderno_huid = get_input('guid_cuad');
$page = get_entity($page_guid);
$bitacora = $page->description;
if (!$page) {
    register_error(elgg_echo('noaccess'));
    $_SESSION['last_forward_from'] = current_page_url();
    forward('');
}

elgg_set_page_owner_guid($page->getContainerGUID());

group_gatekeeper();

$container = elgg_get_page_owner_entity();
if (!$container) {
    
}

$title = $page->title;

//if (elgg_instanceof($container, 'group')) {
//	elgg_push_breadcrumb($container->name, "bitacoras/group/$container->guid/all");
//} else {
//	elgg_push_breadcrumb($container->name, "bitacoras/owner/$container->username");
//}
//bitacoras_prepare_parent_breadcrumbs($page);
//elgg_push_breadcrumb($title);

$content = elgg_view_entity($page, array('full_view' => true, 'grupo'=>'true'));
//$content .= elgg_view_comments($page);



if ($page->canEdit() && $container->canWriteToContainer(0, 'object', 'bitacora')) {
    switch ($bitacora) {
        case 1:
            $url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $page_guid . '&bit=1&cuad='.$cuaderno_huid;
            break;
        case 2:
            $url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $page_guid . '&bit=2&cuad='.$cuaderno_huid;
            break;
        case 3:
            $url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $page_guid . '&bit=3&cuad='.$cuaderno_huid;
            break;
//        case 4:
//            $url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $page_guid . '&bit=4&cuad='.$cuaderno_huid;
//            break;
//        case 5:
//            $url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $page_guid . '&bit=5&cuad='.$cuaderno_huid;
//            break;
    }
    $url_print = elgg_add_action_tokens_to_url($url1);
    elgg_register_menu_item('title', array(
        'name' => 'print',
        'href' => $url_print,
        'text' => '<span class="elgg-icon elgg-icon-print-alt "></span> Imprimir',
        'link_class' => 'elgg-button elgg-button-action',
    ));
}
elgg_load_css('logged');
elgg_load_css('bitacoras');
$idGrupo = elgg_get_grupo_cuaderno($cuaderno_huid)->guid;
$grupo = new ElggGrupoInvestigacion($idGrupo);
$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grupo)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grupo)); 
