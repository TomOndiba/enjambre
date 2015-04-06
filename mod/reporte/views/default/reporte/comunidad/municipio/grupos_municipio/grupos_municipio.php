<?php
/**
 * Vista que permite visualizar los grupos de investigacion por municipio
 * @author DIEGOX_CORTEX
 */
$municipio = get_input("munic");
$grupos = elgg_get_grupos_por_municipio($municipio);
$filtros = array('tipo_institucion' => array());
foreach ($grupos as $item) {
    if (!in_array($item['tipo_institucion'], $filtros['tipo_institucion'])) {
        $filtros['tipo_institucion'][] = $item['tipo_institucion'];
    }
    $contenido_lista.="<tr>"
            . "<td>${item['name']}</td>"
            . "<td>{$item['institucion']}</td>"
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

<div id="imprimir">
    <h2 class="titulo-reportes">Grupos de Investigación del Municipio <?php echo $municipio ?></h2>

    <br><br><div><label>Total de Grupos de Investigación: </label><strong><?php echo sizeof($grupos) ?></strong></div> <br><br>
    <form action="http://<?php echo elgg_get_url_server() ?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
        <a onclick="imprimirExcel('tabla-grupos-municipio')">Exportar a Excel</a>
        <input type="hidden" id="contenido_excel" name="contenido" />
    </form>
    <table id="tabla-grupos-municipio" class="responstable">
        <thead><tr><th>Nombre</th><th>Institución</th><th>Tipo de Institución</th><th>Investigaciones</th><th>Miembros</th></tr></thead>
        <tbody><?php echo $contenido_lista ?></tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        var table = $('#tabla-grupos-municipio').dataTable({
            "bPaginate": false
        });
    });

    function consultarTablaGrupos() {
        $("#tabla-grupos-municipio_filter label input").val("");
        var busqueda = "";
        $(".select-filtro-grupos-municipio").each(function() {
            var text = $(this).val() + " ";
            if (text != " ") {
                busqueda += text;
            }
        });
        $("#tabla-grupos-municipio_filter label input")
                .val(busqueda)
                .change();
    }
</script>

