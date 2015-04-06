<?php
$componentes = $vars['componentes'];
if (sizeof($componentes) == 0) {
    echo "<div class='msj-no-componentes'>No se han registrado componentes.</div>";
} else {
    ?>
    <ul class="lista-componentes">
        <?php
        foreach ($componentes as $comp) {
            $date = elgg_view_friendly_time($comp->time_created);
            if ($comp->contenido == "file") {
                $file = new ElggFile($comp->archivo);
                $file_icon = elgg_view_entity_icon($file, 'small');
                ?>
                <li>
                    <div>
                        <?php echo $file_icon;?>
                    </div>
                    <div>
                        <a href="<?php echo $comp->url;?>"><h3><?php echo $comp->title; ?></h3></a>
                        <h4><?php echo $date?></h4>
                    </div>
                </li>
                <?php
            } else {


                $site_url = elgg_get_site_url();
                $url = $site_url . "photos/thumbnail/{$comp->icono}/small/";
                ?>
                <li>
                    <div>
                        <a target='_blank' href="<?php echo $comp->url; ?>"><img src='<?php echo $url; ?>' width="60"></a>
                    </div>
                    <div>
                        <a target='_blank' href="<?php echo $comp->url;?>"><h3><?php echo $comp->title; ?></h3></a>
                        <h4><?php echo $date?></h4>
                    </div>
                </li>
                <?php
            }
        }
        ?>
    </ul>
<?php }
?>
