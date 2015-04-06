<?php
/**
 * View a file
 *
 * @package ElggFile
 */


/**** Prepara las variables que se muestran en el Header de la Red tematica************/
elgg_load_css('logged');

$id=  get_input('guid');
$institucion = new ElggInstitucion($id);

$user = elgg_get_logged_in_user_entity();


 
 //$content = elgg_view('redes_tematicas/profile/header', $params);
 

  /***Prepara y llama la vista que muestra el archivo ****/
 elgg_load_library('elgg:file');
 
 
// create form
$form_vars = array('enctype' => 'multipart/form-data');
$body_vars = file_prepare_form_vars();
$body_vars['container_guid']=$institucion->guid;


gatekeeper();
group_gatekeeper();

$file = get_entity(get_input('guid_file'));
if (!$file) {
	register_error(elgg_echo('noaccess'));
	$_SESSION['last_forward_from'] = current_page_url();
	forward('');
}

$owner = elgg_get_page_owner_entity();


$title = $file->title;

$content.= elgg_view('archivos/ver_archivo', array('file' =>$file));
//$content .= elgg_view_comments($file);

$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$institucion)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$institucion)); 
