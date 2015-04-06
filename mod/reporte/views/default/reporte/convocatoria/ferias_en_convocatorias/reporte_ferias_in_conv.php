<?php
/**
 * Vista que muestra el reporte de los estudiantes que participan en una convocatoria.
 * @author DIEGOX_CORTEX
 */
$conv = get_entity(get_input('guid_conv'));

$datos = elgg_get_ferias_in_convocatoria($conv);
//$estudiantes = $datos['lista'];
//$tablas = $datos['tablas'];
//$tipo = 0;
//$contenido = "<div>";
//
//foreach ($tablas as $key => $value) {
//    $contenido.="<div class='box-estadistica'><h2 class='titulo-reportes'>$key</h2>";
//    $table = array();
//    $tabla_resumen = "";
//    $table['cols'] = array(
//        array('label' => $key, 'type' => 'string'),
//        array('label' => 'Total', 'type' => 'number')
//    );
//
//    $tabla_resumen = "<table class='responstable'>"
//            . "<thead><tr><th>$key</th><th>Número</th></tr></thead>";
//    $rows = array();
//    $total = 0;
//    foreach ($value as $element => $valor) {
//        $temp = array();
//        $temp[] = array('v' => $element);
//        $temp[] = array('v' => $valor);
//        $rows[] = array('c' => $temp);
//        $tabla_resumen.="<tr><td><b>$element</b></td><td>$valor</td></tr>";
//        $total+=$valor;
//    }
//    $tabla_resumen.="<tr><td><b>Total</b></td><td>$total</td></tr></table>";
//    $table['rows'] = $rows;
//    $json_data = json_encode($table);
//    $contenido.="<div id='grafica-$tipo' class='grafica'></div>";
//    $contenido.= elgg_view('reporte/comunidad/departamento/pintar_grafica', array('datos' => $json_data, 'tipo' => $key, 'numero' => $tipo));
//    $contenido.=$tabla_resumen;
//    $contenido.="</div>";
//    $tipo++;
//    error_log('Visajeando para la Toma de la Grbación....');
//}
//$contenido.="</div>";
//$lista = $datos['lista'];
//$contenido_lista = "";
//$filtros = array('tipo' => array(), 'etnia' => array());

if (sizeof($datos) > 0) {
    foreach ($datos as $item) {
//    if (!in_array($item['sexo'], $filtros['tipo'])) {
//        $filtros['tipo'][] = $item['sexo'];
//    }
//    if (!in_array($item['etnia'], $filtros['etnia'])) {
//        $filtros['etnia'][] = $item['etnia'];
//    }


        $contenido_lista.="<tr>"
                . "<td>{$item['nombre']}</td>"
                . "<td>{$item['fecha_inicio']}</td>"
                . "<td>{$item['fecha_terminacion']}</td>"
                . "<td>{$item['lugar']}</td>"
                . "</tr>";
    }
} 


//$select_t = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
//foreach ($filtros['tipo'] as $t) {
//    if ($t != "") {
//        $select_t.="<option value='$t' >$t</option>";
//    }
//}
//$select_t.="</select>";
//$select_E = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
//foreach ($filtros['etnia'] as $t) {
//    if ($t != "") {
//        $select_E.="<option value='$t' >$t</option>";
//    }
//}
//$select_E.="</select>";
//
//echo elgg_view_form("reportes/form_impresion");
?>
<div>
    <div>
        <ul class="tabs-coordinacion">
            <li class="selected" onclick="verEstaditicas(this)"><a href="#" class="tab-asesores" name="asignados" rel="nofollow">Ferias</a></li>
            
        </ul>
        <div class="tabs-asesores">
            <div id="estaditicas">
                <div id="imprimir">
                    <h2 class="titulo-reportes">Ferias Dentro de la Convocatoria <?php echo $conv->name ?></h2>
                    <form action="http://<?php echo elgg_get_url_server() ?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-estudiantes-conv')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-estudiantes-conv" class="responstable">
                        <?php echo $contenido_listaV; ?>
                        <thead><tr><th>Nombre</th><th>Fecha Inicio</th><th>Fecha Terminación</th><th>Lugar</th></tr></thead>

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
                $("#tabla-estudiantes-conv_filter label input").val("");
                var busqueda = "";
                $(".select-filtro").each(function() {
                    var text = $(this).val() + " ";
                    if (text != " ") {
                        busqueda += text;
                    }
                });
                $("#tabla-estudiantes-conv_filter label input")
                        .val(busqueda)
                        .change();
            }
            ;

            $(document).ready(function() {
                var table = $('#tabla-estudiantes-conv').dataTable({
                    "bPaginate": false
                });
                $("#listados").hide();
            });
        </script>
    </div>    
    <?php ?>