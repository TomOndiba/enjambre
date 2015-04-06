<?php
elgg_load_js('acciones');
$institucion = $vars['institucion'];
$user = elgg_get_logged_in_user_entity();
$list = "";
$params['buttons'] = array();



if ($user->guid== $institucion->owner_guid) {
   
    $list.="<li><a href='".elgg_get_site_url()."instituciones/editar/".$institucion->guid."' ><div class='icon-editar' data-tooltip='Editar Institución'></div></a></li>";
   
    }
    
 if(elgg_is_rol_logged_user("coordinador")){
    $url = elgg_get_site_url() . "action/grupo_investigacion/desactivar_grupo?guid=" . $institucion->guid;
    $href = elgg_add_action_tokens_to_url($url);
    $list.="<li><a onclick='confirmarDesactivar(\"".$href."\")'><div class='icon-eliminar' data-tooltip='Deshabilitar Institución'></div></a></li>";
         
 }   
 
?><ul>
    <?php
     echo '<div style="display:none;" id="dialog-confirm-desactivar" title="Confirmación"> Está seguro de Desactivar la Institución?</div>';
    echo $list;
    ?>
</ul>