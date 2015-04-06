<?php
/**
 * Edit/create a group wrapper
 *
 * @uses $vars['entity'] ElggGroup object
 */

$entity = elgg_extract('entity', $vars, null);

$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt',
);

echo elgg_view_form('grupo_investigacion/register', $form_vars, grupo_investigacion_prepare_form_vars($entity));
