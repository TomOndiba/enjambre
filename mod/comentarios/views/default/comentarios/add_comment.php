
<?php

/**
 * Elgg Message board: add message action
 *
 * @package ElggMessageBoard
 */
$message_content = get_input('comentario');
$owner_guid = get_input("entity");
$owner = get_entity($owner_guid);
$user = elgg_get_logged_in_user_entity();
if ($owner && !empty($message_content)) {
    $result = add_comentario_entity($user, $owner, $message_content, ACCESS_PUBLIC);
    if ($result) {
        system_message(elgg_echo("messageboard:posted"));
        $options = array(
            'annotation_name' => 'comentario',
            'guid' => $owner_guid,
            'wheres' => " n_table.entity_guid=$owner_guid",
            'reverse_order_by' => true,
            'limit' => 1,
        );
        $comentario = elgg_get_annotations($options)[0];
        $lista_comentarios = "";
        $like= elgg_view('like/like_annotation', array('guid'=>$comentario->id));
        $opciones = "";
        $owner_guid = $comentario->owner_guid;
        $owner = get_entity($owner_guid);
        $owner_name = $owner->name . " " . $owner->apellidos;
        $site_url=  elgg_get_site_url();
        $friendlytime = elgg_view_friendly_time($comentario->time_created);
        $lista_comentarios.="<li><div>";
        $lista_comentarios.="<a href='{$site_url}profile/{$owner->username}'><img src='{$owner->getIconURL()}'/></a>"
                . "<div class='info-comment'><a href='{$site_url}profile/{$owner->username}'><span>{$owner_name}</span></a><br><span>{$friendlytime}</span></div>"
                . "<div class='contenido-comentario'><span>$comentario->value</span></div>"
                . ""
                . "</div><div class='me-gusta-comentarios'>{$like}</div>";
        echo $lista_comentarios.= "</li>";
    } else {
        echo "error";
    }
}

