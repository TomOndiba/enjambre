
<?php
/**
 * Elgg Message board: add message action
 *
 * @package ElggMessageBoard
 */
echo elgg_view('vistas/js');
$owner_guid = get_input("entity");
$owner = get_entity($owner_guid);
$user = elgg_get_logged_in_user_entity();
if ($owner) {
    $result = add_like_entity($user, $owner, $message_content, ACCESS_PUBLIC);
    if ($result) {
        $options = array(
            'annotation_name' => 'like',
            'guid' => $owner_guid,
            'wheres' => " n_table.entity_guid=$owner_guid",
            'reverse_order_by' => true,
        );
        $likes = elgg_get_annotations($options);
        $msj = "";
        $button_like = "";
        $num_likes = 0;
        $array_likes = array();
        foreach ($likes as $like) {
            $num_likes++;
            array_push($array_likes, array('guid' => $like->owner_guid));
        }
        $json = json_encode($array_likes);
        $view = elgg_get_site_url() . "ajax/view/info/likes?guids={$json}&id=$owner_guid";
        if ($num_likes > 0) {
            $msj = "<a class='informacion-user' tooltip-view='{$view}' >A " . $num_likes . " les gusta esto.</a>";
        }
        $id = elgg_user_comento($likes);
        if (!$id) {
            $button_like = "<a title='$owner_guid' id='link-like'>Me gusta</a>.  ";
        } else {
            $button_like = "<a title='$id' id='link-no-like'>Ya no me gusta</a>. ";
        }
    }
}
?>
<div class='like-entity'>

    <span><?php echo $button_like; ?></span>
    <span><?php echo $msj; ?></span>
</div>