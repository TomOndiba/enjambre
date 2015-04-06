<ul>
    <?php
    elgg_load_js(acciones);
    $entities = $vars['entities'];

    if (!$entities) {
        echo "<div class='mensaje-vacio'><h2>No se han registrado Redes Temáticas</h2></div>";
    } else {

        foreach ($entities as $entity) {

            $red = new ElggRedTematica($entity->guid);

            $title_link = elgg_extract('title', $vars, '');
            $url = 'redes_tematicas/ver/' . $entity->guid;
            $absolute_url = elgg_get_site_url() . $url;

            if ($title_link === '') {
                if (isset($entity->title)) {
                    $text = $entity->title;
                } else {
                    $text = $entity->name;
                }

                $titulo = mb_substr(elgg_get_excerpt($text, 100), 0, 60, 'UTF-8');
                $params = array(
                    'text' => $titulo,
                    'href' => $url,
                    'is_trusted' => true,
                );
                $title_link = elgg_view('output/url', $params);
            }
            $url_icono = $red->getIconURL();
            $subtittle = elgg_list_entities_from_relationship(array(
                'relationship' => 'es_miembro_de',
                'relationship_guid' => $red->guid,
                'inverse_relationship' => true,
                'type' => 'user',
                'size' => 'tiny',
                'limit' => 6,
                'list_type' => 'gallery',
                'gallery_class' => 'elgg-gallery-users',
                'pagination' => false
            ));
            if (!$subtittle) {
                $subtittle = "<p>La Red Temática no tiene miembros<p>";
            }


            $lista;
            $user = elgg_get_logged_in_user_entity();

            $url = elgg_get_site_url() . "action/redes_tematicas/eliminar?id=" . $red->guid;
            $href = elgg_add_action_tokens_to_url($url);


            if ($red->owner_guid == $user->guid) {
                $url = 'redes_tematicas/editar/' . $entity->guid;
                $url_editar = elgg_get_site_url() . $url;
                $lista = "<li><a href='$url_editar'>Editar</a></li>";
            }
            if (elgg_is_admin_logged_in() || $owner === $user->guid) {
                $lista.='<li><a onclick="confirmar(\'' . $href . '\')"><span class=\'elgg-icon elgg-icon-delete \'> </span></a></li>';
            }
            ?>
            <li>
                <div class="imagen-grupo">
                    <a href="<?php echo $absolute_url; ?>"> <img src="<?php echo $url_icono; ?>"/></a>
                </div>
                <div class="nombre-grupo" data-tooltip="<?php echo $entity->name?>">
                    <h4><?php echo $title_link; ?></h4>
                </div>
            </li>
            <?php
        }
    }
    ?>
</ul>
