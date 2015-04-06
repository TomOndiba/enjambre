
<?php
/**
 * Elgg Message board: add message action
 *
 * @package ElggMessageBoard
 */
$annotation = get_input("id");
if ($annotation) {
    $annotat = new ElggAnnotation($annotation);
    $owner_guid= $annotat->entity_guid;
    $result = $annotat->delete();
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
        foreach ($likes as $like) {
            $num_likes++;
        }
        if ($num_likes > 0) {
            $msj = "<a>A " . sizeof($likes) . " les gusta esto.</a>";
        }
        $id = elgg_user_comento($likes);
        if (!$id) {
            $button_like = "<a title='$owner_guid' id='link-like-anotacion'>Me gusta</a>. ";
        } else {
            $button_like = "<a title='$id' id='link-no-like-anotacion'>Ya no me gusta</a>. ";
        }
    }
}
?>
<div class='like-entity'>
    <span><?php echo $button_like; ?></span>
    <span><?php echo $msj; ?></span>
</div>