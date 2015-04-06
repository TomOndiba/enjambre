<?php
/**
 * Group profile summary
 *
 * Icon and profile fields
 *
 * @uses $vars['group']
 */
elgg_load_js('ver_mas');
$guid = get_input('guid_grupo');
$group = new ElggGrupoInvestigacion($guid);
$owner = $group->getOwnerEntity();
$rol = elgg_is_miembro_en_grupo_investigacion($group, elgg_get_logged_in_user_entity()->guid);
$options = array('guid' => $group->guid, "rol_user" => $rol);
$array = array("owner" => $group, "permiso_add_message" => $rol);
$query = array(
    'annotation_name' => 'messageboard',
    'guid' => $group->guid,
    'limit' => 12,
    'offset'=>0,
    'wheres' => " n_table.entity_guid=$guid",
    'reverse_order_by' => true,
);


?>


<div class="profile-grupo-left">
    
    <?php
    echo elgg_view('grupo_investigacion/encuestas/encuesta', array('grupo' => $group));
    ?>
    <div class="grupo-investigacion-miembros box">
        <div class='tittle-box'>Miembros</div>
        <div class="lista-miembros-imagenes">
            <?php
            echo elgg_view('grupo_investigacion/profile/members', $options);
            ?></div>
    </div>
    <?php
            echo elgg_view('grupo_investigacion/institucion_grupo/institucion', $options);
    ?>
    
</div>


<div class="profile-grupo-right">

    <div class="message-board-grupo-investigacion box">
        <div class="tittle-box">Publicaciones</div>
        <?php
        if (elgg_is_logged_in() && $array['permiso_add_message']) {
            //echo elgg_view_form('messageboard/add', array('name' => 'elgg-messageboard'), array('guid' => $group->guid));
            echo elgg_view("profile/estado", array('owner'=>$group));
        }
        ?>
    </div>
    <div id="message-board-body">
    <?php
     echo elgg_get_messageboard_grupo_investigacion($query,true);
    ?>
    </div>

</div>









