<ul class="list-usuarios">
    <?php
    $url=  elgg_get_site_url();
    $pestañas="<ul class='tabs-coordinacion'>
                    <li id='aceptados'><a href='".$url."evaluadores/evaluadores_aceptados' name='banco' rel='nofollow'>Evaluadores Aceptados</a></li>
                    <li id='preinscritos' class='selected'><a href='".$url."evaluadores/evaluadores_preinscritos' name='preinscritos' rel='nofollow'>Evaluadores Preinscritos</a></li>
                </ul>";
    $entities = $vars['entities'];
    $contenido_tabla = "";
    foreach ($entities as $entity) {
        $entity_data = array("entity" => $entity);
        $contenido_tabla.=elgg_view("evaluadores/lista_preinscritos/item_preinscritos", $entity_data);
    }
    if (sizeof($entities) != 0) {
        echo $pestañas;
        echo $contenido_tabla;
    } else {
        echo $pestañas;
        echo "<br><br><i>No hay maestros preinscritos para ser evaluadores</i>";
    }
    ?>
</ul>
