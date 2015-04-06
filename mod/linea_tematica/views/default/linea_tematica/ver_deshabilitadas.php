<?php

/**
 * Vista que lista las lineas temáticas deshabilitadas
 * @author DIEGOX_CORTEX
 */

elgg_load_js('acciones_linea');
elgg_load_js('pagination/linea');

$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 10;
$url = elgg_get_site_url() . "linea/crear";
$content = "";
$lista = "";
if (!$ajax) {
    //echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea deshabilitar la linea temática?</div>';
    ?>
    <div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2>Lineas Temáticas</h2>
        </div>
        
        <?php  
        echo "<div id='paginable' class='lista-coordinacion'>";
        echo elgg_get_list_lineas_deshabilitadas($limit, 0);
        echo "</div>";
        echo $lista;
        ?>
    </div>
    <?php
} else {
    $lista = elgg_get_list_lineas_deshabilitadas($limit, $offset);
    echo $lista;
}
?>

