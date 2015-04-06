<?php

$guid = $vars['guid'];
$query = array(
    'annotation_name' => 'like_comentario',
    'reverse_order_by' => true,
    'limit' => 100,
    'wheres' => " n_table.entity_guid=$guid "
);
$likes = elgg_get_annotations_to_annotations($query);
$msj="";
$button_like="";
$array_likes= array();
foreach($likes as $like){
            $num_likes++;
            array_push($array_likes, array('guid'=>$like->owner_guid));
        }
$json = json_encode($array_likes);
$view= elgg_get_site_url()."ajax/view/info/likes?guids={$json}&id=$guid";
if ($num_likes > 0) {
    $msj = "<a class='informacion-user' tooltip-view='{$view}' >A " . $num_likes . " les gusta esto.</a>";
}
$id=elgg_user_comento($likes);
if (!$id) {
    $button_like = "<a title='$guid' id='link-like-anotacion'>Me gusta</a>. ";
} else {
    $button_like = "<a title='$id' class='$guid' id='link-no-like-anotacion'>Ya no me gusta</a>.";
}
?>
<div class='like-anotacion-<?php echo $guid;?>'>
    <span><?php echo $button_like;?></span>
    <span><?php echo $msj;?></span>
</div>