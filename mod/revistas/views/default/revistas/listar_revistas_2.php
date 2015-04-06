<?php
elgg_load_js("reveal2");
elgg_load_js('pag_revistas_2');
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 2;
if (!$ajax) {
    echo "<div id='paginable' class='list-grupos'>";
    echo elgg_get_list_revistas($limit, 0);
    echo "</div>";
} else {
    echo elgg_get_list_revistas($limit, $offset);
}
?>
<div id="myModalRevistas" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-album pop-up">
    </div>
</div>
