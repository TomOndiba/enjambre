<ul>
    <?php
    $investigacion = $vars['investigacion'];
    $site_url = elgg_get_site_url();
    $integrantes = $vars['integrantes'];
    foreach ($integrantes as $integrante) {
        $url_action = $site_url."action/bitacoras/agregar_integrante?user={$integrante->guid}&investigacion={$investigacion}";
        $url_final = elgg_add_action_tokens_to_url($url_action);
        ?>
    <li>
        <?php echo $integrante->name;?>
        <a href="<?php echo $url_final;?>">Agregar</a>
    </li>
    <?php } ?>    
</ul>

