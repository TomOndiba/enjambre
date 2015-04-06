<?php

elgg_load_js('pagination/instituciones');
$offset = get_input('offset');
$query = get_input('busqueda');
$ajax = get_input('ajax');
$limit = 10;
$url = elgg_get_site_url()."instituciones/especiales";
if (!$ajax) {
    echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> Está seguro de eliminar la Institución?</div>';
    $busqueda = elgg_view('input/text', array('name' => 'busqueda',
        'id' => 'busqueda',
        'class' => 'text-busqueda',
        'value' => "",
        'placeholder'=>"Busca aquí tu Institución"
    ));
        echo "<div style='width:90%; text-align:right; margin-top:15px'><a href='{$url}'>Ver Todas las instituciones Priorizadas</a></div>";

    echo '<div id="contenedor-busqueda">'.$busqueda.' </div>';
    
  
    echo "<div id='paginable' class='list-grupos'>";
    
   
    echo elgg_get_list_instituciones($limit, 0);
    echo "</div>";
} else {
    if ($query) {
        echo elgg_get_list_instituciones_nombre($limit, $offset, $query);
    }else{
    echo elgg_get_list_instituciones($limit, $offset);   
    }
}
?>
