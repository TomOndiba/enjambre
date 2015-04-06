<ul>
    <?php
    elgg_load_js(acciones);
    $entities = $vars['entities'];

    
    if (!$entities) {
        echo "<br><br><br><b>No se han registrado Ferias</b>";
    } else {

        foreach ($entities as $entity) {

            $red = new ElggFeria($entity->guid);

            $title_link = elgg_extract('title', $vars, '');
            $url = 'feria/ver/' . $entity->guid;
            $absolute_url = elgg_get_site_url() . $url;

            if ($title_link === '') {
                if (isset($entity->title)) {
                    $text = $entity->title;
                } else {
                    $text = $entity->name;
                }

                $params = array(
                    'text' => elgg_get_excerpt($text, 100),
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
                $subtittle = "<p>La feria no tiene miembros<p>";
            }


            $lista;
            $user = elgg_get_logged_in_user_entity();

            $url = elgg_get_site_url() . "action/feria/eliminar?id=" . $red->guid;
            $href = elgg_add_action_tokens_to_url($url);


            ?>
        <li>
            <div class="imagen-grupo">
                <a href="<?php echo $absolute_url; ?>"> <img src="<?php echo $url_icono; ?>"/></a>
            </div>
            <div class="nombre-grupo">
                <h4><?php echo $title_link; ?></h4>
            </div>
        </li>
        <?php
            
        }
        
    }
    ?>
</ul>
