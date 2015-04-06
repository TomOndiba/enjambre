<?php

elgg_load_js('pagination/grupos_institucion');
$id_institucion= $vars['id_institucion'];
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 10;

if (!$ajax) {
    echo '<div class="list-grupos" style="margin-left: 20px; margin-top: 25px">
    <h2 class="title-legend">Grupos de Investigación</h2>';
    echo "<div id='paginable' class='lista-coordinacion'>";
    elgg_get_list_grupos_institucion($id_institucion,$limit,0);
    echo "</div>";
}else{
    elgg_get_list_grupos_institucion($id_institucion,$limit,$offset);
}

 ?>

</div>