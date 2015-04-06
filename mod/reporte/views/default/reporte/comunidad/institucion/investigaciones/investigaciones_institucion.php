<?php
$inst = get_input("institucion");
$institucion = get_entity($inst);
$investigaciones = elgg_get_estadistica_investigaciones_institucion($inst);
$filtros = array('grupo' => array());

foreach ($investigaciones as $item) {

    if (!in_array($item['grupo'], $filtros['grupo'])) {
        $filtros['grupo'][] = $item['grupo'];
    }

    $contenido_lista.="<tr>"
            . "<td>{$item['name']}</td>"
            . "<td>{$item['grupo']}</td>"
            . "<td>{$item['estudiantes']}</td>"
            . "<td>{$item['maestros']}</td>"
            . "</tr>";
}
$select_grupo = '<select onchange="consultarTablaInvestigaciones()" class="select-filtro-investigaciones"><option></option>';


foreach ($filtros['grupo'] as $ti) {
    if ($ti != "")
        $select_grupo.="<option value='$ti'>$ti</option>";
}
$select_grupo.="</select>";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="filtros">
    <br>
    <h2 class="titulo-reportes">Filtros</h2>
    <div class="row">
        <label>Grupo de Investigación</label>
        <?php echo $select_grupo ?>
    </div>
</div>
<br>
<div id="imprimir">
    <h2 class="titulo-reportes">INVESTIGACIONES DE <?php echo $institucion->name ?></h2>
    <form action="http://<?php echo elgg_get_url_server() ?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
        <a onclick="imprimirExcel('tabla-investigaciones-institucion')">Exportar a Excel</a>
        <input type="hidden" id="contenido_excel" name="contenido" />
    </form>
    <table id="tabla-investigaciones-institucion" class="responstable">
        <thead><tr><th>Nombre</th><th>Grupo</th><th>Estudiantes</th><th>Maestros</th></tr></thead>
        <tbody><?php echo $contenido_lista ?></tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        var table = $('#tabla-investigaciones-institucion').dataTable({
            "bPaginate": false
        });
    });

    function consultarTablaInvestigaciones() {
        $("#tabla-investigaciones-institucion_filter label input").val("");
        var busqueda = "";
        $(".select-filtro-investigaciones").each(function() {
            var text = $(this).val() + " ";
            if (text != " ") {
                busqueda += text;
            }
        });
        $("#tabla-investigaciones-institucion_filter label input")
                .val(busqueda)
                .change();
    }

</script>