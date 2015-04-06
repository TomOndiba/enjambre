<?php
$institucion= $vars['institucion'];
$url= elgg_get_site_url();
if(elgg_is_priorizada($institucion->guid)){
    $prio = "<span><img style='border:none; height:80px; width:80px; margin-top:-30px; margin-left:-20px;' src='http://www.enjambre.gov.co/imagenes/priorizada.png'/></span>";
}
$user= elgg_get_logged_in_user_guid();
?>
<div class="menu">
    <div class="informacion">
        <img src="<?php echo $institucion->getIconUrl('medium');?>" class="imagen-perfil"/>
        <?php echo $prio?>
        <fieldset>
            <legend><?php echo $institucion->name;?></legend>
        </fieldset>
    </div>
    <div class="opciones-grupo">
        <?php echo elgg_view("instituciones/profile/opciones",array("institucion"=>$institucion,"botones"=>$botones));?>
    </div>
    <nav class="menu-perfil">
        <ul>
            
            <li><a href="<?php echo "{$url}instituciones/ver/$institucion->guid/" ?>">Muro</a></li>
            <li><a href="<?php echo "{$url}instituciones/ver/$institucion->guid/informacion" ?>">Información</a></li>
            <li><a href="<?php echo "{$url}instituciones/ver/$institucion->guid/fotos"?>">Fotos</a></li>
            <li><a href="<?php echo "{$url}instituciones/archivos/$institucion->guid/"?>">Archivos</a></li>
            <li><a href="<?php echo "{$url}instituciones/discusiones/$institucion->guid/"?>">Foros</a></li>
            <li><a href="<?php echo "{$url}instituciones/marcadores/$institucion->guid/"?>">Marcadores</a></li>
            <li><a href="<?php echo "{$url}instituciones/ver/$institucion->guid/calendario"?>">Calendario</a></li>
            <li><a href="<?php echo "{$url}instituciones/ver/$institucion->guid/integrantes"?>">Integrantes</a></li>
            <li><a href="<?php echo "{$url}instituciones/ver/$institucion->guid/grupos_investigacion"?>">Grupos de investigación</a></li>
            <?php //  if($user==$red->owner_guid){ ?>
           <!-- <li><a href="<?php // echo "{$url}redes_tematicas/mensaje/$red->guid/"?>">Mensaje</a></li> -->
            <?php //  }  ?>
        </ul>
    </nav>
   
    
    
</div>

 
