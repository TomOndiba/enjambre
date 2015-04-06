<?php
/**
 * Vista que muestra el resultado del reporte del listado de convocatorias a las que pertenece o ha pertenecido un grupo de investigación
 * @author Erika Parra*/

$guid_grupo = get_input('grupo');
$grupo=  get_entity($guid_grupo);
$datos = elgg_get_estadisticas_convocatoria_grupo($guid_grupo);
$convocatorias = $datos['lista'];
//$tablas = $datos['tablas'];
//$lineas = $tablas['Linea Temàtica'];
//$tipo = 0;
//$contenido = "<div>";
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
//}
//$contenido.="</div>";
//$lista = $datos['lista'];
//$contenido_lista = "";
$filtros = array('tipo_convocatoria' => array(), 'linea' => array());

foreach ($datos as $item) {
    if (!in_array($item['tipo_conv'], $filtros['tipo_convocatoria'])) {
        $filtros['tipo_convocatoria'][] = $item['tipo_conv'];
    }

    $contenido_lista.="<tr>"
            . "<td>{$item['nombre_conv']}</td>"
            . "<td>{$item['tipo_conv']}</td>"
            . "<td>{$item['dpto']}</td>"
            . "<td>{$item['linea']}</td>"
            . "</tr>";
}

//foreach ($lineas as $l => $x){
//    if (!in_array($l, $filtros['linea'])) {
//        $filtros['linea'][] = $l;
//    }
//}
//$select_l = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
//foreach ($filtros['linea'] as $l){
//    if ($l != ""){
//        $select_l.="<option value='$l' >$l</option>";
//    }
//}
//$select_l .= "</select>";
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
<!--            <li class="selected" onclick="verEstaditicas(this)"><a href="#" class="tab-asesores" name="asignados" rel="nofollow">Estadisticas</a></li>-->
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

                </div>
                    <br>
                    <div id="imprimir">
                    <h2 class="titulo-reportes">Convocatorias en las que ha participado el Grupo: <?php echo $grupo->name ?></h2>
                    <br>
                    <form action="http://<?php echo elgg_get_url_server()?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-convoc-grupo')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-convoc-grupo" class="responstable">
                        <thead><tr><th>Nombre</th><th>Tipo de Convocatoria</th><th>Departamento</th><th>Linea Tematica</th></tr></thead>
                        <tbody><?php echo $contenido_lista ?></tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
          
//            function verEstaditicas(element) {
//                deseleccionarTodos();
//                $(element).addClass('selected');
//                $("#listados").hide();
//                $("#estaditicas").show();
//            }

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
                $("#tabla-convoc-grupo_filter label input").val("");
                var busqueda = "";
                $(".select-filtro").each(function() {
                    var text = $(this).val() + " ";
                    if (text != " ") {
                        busqueda += text;
                    }
                });
                $("#tabla-convoc-grupo_filter label input")
                        .val(busqueda)
                        .change();
            }
            ;

            $(document).ready(function() {
                var table = $('#tabla-convoc-grupo').dataTable({
                    "bPaginate": false
                });
//                $("#listados").hide();
            });
        </script>
    </div>    
    <?php
    ?>