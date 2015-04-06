<?php
$experiencia = get_input('experiencia');
$experiencia_docente = get_input('experiencia_docente');
$user = elgg_get_logged_in_user_entity();
$hoja_de_vida = elgg_get_hoja_de_vida($user->guid);
$hoja = new ElggHojaDeVida($hoja_de_vida);
if ($hoja->experiencia != $experiencia) {
    $options = array(
        'guid' => $hoja->guid,
        'metadata_name' => 'experiencia',
        'limit' => false
    );
    $g = elgg_delete_metadata($options);
    if (!is_null($experiencia) && ($experiencia!== '')) {
        create_metadata($hoja->guid, 'experiencia', $experiencia, 'text', $user->guid, ACCESS_PUBLIC);
    }
}
if ($hoja->experiencia_docente != $experiencia_docente) {
    $options = array(
        'guid' => $hoja->guid,
        'metadata_name' => 'experiencia_docente',
        'limit' => false
    );
    $g = elgg_delete_metadata($options);
    if (!is_null($experiencia_docente) && ($experiencia_docente!== '')) {
        create_metadata($hoja->guid, 'experiencia_docente', $experiencia_docente, 'text', $user->guid, ACCESS_PUBLIC);
    }
}
$hoja->save();
$site = elgg_get_site_url();
echo"{$site}asesores/hojadevida";
