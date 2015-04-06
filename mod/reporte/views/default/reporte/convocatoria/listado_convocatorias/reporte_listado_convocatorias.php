<?php

/**
 * Vista que muestra el resultado del reporte del listado de convocatorias por rango de fechas
 * @author DIEGOX_CORTEX
 */
$fecha_desde = get_input('fecha_desde');
$fecha_hasta = get_input('fecha_hasta');

$datos = elgg_get_listado_convocatoriasFechas($fecha_desde, $fecha_hasta);
$convocatorias = $datos['lista'];
$tablas = $datos['tablas'];
$lineas = $tablas['Linea Temàtica'];
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
$filtros = array('tipo_convocatoria' => array(), 'linea' => array());

foreach ($lista as $item) {
    if (!in_array($item['tipo_convocatoria'], $filtros['tipo_convocatoria'])) {
        $filtros['tipo_convocatoria'][] = $item['tipo_convocatoria'];
    }
    $ln = $datos['lineas'];

    $contenido_lista.="<tr>"
            . "<td>{$item['name']}</td>"
            . "<td>{$item['tipo_convocatoria']}</td>"
            . "<td>{$item['departamento']}</td>"
            . "<td>{$item['fecha_apertura']}</td>"
            . "<td>{$item['fecha_cierre']}</td>"
            . "<td>{$item['lineas']}</td>"
            . "</tr>";
}

foreach ($lineas as $l => $x){
    if (!in_array($l, $filtros['linea'])) {
        $filtros['linea'][] = $l;
    }
}
$select_l = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['linea'] as $l){
    if ($l != ""){
        $select_l.="<option value='$l' >$l</option>";
    }
}
$select_l .= "</select>";
$select_t = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['tipo_convocatoria'] as $t) {
    if ($t != ""){
        $select_t.="<option value='$t' >$t</option>";
    }
}
$select_t.="</select>";


echo elgg_view_form("reportes/form_impresion");
?>
<div>
    <div>
        <ul class="tabs-coordinacion">
            <li class="selected" onclick="verEstaditicas(this)"><a href="#" class="tab-asesores" name="asignados" rel="nofollow">Estadisticas</a></li>
            <li onclick="verListado(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Convocatorias</a></li>
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
                        <label>Tipo de Convocatoria</label>
                        <?php echo $select_t ?>
                    </div>
                    <div class="row">
                        <label>Línea Temática</label>
                        <?php echo $select_l;?>
                    </div>
                </div>
                <div id="imprimir">
                    <br>
                    <h2 class="titulo-reportes">Convocatorias desde <?php echo $fecha_desde ?> Hasta <?php echo $fecha_hasta;?></h2>
                    <form action="http://<?php echo elgg_get_url_server()?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-datos-convocatoria')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-datos-convocatoria" class="responstable">
                        <thead><tr><th>Nombre</th><th>Tipo de Convocatoria</th><th>Departamento</th><th>Fecha Apertura</th><th>Fecha Cierre</th><th>Línea Temática</th></tr></thead>
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
                $("#listado-instituciones").hide();
                $("#estaditicas").show();
            }

            function verListado(element) {
                deseleccionarTodos();
                $(element).addClass('selected');
                $("#listados").show();
                $("#listado-instituciones").hide();
                $("#estaditicas").hide();
            }

         

            function deseleccionarTodos() {
                $(".tabs-coordinacion li").each(function() {
                    $(this).removeClass("selected");
                });
            }

            function consultarTabla() {
                $("#tabla-datos-convocatoria_filter label input").val("");
                var busqueda = "";
                $(".select-filtro").each(function() {
                    var text = $(this).val() + " ";
                    if (text != " ") {
                        busqueda += text;
                    }
                });
                $("#tabla-datos-convocatoria_filter label input")
                        .val(busqueda)
                        .change();
            }
            ;

            $(document).ready(function() {
                var table = $('#tabla-datos-convocatoria').dataTable({
                    "bPaginate": false
                });
                $("#listados").hide();
            });
        </script>
    </div>    
    <?php
    ?>