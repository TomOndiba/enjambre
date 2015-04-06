<?php
/**
 * Vista que muestra el reporte de la calificacion de un asesor en una convocatoria
 * @author DIEGOX_CORTEX
 */

$conv = get_input('guid_conv');
$asesor = get_input('guid_asesor');
$as = get_entity($asesor);

$datos = elgg_get_estadisticas_calificacion_asesor_conv($asesor, $conv, "es_asesor_de");
$estudiantes = $datos['lista'];
$tablas = $datos['tablas'];
$tipo = 0;
$contenido = "<div>";
foreach ($tablas as $key => $value) {
    $contenido.="<div class='box-estadistica'><h2 class='titulo-reportes'>$key</h2>";
    $table = array();
    $tabla_resumen = "";
    $table['cols'] = array(
        array('label' => $key, 'type' => 'string'),
        array('label' => 'Total', 'type' => 'number')
    );

    $tabla_resumen = "<table class='responstable'>"
            . "<thead><tr><th>$key</th><th>Número</th></tr></thead>";
    $rows = array();
    $total = 0;
    foreach ($value as $element => $valor) {
        $temp = array();
        $temp[] = array('v' => $element);
        $temp[] = array('v' => $valor);
        $rows[] = array('c' => $temp);
        $tabla_resumen.="<tr><td><b>$element</b></td><td>$valor</td></tr>";
        $total+=$valor;
    }
    $tabla_resumen.="<tr><td><b>Total</b></td><td>$total</td></tr></table>";
    $table['rows'] = $rows;
    $json_data = json_encode($table);
    $contenido.="<div id='grafica-$tipo' class='grafica'></div>";
    $contenido.= elgg_view('reporte/comunidad/departamento/pintar_grafica', array('datos' => $json_data, 'tipo' => $key, 'numero' => $tipo));
    $contenido.=$tabla_resumen;
    $contenido.="</div>";
    $tipo++;
}
$contenido.="</div>";
$lista = $datos['lista'];
$contenido_lista = "";
$filtros = array('linea' => array(), 'categoria'=>array(), 'grupo'=>array(),'nombre'=>array());

//Listo las investigaciones asignadas
foreach ($lista as $item) {
    if (!in_array($item['linea'], $filtros['linea'])) {
        $filtros['linea'][] = $item['linea'];
    }
    if (!in_array($item['categoria'], $filtros['categoria'])) {
        $filtros['categoria'][] = $item['categoria'];
    }
    if (!in_array($item['grupo'], $filtros['grupo'])) {
        $filtros['grupo'][] = $item['grupo'];
    }
    if (!in_array($item['nombre'], $filtros['nombre'])) {
        $filtros['nombre'][] = $item['nombre'];
    }
    
    
    $contenido_lista.="<tr>" 
            . "<td>{$item['nombre']}</td>"
            . "<td>{$item['linea']}</td>"
            . "<td>{$item['categoria']}</td>"                
            . "<td>{$item['grupo']}</td>"
            . "<td>{$item['colegio']}</td>"
            . "<td>{$item['municipio']}</td>"
            . "<td>{$item['calificacion']}</td>"
            . "</tr>";
}

$select_t = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['linea'] as $t) {
    if ($t != ""){
        $select_t.="<option value='$t' >$t</option>";
    }
}
$select_t.="</select>";
$select_E = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['categoria'] as $t) {
    if ($t != ""){
        $select_E.="<option value='$t' >$t</option>";
    }
}
$select_E.="</select>";
$select_grupo = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['grupo'] as $t) {
    if ($t != ""){
        $select_grupo.="<option value='$t' >$t</option>";
    }
}
$select_grupo.="</select>";
$select_investigacion = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['nombre'] as $t) {
    if ($t != ""){
        $select_investigacion.="<option value='$t' >$t</option>";
    }
}
$select_investigacion.="</select>";
echo elgg_view_form("reportes/form_impresion");
?>
<div>
    <div>
        <ul class="tabs-coordinacion">
            <li class="selected" onclick="verEstaditicas(this)"><a href="#" class="tab-asesores" name="asignados" rel="nofollow">Estadisticas</a></li>
            <li onclick="verListado(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Calificaciones</a></li>
        </ul>
        <div class="tabs-asesores">
            <div id="estaditicas">
                <?php echo $contenido ?>
            </div>
            <div id="listados">
                <div class="filtros">
                    <br>
                    <h2 class="titulo-reportes">Filtros</h2>
                    <br>
                    <label></label>
                    <div class="row">
                        <label>Investigación</label>
                        <?php echo $select_investigacion ?>
                    </div>
                    <div class="row">
                        <label>Grupo de Investigación</label>
                        <?php echo $select_grupo ?>
                    </div>
                    <div class="row">
                        <label>Línea Temática</label>
                        <?php echo $select_t ?>
                    </div>
                    <div class="row">
                        <label>Categoría</label>
                        <?php echo $select_E ?>
                    </div>
                </div>
                    <br>
                    <div id="imprimir">
                    <h2 class="titulo-reportes">Calificaciones de Investigaciones Asignadas al Asesor <?php echo $as->name." ".$as->apellidos?> en la Convocatoria: <?php echo get_entity($conv)->name ?></h2>
                    <br>
                    <form action="http://<?php echo elgg_get_url_server()?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-calif-asesor')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-calif-asesor" class="responstable">
                        <thead><tr><th>Investigación</th><th>Línea Temática</th><th>Categoría</th><th>Grupo</th><th>Colegio</th><th>Municipio</th><th>Calificación</th></tr></thead>
                        <tbody><?php echo $contenido_lista ?></tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            var loadInstituciones = false;
            var loadGrupos = false;
            function verEstaditicas(element) {
                deseleccionarTodos();
                $(element).addClass('selected');
                $("#listados").hide();
                $("#estaditicas").show();
            }

            function verListado(element) {
                deseleccionarTodos();
                $(element).addClass('selected');
                $("#listados").show();
                $("#estaditicas").hide();
            }

         

            function deseleccionarTodos() {
                $(".tabs-coordinacion li").each(function() {
                    $(this).removeClass("selected");
                });
            }

            function consultarTabla() {
                $("#tabla-calif-asesor_filter label input").val("");
                var busqueda = "";
                $(".select-filtro").each(function() {
                    var text = $(this).val() + " ";
                    if (text != " ") {
                        busqueda += text;
                    }
                });
                $("#tabla-calif-asesor_filter label input")
                        .val(busqueda)
                        .change();
            }
            ;

            $(document).ready(function() {
                var table = $('#tabla-calif-asesor').dataTable({
                    "bPaginate": false
                });
                $("#listados").hide();
            });
        </script>
    </div>    
    <?php
    ?>