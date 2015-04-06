<?php
$municipio = get_input("munic");

$instituciones = elgg_get_instituciones_por_municipio($municipio);
$filtros = array('tipo_institucion' => array());
foreach ($instituciones as $item) {
    if (!in_array($item['tipo_institucion'], $filtros['tipo_institucion'])) {
        $filtros['tipo_institucion'][] = $item['tipo_institucion'];
    }
    $contenido_lista.="<tr>"
            . "<td>{$item['name']}</td>"
            . "<td>{$item['tipo_institucion']}</td>"
            . "<td>{$item['estudiantes']}</td>"
            . "<td>{$item['grupos']}</td>"
            . "</tr>";
}
$select_tipo_institucion = '<select onchange="consultarTablaInstituciones()" class="select-filtro"><option></option>';
foreach ($filtros['tipo_institucion'] as $ti) {
    if ($ti != "")
        $select_tipo_institucion.="<option value='$ti'>$ti</option>";
}
$select_tipo_institucion.="</select>";
?>
<div class="filtros">
    <br>
    <h2 class="titulo-reportes">Filtros</h2>
    <div class="row">
        <label>Tipo de Institución</label>
        <?php echo $select_tipo_institucion ?>
    </div>
</div>

<div id="imprimir">
    <h2 class="titulo-reportes">Instituciones del Departamento <?php echo $dpto ?></h2>
    <br><br><div><label>Total de Instituciones: </label><strong><?php echo sizeof($instituciones) ?></strong></div><br><br>
    <form action="http://<?php echo elgg_get_url_server() ?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
        <a onclick="imprimirExcel('tabla-instituciones-municipio')">Exportar a Excel</a>
        <input type="hidden" id="contenido_excel" name="contenido" />
    </form>
    <table id="tabla-instituciones-municipio" class="responstable">
        <thead><tr><th>Nombre</th><th>Tipo</th><th>Estudiantes</th><th>Grupos de Investigación</th></tr></thead>
        <tbody><?php echo $contenido_lista ?></tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        var table = $('#tabla-instituciones-municipio').dataTable({
            "bPaginate": false
        });
    });
    function consultarTablaInstituciones() {
        $("#tabla-instituciones-municipio_filter label input").val("");
        var busqueda = "";
        $(".select-filtro-instituciones-municipio").each(function() {
            var text = $(this).val() + " ";
            if (text != " ") {
                busqueda += text;
            }
        });
        $("#tabla-instituciones-municipio_filter label input")
                .val(busqueda)
                .change();
    }
</script>