<?php
/**
 * Vista que muestra el reporte de los estudiantes que participan en una feria.

 */
$guid = get_input('feria');
$feria=get_entity($guid);

$datos = elgg_get_estadisticas_grupos_feria($feria);
//
//$tablas = $datos['tablas'];
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
$lista = $datos['lista'];
$contenido_lista = "";
$filtros = array('tipo' => array());

//Listo las investigaciones
foreach ($lista as $item) {

    $contenido_lista.="<tr>"
            . "<td>{$item['name']}</td>"
            . "<td>{$item['usuarios']}</td>"
            . "<td>{$item['investigaciones']}</td>"
            . "</tr>";
}



echo elgg_view_form("reportes/form_impresion");
?>
<div>
    <div>
        <ul class="tabs-coordinacion">
<!--            <li class="selected" onclick="verEstaditicas(this)"><a href="#" class="tab-asesores" name="asignados" rel="nofollow">Estadisticas</a></li>-->
            <li class="selected" onclick="verListado(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Grupos de Investigación</a></li>
        </ul>
        <div class="tabs-asesores">
<!--            <div id="estaditicas">
                <?php // echo $contenido ?>
            </div>-->
            <div id="listados">
                <div class="filtros">
                    <br>
                </div>
                <div id="imprimir">
                   
                    <h2 class="titulo-reportes">Grupos de Investigación de <?php echo $feria->name ?></h2>
                     <br>
                     <form action="http://<?php echo elgg_get_url_server()?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-grupos-feria')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-grupos-feria" class="responstable">
                        <thead><tr><th>Nombre</th><th>Integrantes</th><th>Investigaciones</th></tr></thead>
                        <tfoot><tr><th class="column-footer">Nombre</th><th class="column-footer">Integrantes</th><th class="column-footer">Investigación</th></tr></tfoot>
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
                $("#tabla-grupos-feria_filter label input").val("");
                var busqueda = "";
                $(".select-filtro").each(function() {
                    var text = $(this).val() + " ";
                    if (text != " ") {
                        busqueda += text;
                    }
                });
                $("#tabla-grupos-feria_filter label input")
                        .val(busqueda)
                        .change();
            }
            ;

            $(document).ready(function() {
                var table = $('#tabla-grupos-feria').dataTable({
                                   "bPaginate": false
                });
//                $("#listados").hide();
           });
        </script>
    </div>    
    <?php ?>