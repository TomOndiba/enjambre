<?php

elgg_load_js('pagination/feriasp');
$offset = get_input('offset');
$query = get_input('busqueda');
$ajax = get_input('ajax');
$limit = 10;


if (!$ajax) {
    echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> Está seguro de eliminar la Feria?</div>';
    $busqueda = elgg_view('input/text', array('name' => 'busqueda',
        'id' => 'busqueda3',
        'class' => 'text-busqueda',
        'value' => "",
        'placeholder' => "Busque aquí la Feria"
    ));
    
    echo '<div id="contenedor-busqueda">' . $busqueda . ' </div>';

    echo "<div id='paginable' class='list-grupos'>";
    echo elgg_get_list_ferias_publico($limit, 0);
    echo "</div>";
} else {
   
    if ($query) {
        echo elgg_get_list_ferias_publico_nombre($limit, $offset, $query);
    } else {
        echo elgg_get_list_ferias_publico($limit, $offset);
    }
}
?>
