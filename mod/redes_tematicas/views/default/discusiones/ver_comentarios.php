<?php
$items = $vars['entities'];
$count = count($items);
$total= $count-3;
$link_ver_mas = false;
$owner_guid = $items[0]->entity_guid;

$body = "";
for ($i = 0; $i < count($items); $i++) {
    $annotation = $items[$i];

    $owner = get_entity($annotation->owner_guid);
    if (!$owner) {
        return false;
    }
    $icon = $owner->getIconURL();
    $owner_link = "<a href=\"{$owner->getURL()}\">$owner->name $owner->apellidos</a>";
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


