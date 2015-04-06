<?php
elgg_load_js('acciones');
$grupo= $vars['grupo'];
$investigaciones=elgg_get_entities_from_relationship_count(array("relationship" => "tiene_la_investigacion","relationship_guid" => $grupo->guid, 'count'=>true));
$iniciativas=elgg_get_entities_from_relationship_count(array("relationship" => "tiene_cuaderno_campo","relationship_guid" => $grupo->guid, 'count'=>true));
$total_integrantes= elgg_get_entities_from_relationship_count(array("relationship" => "es_miembro_de","relationship_guid" => $grupo->guid,"inverse_relationship" => "true", 'count'=>true));

$botones= $vars['botones'];
$url= elgg_get_site_url();

$user= elgg_get_logged_in_user_guid();
?>
<div class="menu">
    <div class="informacion">
        <img src="<?php echo $grupo->getIconUrl('medium');?>" class="imagen-perfil"/>
        <fieldset>
            <legend><?php echo $grupo->name;?></legend>
        </fieldset>
    </div>
    <div class="opciones-grupo">
        <?php echo elgg_view("grupo_investigacion/profile/opciones",array("grupo"=>$grupo,"botones"=>$botones));?>
    </div>
     <?php //echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar el Grupo de Investigación?</div>';?>
    <nav class="menu-perfil">
        <ul>
            <li><a href="<?php echo "{$url}grupo_investigacion/ver/$grupo->guid/" ?>">Muro</a></li>
            <li><a href="<?php echo "{$url}grupo_investigacion/ver/$grupo->guid/informacion" ?>">Información</a></li>
            <li><a href="<?php echo "{$url}grupo_investigacion/ver/$grupo->guid/fotos"?>">Fotos</a></li>
            <li><a href="<?php echo "{$url}grupo_investigacion/archivos/$grupo->guid/autoformacion"?>">Mi biblioteca</a></li>
            <li><a href="<?php echo "{$url}grupo_investigacion/discusiones/$grupo->guid/"?>">Foros</a></li>
            <li><a href="<?php echo "{$url}grupo_investigacion/marcadores/$grupo->guid/"?>">Marcadores</a></li>
            <li><a href="<?php echo "{$url}grupo_investigacion/archivos/$grupo->guid/"?>">Archivos</a></li>
            <li><a href="<?php echo "{$url}grupo_investigacion/ver/$grupo->guid/calendario"?>">Calendario</a></li>
            <li><a href="<?php echo "{$url}grupo_investigacion/ver/$grupo->guid/cuadernos"?>">Iniciativas</a><span>(<?php echo $iniciativas?>)</span></li>
            <li><a href="<?php echo "{$url}grupo_investigacion/ver/$grupo->guid/investigaciones"?>">Investigaciones</a><span>(<?php echo $investigaciones?>)</span></li>
             <li><a href="<?php echo "{$url}grupo_investigacion/integrantes/$grupo->guid/"?>">Integrantes</a><span>(<?php echo $total_integrantes?>)</span></li>
            <?php  if($user==$grupo->owner_guid){ ?>
            <li><a href="<?php echo "{$url}grupo_investigacion/mensaje/$grupo->guid/"?>">Mensaje</a></li>
            <li><a href="<?php echo "{$url}grupo_investigacion/integrantes_desactivados/$grupo->guid/"?>">Integrantes Desactivados</a></li>
            <?php  }  ?>
        </ul>
    </nav>
    
</div>

 
