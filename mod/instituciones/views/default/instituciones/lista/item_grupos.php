<?php
$entity = $vars['entity'];
$grupo= get_entity($entity->guid);

$site_url=  elgg_get_site_url();
?>
<li class="item-usuario">
                <a href="<?php echo $site_url."grupo_investigacion/ver/".$grupo->guid ;?>"><img src="<?php echo $grupo->getIconURL();?>"/></a>
                <div>
                    <a href="<?php echo $site_url."grupo_investigacion/ver/".$grupo->guid;?>"><span class='name-usuario'><?php echo $grupo->name;?></span></a><br><br>
                </div>
            </li>