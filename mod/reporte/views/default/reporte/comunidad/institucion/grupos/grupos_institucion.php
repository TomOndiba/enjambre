<?php
$inst = get_input("institucion");
$institucion = get_entity($inst);
$grupos = elgg_get_estadistica_grupos_institucion($inst);

foreach ($grupos as $item) {

    $contenido_lista.="<tr>"
            . "<td>{$item['name']}</td>"
            . "<td>{$item['miembros']}</td>"
            . "<td>{$item['investigaciones']}</td>"
            . "</tr>";
}
//$select_tipo_institucion = '<select onchange="consultarTablaInstituciones()" class="select-filtro-instituciones"><option></option>';
//foreach ($filtros['tipo_institucion'] as $ti) {
//    if ($ti != "")
//        $select_tipo_institucion.="<option value='$ti'>$ti</option>";
//}
//$select_tipo_institucion.="</select>";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!--<div class="filtros">
    <br>
    <h2 class="titulo-reportes">Filtros</h2>-->
<!--    <div class="row">
        <label>Tipo de Institución</label>
<?php // echo $select_tipo_institucion ?>
    </div>-->
<!--</div>-->
<br>
<div id="imprimir">
    <h2 class="titulo-reportes">GRUPOS DE INVESTIGACIÓN DE <?php echo $institucion->name ?></h2>
    <form action="http://<?php echo elgg_get_url_server() ?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
        <a onclick="imprimirExcel('tabla-grupos-institucion')">Exportar a Excel</a>
        <input type="hidden" id="contenido_excel" name="contenido" />
    </form>
    <table id="tabla-grupos-institucion" class="responstable">
        <thead><tr><th>Nombre</th><th>Miembros</th><th>Investigaciones</th></tr></thead>
        <tbody><?php echo $contenido_lista ?></tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        var table = $('#tabla-grupos-institucion').dataTable({
            "bPaginate": false
        });
    });

</script>