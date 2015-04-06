<?php

$entities = $vars['entities'];

if (!$entities) {
    echo "<div class='mensaje-vacio'><h2>No existen integrantes</h2></div>";
} else {
    echo "<ul class='list-usuarios'>";
    foreach ($entities as $entity) {

        $entity_data = array("entity" => $entity);
        echo elgg_view("grupo_investigacion/integrantes/item", $entity_data);
    }
    echo "</ul>";
}
