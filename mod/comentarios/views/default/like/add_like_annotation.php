
<?php
/**
 * Elgg Message board: add message action
 *
 * @package ElggMessageBoard
 */
echo elgg_view('vistas/js');
$anotacion = get_input("anotacion");
$user = elgg_get_logged_in_user_entity();
if ($anotacion) {
    $result = add_like_annotation($user, $anotacion, $message_content, ACCESS_PUBLIC);
    if ($result) {
        error_log("resultadooo: $result");
        $options = array(
            'annotation_name' => 'like_comentario',
            'reverse_order_by' => true,
            'limit' => 100,
            'wheres' => " n_table.entity_guid=$anotacion "
        );
        $likes = elgg_get_annotations_to_annotations($options);
        $msj = "";
        $button_like = "";
        $num_likes = 0;
        $array_likes = array();
        foreach ($likes as $like) {
            $num_likes++;
            array_push($array_likes, array('guid' => $like->owner_guid));
        }
        $json = json_encode($array_likes);
        $var="&id=$anotacion";
        $view = elgg_get_site_url() . "ajax/view/info/likes?guids={$json}&id={$anotacion}";
        if ($num_likes > 0) {
            $msj = "<a class='informacion-user' tooltip-view='{$view}' >A " . $num_likes . " les gusta esto.</a>";
        }
        $id = elgg_user_comento($likes);
        if (!$id) {
            $button_like = "<a title='$anotacion' id='link-like-anotacion'>Me gusta</a>. ";
        } else {
            $button_like = "<a title='$id' class='$anotacion' id='link-no-like-anotacion'>Ya no me gusta</a>. ";
        }
    }
    error_log($msj);
}
?>
    <span><?php echo $button_like; ?></span>
    <span><?php echo $msj; ?></span>
