<?php
/**
 * Vista ajax que permite realizar la paginación del listado de las ferias
 */

elgg_load_js('pagination/ferias');
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 10;
$url = elgg_get_site_url() . "ferias/registro";
$url2 = elgg_get_site_url() . "subcategorias/listar";
$url3 = elgg_get_site_url() . "ferias/listar_inactivas";

if (!$ajax) {
    echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar la feria?</div>';
    ?>
    <div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2>Ferias</h2>
        </div>
        
        
    <?php
    $header.="<div class='contenedor-button'>"
            . "<a href='$url' class=\"link-button\">Crear nueva</a> "
            . "<a href='$url2' class=\"link-button\">Subcategorías de Innovación</a> "
            . "<a href='$url3' class=\"link-button\">Listar inactivas</a> "
            . "</div>";

    echo $header;
    echo "<div id='paginable' class='lista-coordinacion'>";
    echo elgg_get_list_ferias($limit, 0);
    echo "</div>";
    
    ?>
    </div>
    

<?php
} else {
   
    echo elgg_get_list_ferias($limit, $offset);
}
?>
