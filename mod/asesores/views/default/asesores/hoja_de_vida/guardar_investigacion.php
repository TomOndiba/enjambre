<?php
$investigacion = get_input('investigacion');
$pertenencia = get_input('pertenencia');
$user = elgg_get_logged_in_user_entity();
$hoja_de_vida = elgg_get_hoja_de_vida($user->guid);
$hoja = new ElggHojaDeVida($hoja_de_vida);
if ($hoja->investigacion != $investigacion) {
    $options = array(
        'guid' => $hoja->guid,
        'metadata_name' => 'investigacion',
        'limit' => false
    );
    $g = elgg_delete_metadata($options);
    if (!is_null($investigacion) && ($investigacion!== '')) {
        create_metadata($hoja->guid, 'investigacion', $investigacion, 'text', $user->guid, ACCESS_PUBLIC);
    }
}
if ($hoja->pertenencia != $pertenencia) {
    $options = array(
        'guid' => $hoja->guid,
        'metadata_name' => 'pertenencia',
        'limit' => false
    );
    $g = elgg_delete_metadata($options);
    if (!is_null($pertenencia) && ($pertenencia!== '')) {
        create_metadata($hoja->guid, 'pertenencia', $pertenencia, 'text', $user->guid, ACCESS_PUBLIC);
    }
}
$hoja->save();
$site = elgg_get_site_url();
echo"{$site}asesores/hojadevida";
