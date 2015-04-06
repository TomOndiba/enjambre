
<?php
/**
 * Elgg Message board: add message action
 *
 * @package ElggMessageBoard
 */
$annotation = get_input("anotacion");
$owneer = get_input("owner");
if ($annotation) {
    $conexion = mysql_connect("104.131.19.127", "root", "elgg2014");
    mysql_select_db("enjambre", $conexion);
    mysql_query("SET NAMES 'utf8'");
    error_log("ann=$annotation");
    $sql = "DELETE FROM elgg_annotations WHERE id=$annotation";
    error_log($sql);
    $result = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
    if ($result) {
        $options = array(
            'annotation_name' => 'like_comentario',
            'reverse_order_by' => true,
            'limit' => 100,
            'wheres' => " n_table.entity_guid=$owneer"
        );
        $likes = elgg_get_annotations_to_annotations($options);
        error_log(count($likes) . "total");
        $msj = "";
        $button_like = "";
        $num_likes = 0;
        $array_likes = array();
        foreach ($likes as $like) {
            $num_likes++;
            array_push($array_likes, array('guid' => $like->owner_guid));
        }
        $json = json_encode($array_likes);
        $view = elgg_get_site_url() . "ajax/view/info/likes?guids={$json}&id=$owneer";
        if ($num_likes > 0) {
            $msj = "<a class='informacion-user' tooltip-view='{$view}' >A " . $num_likes . " les gusta esto.</a>";
        }
        $id = elgg_user_comento($likes);
        if (!$id) {
            $button_like = "<a title='$owneer' id='link-like-anotacion'>Me gusta</a>.  ";
        } else {
            $button_like = "<a title='$id' id='link-no-like-anotacion'>Ya no me gusta</a>. ";
        }
    }
}
?>
<span><?php echo $button_like; ?></span>
<span><?php echo $msj; ?></span>

