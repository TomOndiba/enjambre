

<?php

elgg_load_js('pagination/cuadernos');
elgg_load_js("reveal2");
elgg_load_css('reveal');
elgg_load_js('validate');

$guid = $vars['grupo']['guid'];

$grupo = new ElggGrupoInvestigacion($guid);

$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 8;
$site_url = elgg_get_site_url();




if (!$ajax) {
    
    echo '<div class="list-grupos" style="margin-left: 20px; margin-top: 25px">
    <h2 class="title-legend">Iniciativas de Investigación</h2>';
    
    $user= elgg_get_logged_in_user_guid();
    $user2=  elgg_get_logged_in_user_entity();
    if(elgg_is_miembro_admin($guid, $user) && !check_entity_relationship($user, "usuario_desactivado_de", $guid)&& $user2->getSubtype()=="maestro"){
    echo '<div class="contenedor-button"> <a class="link-button" href="#" data-reveal-id="myModal" onclick=\' getCrearCuaderno("' . $guid . '")  \'>Nueva Iniciativa</a></div>';
    }
    
    echo "<div id='paginable' class='elgg-image-block clearfix'>";
    echo elgg_get_list_cuadernos_grupo($limit, 0, $guid);
    echo "</div>";
} else {
    $guid = get_input('guid');
    echo elgg_get_list_cuadernos_grupo($limit, $offset, $guid);
}
?>
<div id="myModal" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-cuad pop-up">
    </div>
</div>
<script>
    function getCrearCuaderno(guid){
        var owner=guid;
        elgg.get('ajax/view/cuaderno_campo/crear_cuaderno', {
            timeout: 30000,
            data: {
                guid:owner,
                
            },
            success: function(result, success, xhr) {
                $('.pop-up-cuad').html(result);
            },
        });
    }
</script>
</div>