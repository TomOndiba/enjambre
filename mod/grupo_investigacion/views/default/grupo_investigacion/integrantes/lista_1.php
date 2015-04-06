<?php

$entities = $vars['entities'];
$guid_grupo = $vars["grupo"];

if (!$entities) {
    echo "<div class='mensaje-vacio'><h2>No existen integrantes</h2></div>";
} else {
    echo "<ul class='list-usuarios'>";
    // Muestra el administrador 



    foreach ($entities as $entity) {

        $entity_data = array("entity" => $entity, "grupo" => $guid_grupo);
        echo elgg_view("grupo_investigacion/integrantes/item_1", $entity_data);
    }
    echo "</ul>";
}
