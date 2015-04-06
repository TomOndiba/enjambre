<?php
echo elgg_view('vistas/js');
$annotation = $vars['annotation'];
$notification = $vars['notification'];
$nuevo = $vars['nuevo'];
$owner = get_entity($annotation->owner_guid);
if (!$owner) {
    return true;
}
$cerrar_div = "";
if ($nuevo) {
    $cerra_div = "</div>";
}
$view = elgg_get_site_url() . "ajax/view/info/user?guid={$owner->guid}";
$icon = $owner->getIconURL();
$owner_link = "<a class='informacion-user' tooltip-view='{$view}' href=\"{$owner->getURL()}\">$owner->name $owner->apellidos</a>";
$aux = "";
if ($notification) {
    $site_url= elgg_get_site_url();
    $wall = get_entity($annotation->entity_guid);
    if ($wall->type == "group") {
        $subtype = $wall->getSubtype();
        if ($subtype == "grupo_investigacion") {
            $url = "grupo_investigacion/ver/";
        } else if ($subtype == "institucion") { 
            $url = "instituciones/ver/";
        } else if ($subtype == "red_tematica") {
            $url = "redes_tematicas/ver/";
        }
       $urlResult="<a href='{$site_url}{$url}{$wall->guid}'>{$wall->name}</a>"; 
    } else {
        $urlResult = "<a href='{$site_url}profile/{$wall->username}'>&nbsp;&nbsp;&nbsp;{$wall->name} {$wall->apellidos}</a>";
    }
    $icon_wall = "<img src='{$wall->getIconURL("small")}' style='margin-top:-7px;height: 35px;border-radius: 15%;'/>";
    $wall_link = $urlResult;
    $aux = "<div class='icon-post'></div>" . $icon_wall . $wall_link;
}
if ($owner->guid == elgg_get_logged_in_user_guid() || $annotation->entity_guid == elgg_get_logged_in_user_guid()) {
    $link_eliminar = '<div class="icon-delete" data-tooltip="Elimnar Publicacion" onclick="eliminarPost(' . $annotation->id . ')"></div>';
}
$guid = $annotation->id;
$text = $annotation->value;
$text_comentario = elgg_view_form('messageboard/comment', null, array('guid' => $guid));
$query = array(
    'annotation_name' => 'comment_messageboard',
    'reverse_order_by' => false,
    'limit' => 100,
    'wheres' => " n_table.entity_guid=$guid "
);
$options = array('query' => $query, "view" => 'messageboard/comment/ver_comentarios');
$text_comentarios = elgg_get_comments_post($options);
$friendlytime = elgg_view_friendly_time($annotation->time_created);
$comment = elgg_view_comments($annotation, true);
$likes = elgg_view('like/like_annotation', array('guid' => $annotation->id));
?>
<div class="post-messageboard" id-post="<?php echo $guid ?>">
<?php echo $link_eliminar ?>
    <div class="header-post-messageboard">
        <img src="<?php echo $icon; ?>"/>
        <div><?php echo $owner_link; ?><?php echo $aux ?><br>
            <span><?php echo $friendlytime ?></span>
        </div>
    </div>
    <div class="contenido-post-messageboard">
        <p><?php echo $text; ?> </p><br>
        <div style="width: 90%; margin-left: -15px;"><?php echo $likes; ?></div>
    </div>

    <div class="comentarios-post" id="<?php echo $guid; ?>">

<?php echo $text_comentarios; ?>
    </div>

<?php echo $text_comentario; ?>
</div>

