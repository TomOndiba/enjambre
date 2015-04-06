<ul>
    <?php
    $nombre = get_input("nombre");
    $redes = elgg_get_redes_por_nombre($nombre);
    foreach ($redes as $red) {
        ?>
    <li onclick="cargarRed(<?php echo $red->guid;?>)">
            <img src="<?php echo $red->getIconUrl()?>" alt=""/>
            <span><?php echo $red->name;?></span>
        </li>
    <?php } ?>
</ul>