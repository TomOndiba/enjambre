<?php
/**
 * Vista que muestra el reporte de los estudiantes que participan en una convocatoria.
 * @author DIEGOX_CORTEX
 */
$conv = get_input('guid_conv');


$datos = elgg_get_investigaciones_convByDpto($conv);
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
$filtros = array('tipo' => array(), 'linea'=>array(), 'estado'=>array());

//Listo las investigaciones
foreach ($lista as $item) {
    if (!in_array($item['categoria_inv'], $filtros['tipo'])) {
        $filtros['tipo'][] = $item['categoria_inv'];
    }
    if (!in_array($item['linea_tematica'], $filtros['linea'])) {
        $filtros['linea'][] = $item['linea_tematica'];
    }
    if (!in_array($item['estado'], $filtros['estado'])) {
        $filtros['estado'][] = $item['estado'];
    }

    $contenido_lista.="<tr>"
            . "<td>{$item['name']}</td>"
            . "<td>{$item['categoria_inv']}</td>"
            . "<td>{$item['linea_tematica']}</td>"
            . "<td>{$item['grupo']}</td>"
            . "<td>{$item['estado']}</td>"
            . "</tr>";
}

$select_t = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['tipo'] as $t) {
    if ($t != "") {
        $select_t.="<option value='$t' >$t</option>";
    }
}
$select_t.="</select>";

$select_L = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['linea'] as $l) {
    if ($l != "") {
        $select_L.="<option value='$l' >$l</option>";
    }
}
$select_L.="</select>";

$select_E = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['estado'] as $e) {
    if ($e != "") {
        $select_E.="<option value='$e' >$e</option>";
    }
}
$select_E.="</select>";


echo elgg_view_form("reportes/form_impresion");
?>
<div>
    <div>
        <ul class="tabs-coordinacion">
            <li class="selected" onclick="verEstaditicas(this)"><a href="#" class="tab-asesores" name="asignados" rel="nofollow">Estadisticas</a></li>
            <li onclick="verListado(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Investigaciones</a></li>
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
                        <label>Categoria de la Investigación</label>
                        <?php echo $select_t ?>
                    </div>
                    <div class="row">
                        <label>Línea Temática</label>
                        <?php echo $select_L ?>
                    </div>
                    <div class="row">
                        <label>Estado de la Investigación</label>
                        <?php echo $select_E ?>
                    </div>
                </div>
                <div id="imprimir">
                    <br>
                    <h2 class="titulo-reportes">Investigaciones de la Convocatoria <?php echo get_entity($conv)->name ?></h2>
                    <br>
                    <form action="http://<?php echo elgg_get_url_server()?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-investigaciones-conv')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-investigaciones-conv" class="responstable">
                        <thead><tr><th>Nombre</th><th>Categoria de la Investigación</th><th>Línea Temática</th><th>Grupo de Investigación</th><th>Estado de la Investigación</th></tr></thead>
                        
                        <tbody><?php echo $contenido_lista ?></tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            
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
                $("#tabla-investigaciones-conv_filter label input").val("");
                var busqueda = "";
                $(".select-filtro").each(function() {
                    var text = $(this).val() + " ";
                    if (text != " ") {
                        busqueda += text;
                    }
                });
                $("#tabla-investigaciones-conv_filter label input")
                        .val(busqueda)
                        .change();
            }
            ;

            $(document).ready(function() {
                var table = $('#tabla-investigaciones-conv').dataTable({
                    "bPaginate": false
                });
                $("#listados").hide();
            });
        </script>
    </div>    
    <?php ?>