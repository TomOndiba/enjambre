<?php
$red= $vars['feria'];

$url= elgg_get_site_url();
$guid=$red->guid;
$user= elgg_get_logged_in_user_guid();
$user_guid = elgg_get_logged_in_user_guid();
$style_evaluador = "";
$url_evaluador = "";
$icono_inscripcion="";
if (elgg_es_evaluador($user_guid)) {
   
   
    if (!check_entity_relationship($user_guid, 'preinscrito_evaluador_feria', $guid)) {
        $url_evaluador = elgg_get_site_url() . 'action/evaluadores/inscripcion_evaluador_feria?id_f=' . $guid;
        $url_inscripcion_evaluador = elgg_add_action_tokens_to_url($url_evaluador);
        $icono_inscripcion='<div  class="inscripcion-evaluador" onclick="window.location=\''.$url_inscripcion_evaluador.'\'" >'
                . '<div class="icon-inscripcion-evaluador-convocatoria" style=""></div>
            </div>';
   
} else {
    $icono_inscripcion="";
}
    //$style_evaluador = 'display:none;';
}
?>
<div class="menu">
    <div class="informacion">
        <img src="<?php echo $red->getIconUrl('medium');?>" class="imagen-perfil"/>
        <fieldset>
            <legend><?php echo $red->name;?></legend>
        </fieldset>
    </div>
    <nav class="menu-perfil">
        <ul>
            <li><a href="<?php echo "{$url}feria/ver/$red->guid/" ?>">Información</a></li>
            <li><a href="<?php echo "{$url}feria/ver/$red->guid/muro/" ?>">Muro</a></li>
            <li><a href="<?php echo "{$url}feria/ver/$red->guid/fotos"?>">Fotos</a></li>
            <li><a href="<?php echo "{$url}feria/archivos/$red->guid/"?>">Archivos</a></li>
            <li><a href="<?php echo "{$url}feria/discusiones/$red->guid/"?>">Foros</a></li>
            <li><a href="<?php echo "{$url}feria/marcadores/$red->guid/"?>">Marcadores</a></li>
            <li><a href="<?php echo "{$url}feria/ver_eventos/calendario/$red->guid/"?>">Calendario</a></li>
           
        </ul>
    </nav>
  
    <?php  echo $icono_inscripcion; ?>
    
</div>

 
