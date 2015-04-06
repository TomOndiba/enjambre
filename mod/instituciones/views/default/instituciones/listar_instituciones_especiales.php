<?php

elgg_load_js('pagination/instituciones_especiales');
$offset = get_input('offset');
$query = get_input('busqueda');
$ajax = get_input('ajax');
$limit = 10;
$url = elgg_get_site_url()."instituciones";
if (!$ajax) {
    echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> Está seguro de eliminar la Institución?</div>';
    echo "<div style='width:90%; text-align:right; margin-top:15px'><a href='{$url}'>Ver Todas las instituciones</a></div>";
    echo "<div id='paginable' class='list-grupos'>";
    
   
    echo elgg_get_list_instituciones_especiales($limit, 0);
    echo "</div>";
} else {
    if ($query) {
        echo elgg_get_list_instituciones_nombre($limit, $offset, $query);
    }else{
    echo elgg_get_list_instituciones_especiales($limit, $offset);   
    }
}
?>
