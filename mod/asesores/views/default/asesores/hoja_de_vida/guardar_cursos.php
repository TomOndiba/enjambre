<?php

$datos = get_input('datos');
$user = elgg_get_logged_in_user_entity();
$hoja_de_vida = elgg_get_hoja_de_vida($user->guid);
$hoja = new ElggHojaDeVida($hoja_de_vida);
if ($hoja->cursos_terminados != $datos) {
    $options = array(
        'guid' => $hoja->guid,
        'metadata_name' => 'cursos_terminados',
        'limit' => false
    );
    $g = elgg_delete_metadata($options);
    if (!is_null($datos) && ($datos!== '')) {
        create_metadata($hoja->guid, 'cursos_terminados', $datos, 'text', $user->guid, ACCESS_PUBLIC);
    }
}
$hoja->save();
$site = elgg_get_site_url();
echo"{$site}asesores/hojadevida";
