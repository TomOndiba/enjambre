<?php
$red= $vars['red'];
$url= elgg_get_site_url();

$user= elgg_get_logged_in_user_guid();
?>
<div class="menu">
    <div class="informacion">
        <img src="<?php echo $red->getIconUrl('medium');?>" class="imagen-perfil"/>
        <fieldset>
            <legend><?php echo $red->name;?></legend>
        </fieldset>
    </div>
    <div class="opciones-grupo">
        <?php echo elgg_view("redes_tematicas/profile/opciones",array("grupo"=>$red,"botones"=>$botones));?>
    </div>
    <?php echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar la Red Temática?</div>';?>
    <nav class="menu-perfil">
        <ul>
            <li><a href="<?php echo "{$url}redes_tematicas/ver/$red->guid/" ?>">Muro</a></li>
            <li><a href="<?php echo "{$url}redes_tematicas/ver/$red->guid/informacion" ?>">Información</a></li>
            <li><a href="<?php echo "{$url}redes_tematicas/ver/$red->guid/fotos"?>">Fotos</a></li>
            <li><a href="<?php echo "{$url}redes_tematicas/archivos/$red->guid/"?>">Archivos</a></li>
            <li><a href="<?php echo "{$url}redes_tematicas/discusiones/$red->guid/"?>">Foros</a></li>
            <li><a href="<?php echo "{$url}redes_tematicas/marcadores/$red->guid/"?>">Marcadores</a></li>
            <li><a href="<?php echo "{$url}redes_tematicas/ver/$red->guid/calendario"?>">Calendario</a></li>
             <li><a href="<?php echo "{$url}redes_tematicas/integrantes/$red->guid/"?>">Investigaciones</a></li>
            <?php  if($user==$red->owner_guid){ ?>
            <li><a href="<?php echo "{$url}redes_tematicas/mensaje/$red->guid/"?>">Mensaje</a></li>
            <?php  }  ?>
        </ul>
    </nav>
    
</div>

 
