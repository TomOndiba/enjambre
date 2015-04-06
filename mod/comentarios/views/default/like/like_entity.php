<?php

$guid = $vars['guid'];
$query = array(
    'annotation_name' => 'like',
    'guid' => $guid,
    'wheres' => " n_table.entity_guid=$guid",
    'reverse_order_by' => true,
);
$likes = elgg_get_annotations($query);
$array_likes= array();
$msj="";
$button_like="";
$num_likes=0;
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
    $button_like = "<a title='$guid' id='link-like'>Me gusta</a>. ";
} else {
    $button_like = "<a title='$id' id='link-no-like'>Ya no me gusta</a>. ";
}
?>
<div class='like-entity'>
    <span><?php echo $button_like;?></span>
    <span><?php echo $msj;?></span>
</div>
