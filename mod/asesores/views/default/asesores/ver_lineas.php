<?php

/**
 * Vista donde se administran las líneas temáticas del asesor
 * @author DIEGOX_CORTEX
 */
$asociadas = $vars['lineas_as'];
$desasociadas = $vars['lineas_sin_as'];
$linea = elgg_get_entities_from_relationship(array(
            'relationship' => 'administrador_red',
            'relationship_guid' => $user->guid,
        ))[0];
elgg_load_js('pag/investig_conv');
$user = elgg_get_logged_in_user_entity();
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 12;
if (!$ajax) {
    $guid_conv = $vars['guid_convocatoria'];
    $convocatoria = get_entity($guid_conv);
    echo "";
    $header = "<div class='titulo-coordinacion'>";
    $header .="<h2>Línea Temática: $linea->name</h2>";
    $header.="</div>";
    echo $header;
    echo "<div id='paginable' class='elgg-image-block clearfix'><br><br>";
    echo elgg_get_investigaciones_asignadas_usuario2_red($linea->guid, 'pertenece_a_red', 'asesores/lista_investigaciones_red');
    echo "</div>";
} else {
    $guid = get_input('guid');
    echo elgg_get_investigaciones_asignadas_usuario2_red($linea->guid, 'pertenece_a_red', 'asesores/lista_investigaciones_red');
}
