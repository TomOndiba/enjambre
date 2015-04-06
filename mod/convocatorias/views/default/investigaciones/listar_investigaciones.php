<?php
$id_linea = get_input('linea');
$id_conv = get_input('id_conv');
$relacion = get_input('relacion');


$convocatoria = new ElggConvocatoria($id_conv);

$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 5;

if (!$ajax) {
    ?>
<div class = "content-coordinacion">
    <div class = "titulo-coordinacion">
        <h2>Convocatoria: <?php echo $convocatoria->name;
?></h2>
    </div>
    <div class="menu-coordinacion">
            <?php echo elgg_view("convocatorias/menu", array('guid' => $convocatoria->guid)); ?>
    </div>
    <div class="contenido-coordinacion">
        <h2>
            Investigaciones:
        </h2>
<?php
    echo "<div class='box'><div class='padding20'>";
    echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar la iniciativa de investigación?</div>';
    echo $breadcrumbs;
    echo $header;
    echo "<div id='paginable' class='elgg-image-block clearfix'><br><br>";
    echo elgg_get_investigaciones_preinscritas_linea_convocatoria($limit, 0, $id_conv, $id_linea, $relacion);
    echo "</div></div></div>";
} else {
    $guid = get_input('guid');
    echo elgg_get_investigaciones_preinscritas_linea_convocatoria($limit, $offset, $id_conv, $id_linea, $relacion);
}
