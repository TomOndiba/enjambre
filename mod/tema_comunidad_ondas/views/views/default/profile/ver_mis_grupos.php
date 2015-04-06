<?php

$user=$vars['user'];
$mis_grupos=elgg_get_mis_grupos_investigacion($user->guid);
$site_url=  elgg_get_site_url();

if(!$mis_grupos){
   echo "<div class='mensaje-vacio'><h2>No pertenece a ningún Grupo de Investigación</h2></div>";  
}
else{
 ?>
    <ul class='list-usuarios'><?php
        foreach ($mis_grupos as $grup) {
            $grupo= get_entity($grup->guid);
            ?>
            <li class="item-usuario">
                <a href="<?php echo $site_url."grupo_investigacion/ver/".$grupo->guid ;?>"><img src="<?php echo $grupo->getIconURL();?>"/></a>
                <div>
                    <a href="<?php echo $site_url."grupo_investigacion/ver/".$grupo->guid;?>"><span class='name-usuario'><?php echo $grupo->name;?></span></a><br><br>
                </div>
            </li>
            <?php
        }
}
        ?>
    </ul>
