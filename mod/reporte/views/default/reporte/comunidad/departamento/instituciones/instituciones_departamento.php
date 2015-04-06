<?php
$dpto = get_input("departamento");
$instituciones = elgg_get_instituciones_por_departamento($dpto);
$filtros = array('tipo_institucion' => array());
foreach ($instituciones as $item) {
    if (!in_array($item['tipo'], $filtros['tipo_institucion'])) {
        $filtros['tipo_institucion'][] = $item['tipo'];
    }
    $contenido_lista.="<tr>"
            . "<td>{$item['nombre']}</td>"
            . "<td>{$item['municipio']}</td>"
            . "<td>{$item['tipo']}</td>"
            . "<td>{$item['maestros']}</td>"
            . "<td>{$item['estudiantes']}</td>"
            . "<td>{$item['grupos']}</td>"
            . "</tr>";
}
$select_tipo_institucion = '<select onchange="consultarTablaInstituciones()" class="select-filtro-instituciones"><option></option>';
foreach ($filtros['tipo_institucion'] as $ti) {
    if ($ti != "")
        $select_tipo_institucion.="<option value='$ti'>$ti</option>";
}
$select_tipo_institucion.="</select>";
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
        <label>Tipo de Institución</label>
        <?php echo $select_tipo_institucion ?>
    </div>
</div>


<div id="imprimir">
    <h2 class="titulo-reportes">Instituciones del Departamento <?php echo $dpto ?></h2>

    <br><br><div><label>Total de Instituciones: </label><strong><?php echo sizeof($instituciones) ?></strong></div><br><br>
    <form action="http://<?php echo elgg_get_url_server() ?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
        <a onclick="imprimirExcel('tabla-instituciones')">Exportar a Excel</a>
        <input type="hidden" id="contenido_excel" name="contenido" />
    </form>
    <table id="tabla-instituciones" class="responstable">
        <thead><tr><th>Nombre</th><th>Municipio</th><th>Tipo</th><th>Maestros</th><th>Estudiantes</th><th>Grupos de Investigación</th></tr></thead>
        <tbody><?php echo $contenido_lista ?></tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        var table = $('#tabla-instituciones').dataTable({
            "bPaginate": false
        });
    });

    function consultarTablaInstituciones() {
        $("#tabla-instituciones_filter label input").val("");
        var busqueda = "";
        $(".select-filtro-instituciones").each(function() {
            var text = $(this).val() + " ";
            if (text != " ") {
                busqueda += text;
            }
        });
        $("#tabla-instituciones_filter label input")
                .val(busqueda)
                .change();
    }
</script>