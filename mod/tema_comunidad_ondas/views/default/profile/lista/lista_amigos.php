

<h2 class="title-legend">Listado de Amigos</h2>
<ul class="lista-usuarios">
    <?php
    $entities = $vars['entities'];
    $guid = $vars['guid'];

    if (!$entities) {
        echo "<div class='mensaje-vacio'><h2>No tiene amigos asociados aún...</h2></div>";
    } else {
        foreach ($entities as $entity) {
            $entity_data = array("entity" => $entity, "guid" => $guid);
            echo elgg_view("profile/lista/item", $entity_data);
        }
    }
    ?>
</ul>
