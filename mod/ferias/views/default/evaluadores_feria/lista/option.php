<?php

elgg_load_js('confirmacion_feria');

$guid = $vars['guid'];
$guid_feria = $vars['guid_feria'];
$lista;

$user = elgg_get_logged_in_user_entity();
$url1 = elgg_get_site_url() . "action/evaluadores/aceptar_evaluador_feria?guid_ev=" . $guid . "&guid_fer=" . $guid_feria;
$url_aceptar = elgg_add_action_tokens_to_url($url1);
$lista.='<a href=\'' . $url_aceptar . '\'>Aceptar</a>';

echo <<<HTML
    $lista

HTML;

