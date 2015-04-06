<?php
/**
 * Vista
 */
$munic = get_input('munic');

$datos = elgg_get_ferias_municipio($munic);

$tablas = $datos['tablas'];
$areas = $tablas['Area'];
$niveles = $tablas['Niveles'];
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



//Listado de la Tabla
$lista = $datos['lista'];
$contenido_lista = "";
$filtros = array('tipo_feria' => array(), 'areas' => array(), 'niveles' => array());

foreach ($lista as $item) {
    if (!in_array($item['tipo_feria'], $filtros['tipo_feria'])) {
        $filtros['tipo_feria'][] = $item['tipo_feria'];
    }

    $contenido_lista.="<tr>"
            . "<td>{$item['name']}</td>"
            . "<td>{$item['tipo_feria']}</td>"
            . "<td>{$item['departamento']}</td>"
            . "<td>{$item['municipio']}</td>"
            . "<td>{$item['fecha_inicio_feria']}</td>"
            . "<td>{$item['fecha_fin_feria']}</td>"
            . "<td>{$item['areas']}</td>"
            . "<td>{$item['niveles']}</td>"
            . "</tr>";
}

//Areas
foreach ($areas as $l => $x) {
    if (!in_array($l, $filtros['areas'])) {
        $filtros['areas'][] = $l;
    }
}
$select_areas = '<select onchange="consultarTablaFeria()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['areas'] as $l) {
    if ($l != "") {
        $select_areas.="<option value='$l' >$l</option>";
    }
}
$select_areas .= "</select>";



//Niveles
foreach ($niveles as $ni => $x) {
    if (!in_array($ni, $filtros['niveles'])) {
        $filtros['niveles'][] = $ni;
    }
}
$select_niveles = '<select onchange="consultarTablaFeria()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['niveles'] as $l) {
    if ($l != "") {
        $select_niveles.="<option value='$l' >$l</option>";
    }
}
$select_niveles .= "</select>";



//Tipo
$select_t = '<select onchange="consultarTablaFeria()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['tipo_feria'] as $t) {
    if ($t != "") {
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
            <li onclick="verListado(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Ferias</a></li>
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
                        <label>Tipo de Feria</label>
<?php echo $select_t ?>
                    </div>
                    <div class="row">
                        <label>Área de Feria</label>
<?php echo $select_areas; ?>
                    </div>
                    <div class="row">
                        <label>Niveles de Feria</label>
<?php echo $select_niveles; ?>
                    </div>
                </div>
                <br>
                <div id="imprimir">
                    <h2 class="titulo-reportes">Ferias del Departamento <?php echo $munic ?></h2>
                    <br>
                    <form action="http://<?php echo elgg_get_url_server()?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-ferias-munic')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-ferias-munic" class="responstable">
                        <thead><tr><th>Nombre</th><th>Tipo de Feria</th><th>Departamento</th><th>Municipio</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Áreas</th><th>Niveles</th></tr></thead>
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

            function consultarTablaFeria() {
                $("#tabla-ferias-munic_filter label input").val("");
                var busqueda = "";
                $(".select-filtro").each(function() {
                    var text = $(this).val() + " ";
                    if (text != " ") {
                        busqueda += text;
                    }
                });
                $("#tabla-ferias-munic_filter label input")
                        .val(busqueda)
                        .change();
            }
            ;

            $(document).ready(function() {
                var table = $('#tabla-ferias-munic').dataTable({
                    "bPaginate": false
                });
                $("#listados").hide();
            });
        </script>
    </div>    
<?php ?>