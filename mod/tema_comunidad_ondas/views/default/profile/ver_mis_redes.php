<?php


$user=$vars['user'];
$mis_redes=elgg_get_mis_redes_tematicas($user->guid);
$site_url=  elgg_get_site_url();

if(!$mis_grupos){
   echo "<div class='mensaje-vacio'><h2>No pertenece a ninguna Red Temática</h2></div>";  
}
else{
 ?>
    <ul class='list-usuarios'><?php
        foreach ($mis_redes as $rd) {
            $red= get_entity($rd->guid);
            ?>
            <li class="item-usuario">
                <a href="<?php echo $site_url."redes_tematicas/ver/".$red->guid ;?>"><img src="<?php echo $red->getIconURL();?>"/></a>
                <div>
                    <a href="<?php echo $site_url."redes_tematicas/ver/".$red->guid;?>"><span class='name-usuario'><?php echo $red->name;?></span></a><br><br>
                </div>
            </li>
            <?php
        }
}
        ?>
    </ul>
