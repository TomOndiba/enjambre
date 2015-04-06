<?php
/**
 * Barra de estado View
 * 
 * Vista que muestra la barra de publicaciones de estado, imagenes y encuestas para grupos
 */
?>

<?php
elgg_load_js('control_estado');
elgg_load_js('ver_mas');
$owner = $vars['owner'];
$user = elgg_get_logged_in_user_guid();
$button_publicar = elgg_view('input/submit', array(
    'value' => elgg_echo('post'),
    'class' => 'button-publicar',
    'id'=>'add-post',
        ));
?>
<div class="estado">
    <ul class="lista-estado">
        <li><a onclick="mostrarComentario();">Publicar</a></li>
        <li><a onclick="mostrarFoto();">Foto</a></li>
    </ul>
    <div class="form-estado">

        <div id="comentar" class="internal-box" >
            <?php
            $owner = $vars['owner'];
            //elgg_is_miembro_admin($guid, $user) && !check_entity_relationship($user, "usuario_desactivado_de", $guid)
            
            if (elgg_is_logged_in()) {
                echo elgg_view_form('messageboard/add', array('name' => 'elgg-messageboard'), array('guid' => $owner->guid));
            }
            ?>
            <?php echo $button_publicar . "<br>"; ?>
            <br>
        </div>
        <div id="foto" class="internal-box hide">
            <?php
            $owner = $vars['owner'];
            if (elgg_is_logged_in()) {
                $form_vars = array('enctype' => 'multipart/form-data');
                echo elgg_view_form('profile/add_image', $form_vars, array('entity' => $owner));
            }
            ?>
        </div>

    </div>
    <ul class="lista-estado" style="height: 25px; margin-top: -2px;">

    </ul>

</div>
