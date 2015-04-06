<?php

$items = $vars['entities'];
if(count($items)==1){
    echo elgg_view('vistas/js');
}
$count = count($items);
$total= $count-3;
$link_ver_mas = false;
$owner_guid = $items[0]->entity_guid;

if ($count>3) {
    echo '<div style="text-align:right; padding-right:20px;" ><a class="ver-todos-comments" tittle="' . $owner_guid . '" >Ver ' . $total . ' comentarios Anteriores</a><br></div>';
}
$body = "";
for ($i = 0; $i < count($items); $i++) {
    $class = "";
    if ($i<$total && $count>=3) {
        $class = "no-display";
    }
    $annotation = $items[$i];

    $owner = get_entity($annotation->owner_guid);
    if (!$owner) {
        return false;
    }
    $view= elgg_get_site_url()."ajax/view/info/user?guid={$owner->guid}";
    $icon = $owner->getIconURL();
    $owner_link = "<a class='informacion-user' tooltip-view='{$view}' href=\"{$owner->getURL()}\">$owner->name $owner->apellidos</a>";
    $owner_guid = $annotation->entity_guid;
    $text = $annotation->value;
    $friendlytime = elgg_view_friendly_time($annotation->time_created);
    
    ?>
    <div class="<?php echo $class . " " . $owner_guid; ?> comentario">
        <div class="header-comentario">
            <img src="<?php echo $icon; ?>"/>
            <div><?php echo $owner_link; ?><br>
                <span><?php echo $friendlytime ?></span>
            </div>
        </div>
        <p><?php echo $text; ?></p>
    </div>


    <?php
}


