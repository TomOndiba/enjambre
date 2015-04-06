<?php
$dpto = get_input("departamento");
$grupos = elgg_get_grupos_por_departamento($dpto);
$filtros = array('tipo_institucion' => array());
foreach ($grupos as $item) {
    if (!in_array($item['tipo_institucion'], $filtros['tipo_institucion'])) {
        $filtros['tipo_institucion'][] = $item->tipo_institucion;
    }
    $contenido_lista.="<tr>"
            . "<td>{$item['nombre']}</td>"
            . "<td>{$item['institucion']}</td>"
            . "<td>{$item['municipio']}</td>"
            . "<td>{$item['tipo_institucion']}</td>"
            . "<td>{$item['investigaciones']}</td>"
            . "<td>{$item['miembros']}</td>"
            . "</tr>";
}
$select_tipo_institucion = '<select onchange="consultarTablaGrupos()" class="select-filtro-grupos"><option></option>';
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

<div id="imprimir" >
    <h2 class="titulo-reportes">Grupos de Investigación del Departamento <?php echo $dpto ?></h2>

    <br><br><div><label>Total de Grupos de Investigación: </label><strong><?php echo sizeof($grupos) ?></strong></div> <br><br>
    <form action="http://<?php echo elgg_get_url_server() ?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
        <a onclick="imprimirExcel('tabla-grupos')">Exportar a Excel</a>
        <input type="hidden" id="contenido_excel" name="contenido" />
    </form>
    <table id="tabla-grupos" class="responstable">
        <thead><tr><th>Nombre</th><th>Institución</th><th>Municipio</th><th>Tipo de Institución</th><th>Investigaciones</th><th>Miembros</th></tr></thead>
        <tbody><?php echo $contenido_lista ?></tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        var table = $('#tabla-grupos').dataTable({
            "bPaginate": false
        });
    });

    function consultarTablaGrupos() {
        $("#tabla-grupos_filter label input").val("");
        var busqueda = "";
        $(".select-filtro-grupos").each(function() {
            var text = $(this).val() + " ";
            if (text != " ") {
                busqueda += text;
            }
        });
        $("#tabla-grupos_filter label input")
                .val(busqueda)
                .change();
    }
</script>


