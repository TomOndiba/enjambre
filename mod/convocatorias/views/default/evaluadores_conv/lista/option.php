<?php

elgg_load_js('confirmacion');

$guid = $vars['guid'];
$guid_conv = $vars['guid_conv'];
$lista = "";

$user = elgg_get_logged_in_user_entity();
$url1 = elgg_get_site_url() . "action/evaluadores/aceptar_evaluador?guid_ev=" . $guid . "&guid_conv=" . $guid_conv;
$url_aceptar = elgg_add_action_tokens_to_url($url1);

$lista.='<a href=\'' . $url_aceptar . '\'>Aceptar Evaluador</a>';

echo <<<HTML
    $lista

HTML;

