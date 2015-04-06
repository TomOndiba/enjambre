<?php
$guid = get_input("grupo");
$grupo = get_entity($guid);
$investigaciones = elgg_get_estadistica_investigaciones_grupo($guid);
$filtros = array('convocatoria' => array(), 'linea' => array());

foreach ($investigaciones as $item) {

    if (!in_array($item['convocatoria'], $filtros['convocatoria'])) {
        $filtros['convocatoria'][] = $item['convocatoria'];
    }
    if (!in_array($item['linea'], $filtros['linea'])) {
        $filtros['linea'][] = $item['linea'];
    }

    $contenido_lista.="<tr>"
            . "<td>" . $item['name'] . "</td>"
            . "<td>" . $item['estudiantes'] . "</td>"
            . "<td>" . $item['maestros'] . "</td>"
            . "<td>" . $item['convocatoria'] . "</td>"
            . "<td>" . $item['estado'] . "</td>"
            . "<td>" . $item['linea'] . "</td>"
            . "</tr>";
}

$select_convocatoria = '<select onchange="consultarTablaInvestigacionesGrupo()" class="select-filtro-investigaciones-grupo"><option></option>';
foreach ($filtros['convocatoria'] as $ti) {
    if ($ti != "")
        $select_convocatoria.="<option value='$ti'>$ti</option>";
}
$select_convocatoria.="</select>";


$select_linea = '<select onchange="consultarTablaInvestigacionesGrupo()" class="select-filtro-investigaciones-grupo"><option></option>';
foreach ($filtros['linea'] as $ti) {
    if ($ti != "")
        $select_linea.="<option value='$ti'>$ti</option>";
}
$select_linea.="</select>";




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
        <label>Convocatoria</label>
        <?php echo $select_convocatoria ?>
    </div>
    <div class="row">
        <label>Linea Temática</label>
        <?php echo $select_linea ?>
    </div>
</div>
<br>
<div id="imprimir">
    <h2 class="titulo-reportes">Investigaciones de <?php echo $grupo->name ?></h2>

    <form action="http://<?php echo elgg_get_url_server() ?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
        <a onclick="imprimirExcel('tabla-investigaciones-grupo')">Exportar a Excel</a>
        <input type="hidden" id="contenido_excel" name="contenido" />
    </form>
    <table id="tabla-investigaciones-grupo" class="responstable">
        <thead><tr><th>Nombre</th><th>Estudiantes</th><th>Maestros</th><th>Convocatoria</th><th>Estado</th><th>Línea Temática</th></tr></thead>
        <tbody><?php echo $contenido_lista ?></tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        var table = $('#tabla-investigaciones-grupo').dataTable({
            "bPaginate": false
        });
    });

    function consultarTablaInvestigacionesGrupo() {
        $("#tabla-investigaciones-grupo_filter label input").val("");
        var busqueda = "";
        $(".select-filtro-investigaciones-grupo").each(function() {
            var text = $(this).val() + " ";
            if (text != " ") {
                busqueda += text;
            }
        });
        $("#tabla-investigaciones-grupo_filter label input")
                .val(busqueda)
                .change();
    }

</script>