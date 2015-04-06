<?php
$entities = $vars['entities'];
?>
<div id='nuevos-comentarios'></div>
<?php
foreach ($entities as $entity) {
    $owner = get_entity($entity->owner_guid);
    $friendlytime = elgg_view_friendly_time($entity->time_created);
    ?>
    <div class='title-comment-foto'><a href='<?php echo elgg_get_site_url() . "profile/{$owner->username}"; ?>'><img src="<?php echo $owner->getIconURL() ?>" /></a>
        <div>
            <a href='<?php echo elgg_get_site_url() . "profile/{$owner->username}"; ?>'><span><?php echo $owner->name . " " . $owner->apellidos; ?></span></a>
            <br><span class='time-foto'><?php echo $friendlytime; ?></span>
        </div>
    </div>
    <div class='contenido-comment-foto'><?php echo $entity->value; ?></div>
    <?php
}
?>