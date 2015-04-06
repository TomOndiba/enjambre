<?php
/**
 * Edit/create una red Tematica wrapper
 *
 * @uses $vars['entity'] ElggGroup object
 */

$entity = elgg_extract('entity', $vars, null);

$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt',
);

echo elgg_view_form('redes_tematicas/register', $form_vars, red_tematica_prepare_form_vars($entity));
