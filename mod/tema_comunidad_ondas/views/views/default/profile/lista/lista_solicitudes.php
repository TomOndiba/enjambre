

<h2 class="title-legend">Solicitudes de Amistad</h2>
<ul class="lista-usuarios">
    <?php
    $entities = $vars['entities'];
    $guid = $vars['guid'];

    if (!$entities) {
        echo "<div class='mensaje-vacio'><h2>No tienes solicitudes de amistad.</h2></div>";
    } else {
        foreach ($entities as $entity) {
            $entity_data = array("entity" => $entity, "guid" => $guid);
            echo elgg_view("profile/lista/item_sol", $entity_data);
        }
    }
    ?>
</ul>
