<?php

$entities = $vars['entities'];
$url=  elgg_get_site_url();
$pestañas="<ul class='tabs-coordinacion'>
                <li id='aceptados' class='selected'><a href='".$url."asesores/asesores_aceptados' name='banco' rel='nofollow'>Asesores Aceptados</a></li>
                <li id='preinscritos'><a href='".$url."asesores/asesores_preinscritos' name='preinscritos' rel='nofollow'>Asesores Preinscritos</a></li>
            </ul><br>";
$contenido_tabla.="<ul class='list-usuarios'>";
foreach ($entities as $entity) {
    $entity_data = array("entity" => $entity);
    $contenido_tabla.=elgg_view("asesores/lista/item", $entity_data);
}
$contenido_tabla.="</ul>";

if (sizeof(sizeof($entities))) {
    echo $pestañas;
    echo $contenido_tabla;
} else {
    echo $pestañas;
    echo "<br><br><i>No hay maestros aceptados como asesores</i>";
}