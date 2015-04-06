<?php

$datos = get_input('datos');
$publicaciones= get_input('publicaciones');
$user = elgg_get_logged_in_user_entity();
$hoja_de_vida = elgg_get_hoja_de_vida($user->guid);
$hoja = new ElggHojaDeVida($hoja_de_vida);
if ($hoja->ponencias != $datos) {
    $options = array(
        'guid' => $hoja->guid,
        'metadata_name' => 'ponencias',
        'limit' => false
    );
    $g = elgg_delete_metadata($options);
    if (!is_null($datos) && ($datos!== '')) {
        create_metadata($hoja->guid, 'ponencias', $datos, 'text', $user->guid, ACCESS_PUBLIC);
    }
}
if ($hoja->publicaciones != $publicaciones) {
    $options = array(
        'guid' => $hoja->guid,
        'metadata_name' => 'publicaciones',
        'limit' => false
    );
    $g = elgg_delete_metadata($options);
    if (!is_null($publicaciones) && ($publicaciones!== '')) {
        create_metadata($hoja->guid, 'publicaciones', $publicaciones, 'text', $user->guid, ACCESS_PUBLIC);
    }
}
$hoja->save();
$site = elgg_get_site_url();
echo"{$site}asesores/hojadevida";
