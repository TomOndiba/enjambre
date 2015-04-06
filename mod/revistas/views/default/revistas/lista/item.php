<?php
$revista = $vars['entity'];
$url = $site_url . "photos/thumbnail/{$revista->imagen}/large/";
$friendlytime = elgg_view_friendly_time($revista->time_created);
?>
<li class="item-revista-element">
    <img src="<?php echo $url ?>"/>
    <div class="icons row">   
        <div class="web" data-tooltip="Ver versión Movil" onclick="location.href='<?php echo $revista->url_html?>'"></div>
        <div class="flash" data-tooltip="Ver versión Flash" onclick="location.href='<?php echo $revista->url_flash?>'"></div>
    </div>
    <div class="nombre-revista row">
        <h4><?php echo $revista->name ?> </h4>
    </div>

</li>
