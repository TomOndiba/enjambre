<?php
/**
 * Page prepara los datos necesarios para llevarlos al formulario de enviar mensaje.
 * 
 * @author DIEGOX_CORTEX
 */

gatekeeper();

$page_owner = elgg_get_logged_in_user_entity();
elgg_set_page_owner_guid($page_owner->getGUID());
$guid_convocatoria = get_input('id_conv');
$convoctoria = get_entity($guid_convocatoria);
$title = elgg_echo('messages_evaluador:add');

elgg_push_breadcrumb($title);

$params = messages_evaluador_prepare_form_vars((int)get_input('send_to'));

$params['friends'] = elgg_get_evaluadores();

$params['nombre_convocatoria'] = $convoctoria->name;
$params['url'] = elgg_get_site_url().'convocatorias/detalles/'.$guid_convocatoria;
 
$content = elgg_view_form('messages_evaluador/send', array(), $params);

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
));

echo elgg_view_page($title, $body);
