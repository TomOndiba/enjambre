<?php

/** Vista que permite mostrar todas las investigaciones de convocatoria que fueron asignadas al asesor */
$entities = $vars['entities'];
$user = elgg_get_logged_in_user_entity();
$url = elgg_get_site_url();
elgg_load_js('reveal2');

echo "<div class='contenedor-button'><a class='link-button' href='{$url}asesores/cronograma'>Jornadas de Asesoria</a></div>";
$tabla_inv = "<ul class='lista-investigaciones-asesor'>";
if (!$entities) {
    echo "<b>No tiene asignadas Investigaciones</b>";
} else {

    foreach ($entities as $entity) {

        $url = "investigaciones/ver/{$entity->guid}/asesor_convocatoria/$user->guid/{$guid_conv}";
        $params = array(
            'text' => elgg_view('output/longtext', array('value' => $entity->name)),
            'href' => $url,
            'is_trusted' => true,
        );
        $title_link = elgg_view('output/url', $params);

        // Busca la relacion del grupo con la investigacion  para enviar datos al formulario de registro y actualización
        $grupo = elgg_get_relationship_inversa($entity, "tiene_la_investigacion");

        if (check_entity_relationship($grupo[0]->guid, "tiene_la_investigacion", $entity->guid)) {
            // Busca la relacion del grupo con la institución  para enviar datos al formulario de registro y actualización
            $institucion = elgg_get_relationship($grupo[0], "pertenece_a");
        }

        $url = elgg_get_site_url();
        //$url_cronograma=$url."asesores/investigaciones/{$entity->guid}/cronograma_conv/$user->guid/{$conv_ins[0]->guid}";
        $url_cronograma_red = $url . "asesores/asesorias/cronograma/red/{$entity->guid}/{$vars['linea']}";
        $tabla_inv.="<li>"
                . "<div class='titulo-investigacion'>{$title_link}</div>"
                . "<div class='info-investigacion-item'>"
                . "<div class='row'>Grupo de Investigación: <a href='{$url}grupo_investigacion/ver/{$grupo[0]->guid}'>{$grupo[0]->name}</a><br>"
                . "Institución: <a href='{$url}instituciones/ver/{$institucion[0]->guid}'>{$institucion[0]->name}</a></div>"
                . "</li>";
    }
    $tabla_inv.="</ul>";
    echo $tabla_inv;
}
?>

