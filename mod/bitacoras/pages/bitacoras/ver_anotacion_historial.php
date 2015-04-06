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


elgg_load_css('grupos');
elgg_load_css('logged');
elgg_load_css('bitacoras');

$cuaderno = elgg_get_relationship_inversa($page, 'tiene_la_bitacora');
$grupo = elgg_get_relationship_inversa($cuaderno[0], 'tiene_cuaderno_campo');
$grup = new ElggGrupoInvestigacion($grupo[0]->guid);

$vector['anotations']= $anotations;
$vector['page']=$page;
$vector['anotacion']=get_input('anot');
$content.= elgg_view('bitacoras/ver_anotacion_historial', $vector);
$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grup)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grupo)); 

