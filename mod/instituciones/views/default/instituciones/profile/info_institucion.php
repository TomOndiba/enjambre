<?php
/**
 * Group profile summary
 *
 * Icon and profile fields
 *
 * @uses $vars['group']
 */
elgg_load_js('ajax_info');
elgg_load_js("ajax_comentarios");
elgg_load_js('autoresize');
$guid = get_input('guid_institucion');
$institucion = new ElggInstitucion($guid);
$owner = $institucion->getOwnerEntity();
$rol = elgg_is_logged_in();
$options = array('guid' => $institucion->guid, "rol_user" => $rol);
$array = array("owner" => $institucion, "permiso_add_message" => $rol);
$query = array(
    'annotation_name' => 'messageboard',
    'guid' => $institucion->guid,
    'limit' => 12,
    'offset' => 0,
    'wheres' => " n_table.entity_guid=$guid",
    'reverse_order_by' => true,
);

?>


<script>

//<![CDATA[
    $(document).ready(function() {
        $('textarea.txt-comment').autoResize({
// Al redimensionar
            onResize: function() {
                $(this).css({opacity: 0.8});
            },
// Llamar efecto despues de redimensionar:
            animateCallback: function() {
                $(this).css({opacity: 1});
                $(this).css({'background-color': '#A39565'});
            },
// Diración de la animación:
            animateDuration: 300,
// Limite en pixeles hasta los que se va a expandir
// pasado el límite genera el scroll tradicional, valor por defecto 1000px
            limit: 300,
// Espacio Extra al final del texto:
            extraSpace: 0
        });

// reseteamos el textarea
        
    });
//]]></script>
<div class="profile-grupo-right">

    <div class="message-board-grupo-investigacion ">
        <?php
        if (elgg_is_logged_in() && $array['permiso_add_message']) {
            //echo elgg_view_form('messageboard/add', array('name' => 'elgg-messageboard'), array('guid' => $group->guid));
            echo elgg_view("profile/estado", array('owner' => $institucion));
        }
        ?>
    </div>
    <div id="message-board-body">
        <?php
        echo elgg_get_messageboard_grupo_investigacion($query, true);
        ?>
    </div>

</div>









