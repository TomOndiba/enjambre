<?php
//

elgg_load_js('amigos');
elgg_load_js("reveal2");
elgg_load_css('reveal');


$user = $vars['user'];

$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 9;

if (!$ajax) {
	echo "<div class='box'>";
    echo "<div id='paginable' class='elgg-image-block clearfix'>";
    echo elgg_get_amigos($limit, 0, $user->guid);
    echo "</div>";
    echo "</div>";
} else {
    $guid = get_input('guid');
    echo elgg_get_amigos($limit, $offset, $guid);
}
echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar su amigo?</div>';
?>

