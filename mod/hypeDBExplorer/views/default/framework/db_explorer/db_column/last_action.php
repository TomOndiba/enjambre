<?php

$data = elgg_extract('data', $vars);
$value = $data->last_action;

echo elgg_view('framework/db_explorer/template/time', array(
	'value' => $value
));