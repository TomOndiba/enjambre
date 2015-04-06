<?php
/**
 * Group profile summary
 *
 * Icon and profile fields
 *
 * @uses $vars['group']
 */
elgg_load_js('ver_mas');
elgg_load_js("ajax_comentarios");
$guid = get_input('guid_red');
$red = new ElggFeria($guid);


$owner = $red->getOwnerEntity();
$rol = elgg_is_miembro_en_red_tematica($red->guid, elgg_get_logged_in_user_entity()->guid);
$options = array('guid' => $red->guid, "rol_user" => $rol);
$array = array("owner" => $red, "permiso_add_message" => true);
$query = array(
    'annotation_name' => 'messageboard',
    'guid' => $red->guid,
    'limit' => 12,
    'offset'=>0,
    'wheres' => " n_table.entity_guid=$guid",
    'reverse_order_by' => true,
);


?>
<div class="profile-grupo-right">

    <div class="message-board-grupo-investigacion">
        <?php
        if (elgg_is_logged_in() && $array['permiso_add_message']) {
            //echo elgg_view_form('messageboard/add', array('name' => 'elgg-messageboard'), array('guid' => $group->guid));
            echo elgg_view("profile/estado", array('owner'=>$red));
        }
        ?>
    </div>
    <div id="message-board-body">
    <?php
     echo elgg_get_messageboard_grupo_investigacion($query,true);
    ?>
    </div>
</div>











