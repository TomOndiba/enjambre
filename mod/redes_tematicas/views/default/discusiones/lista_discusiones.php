<?php

/** Vista que permite mostrar todas las investigaciones que fueron asignadas al evaluador */
elgg_load_js('confirmacion');

$entities = $vars['entities'];
$tabla_inv = "<ul>";
$user = elgg_get_logged_in_user_entity();
if (!$entities) {
    echo "<div class='mensaje-vacio'> <h2>No tiene Foros</h2></div>";
} else {

    foreach ($entities as $entity) {

        $poster = $entity->getOwnerEntity();
        $poster_guid = $poster->guid;
        $group = $entity->getContainerEntity();
        $excerpt = elgg_get_excerpt($entity->description);
        $site_url = elgg_get_site_url();
        $poster_icon = "<div><a><img src='{$poster->getIconUrl()}' /></a></div>";
        $poster_text = elgg_echo('groups:started', array("<a href='{$site_url}profile/{$poster->username}'>{$poster->name}</a>"));
        $date = elgg_view_friendly_time($entity->time_created);
        $replies_link = '';
        $reply_text = '';
        $num_replies = elgg_get_annotations(array(
            'annotation_name' => 'group_topic_post',
            'guid' => $entity->getGUID(),
            'count' => true,
        ));
        if ($num_replies != 0) {
            $last_reply = $entity->getAnnotations('group_topic_post', 1, 0, 'desc');
            $poster = $last_reply[0]->getOwnerEntity();
            $reply_time = elgg_view_friendly_time($last_reply[0]->time_created);
            $reply_text = elgg_echo('groups:updated', array("<a href='{$site_url}profile/{$poster->username}'>{$poster->name}</a>", $reply_time));
            $replies_link ="Número de Respuestas: ".$num_replies;
        }
        // Creando la Url que dirige a view Discusion
        if ($group->getSubtype() == "grupo_investigacion") {
            $url_foro = elgg_get_site_url() . "grupo_investigacion/discusiones/{$group->guid}/view/$entity->guid";
        } else if ($group->getSubtype() == "institucion") {
            $url_foro = elgg_get_site_url() . "instituciones/discusiones/{$group->guid}/view/$entity->guid";
        } else if ($group->getSubtype() == "feria") {
            $url_foro = elgg_get_site_url() . "feria/discusiones/{$group->guid}/view/$entity->guid";
        } else {
            $url_foro = elgg_get_site_url() . "redes_tematicas/discusiones/{$group->guid}/view/$entity->guid";
        }

       
        $titulo=  mb_substr($entity->title,0,60,'UTF-8');
        $tabla_inv.="<li>"
                . "{$poster_icon}"
                . "<div class='posteador'><a class='poster-foro' href='{$url_foro}'  data-tooltip='{$entity->title}'> {$titulo}</a>"
                . "<br><span>{$poster_text} {$date} </span></div>"
                . "<div class='opciones-foro'><span><b>{$replies_link}</b><br> </span><span class=\"groups-latest-reply\">$reply_text</span> <br>"
                . '</div>'
                . "</li>";
    }
    $tabla_inv.="</ul>";
    $tabla_inv.="";
    echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar el Tema de Discusión?</div>';
    echo $tabla_inv;
}
?>



