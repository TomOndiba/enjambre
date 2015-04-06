<?php

$ajax = get_input("ajax");
$relacion = get_input('relacion');
$guid_feria = get_input('feria');
$feria = new ElggFeria($guid_feria);

if (!$ajax) {
    $relacion_input = elgg_view('input/hidden', array('id' => 'relacion', 'value' => $relacion));

    $url1 = elgg_get_site_url() . "action/ferias/notificar_finalistas?id_feria=$guid_feria";
    $url_notificar = elgg_add_action_tokens_to_url($url1);
    
    echo "$titulo <br />"
    . "<div class='link-button'><a href='$url_notificar' class='link-button'>Notificar a finalistas</a></div><br>"
    . $feria_input . $relacion_input . "<div id='investigaciones'>";
    echo elgg_get_investigaciones_feria(15, 0, $guid_feria, $relacion);
    echo "</div>";
} else {
    $investigaciones = elgg_get_investigaciones_feria(15,$offset, $guid_feria, $relacion);
    echo $investigaciones;
}