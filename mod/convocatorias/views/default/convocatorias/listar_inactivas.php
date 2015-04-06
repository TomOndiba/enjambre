<?php
/**
 * Vista ajax que permite realizar la paginación del listado de las convocatorias inactivas
 */
elgg_load_js('pagination/inactivas');
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 10;
$url = elgg_get_site_url() . "convocatorias/registro";
$url2 = elgg_get_site_url() . "convocatorias/listar_inactivas";
$content = "";
$lista = "";
if (!$ajax) {
    echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar la convocatoria?</div>';
    ?>
    <div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2>Convocatorias Inactivas</h2>
        </div>
        
        <?php 
        echo $header;
        echo "<div id='paginable' class='lista-coordinacion'>";
        echo elgg_get_list_convocatorias_inactivas($limit, 0);
        echo "</div>";
        echo $lista;
        ?>
    </div>
    <?php
} else {
    $lista = elgg_get_list_convocatorias_inactivas($limit, $offset);
    echo $lista;
}
?>
