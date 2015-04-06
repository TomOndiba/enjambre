<?php
/**
 * History of revisions of a page
 *
 * @package ElggPages
 */

$page_guid = get_input('guid');

$page = get_entity($page_guid);
if (!$page) {

}

$container = $page->getContainerEntity();
if (!$container) {

}

elgg_set_page_owner_guid($container->getGUID());

//if (elgg_instanceof($container, 'group')) {
//	elgg_push_breadcrumb($container->name, "bitacoras/group/$container->guid/all");
//} else {
//	elgg_push_breadcrumb($container->name, "bitacoras/owner/$container->username");
//}
//pages_prepare_parent_breadcrumbs($page);
//elgg_push_breadcrumb($page->title, $page->getURL());
//elgg_push_breadcrumb(elgg_echo('pages:history'));

$title = $page->title . ": " . elgg_echo('pages:history');

//$content = elgg_list_annotations(array(
//		'guid' => $page_guid,
//		'annotation_name' => 'bitacora',
//		'limit' => 20,
//		'order_by' => "n_table.time_created desc"
//));

$anotations = elgg_get_annotations(array(
		'guid' => $page_guid,
		'annotation_name' => 'bitacora',
		'limit' => 20,
		'order_by' => "n_table.time_created desc"
));

elgg_load_css('grupos');
elgg_load_css('logged');
elgg_load_css('bitacoras');

$cuaderno = elgg_get_relationship_inversa($page, 'tiene_la_bitacora');
$grupo = elgg_get_relationship_inversa($cuaderno[0], 'tiene_cuaderno_campo');
$grup = new ElggGrupoInvestigacion($grupo[0]->guid);

$vector['anotations']= $anotations;
$vector['page']=$page;
$content.= elgg_view('bitacoras/listar_historial', $vector);
$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grup)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grupo)); 

