<?php
/**
 * Vista que muestra el reporte de los proyectos asiganodos a un asesor
 * @author DIEGOX_CORTEX
 */
$investigacion = get_input('guid_inv');
$asesor = get_input('guid_asesor');
$as = get_entity($asesor);

if ($investigacion == "todos") {
    $datos = get_asesorias_all_investigaciones($asesor);
} else {
    $datos = get_asesorias_investigacion($investigacion);
}
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
$filtros = array('linea' => array(), 'tipo' => array());


//Listo las investigaciones asignadas
foreach ($lista as $item) {
    if (!in_array($item['linea'], $filtros['linea'])) {
        $filtros['linea'][] = $item['linea'];
    }
    if (!in_array($item['tipo'], $filtros['tipo'])) {
        $filtros['tipo'][] = $item['tipo'];
    }
    $contenido_lista.="<tr>"
            . "<td>{$item['nombre']}</td>"
            . "<td>{$item['fecha']}</td>"
            . "<td>{$item['hora']}</td>"
            . "<td>{$item['tipo']}</td>"
            . "<td>{$item['observaciones']}</td>";
    if ($investigacion == "todos") {
        $contenido_lista .= "<td>{$item['investigacion']}</td>"
                . "<td>{$item['linea']}</td>";
                
    }
    $contenido_lista .= "</tr>";
}
$head = "<th>Nombre</th><th>Fecha</th><th>Hora</th><th>Tipo</th><th>Observaciones</th>";

if ($investigacion == "todos") {
    $head .= "<th>Investigación</th><th>Línea Temática</th>";
    $select_t = '<label>Línea Temática</label><select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
    foreach ($filtros['linea'] as $t) {
        if ($t != "") {
            $select_t.="<option value='$t' >$t</option>";
        }
    }
}
$select_t.="</select>";
$select_E = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['tipo'] as $t) {
    if ($t != "") {
        $select_E.="<option value='$t' >$t</option>";
    }
}
$select_E.="</select>";

$asesor = "<center><h2><span>Asesor</span></h2>"
        . "<li class='item-usuario'>"
        . "<a><img src='{$as->getIconURL()}' /></a><div><div><a><span class='name-usuario'>{$as->name} {$as->apellidos}</span></a></div>"
        . "</li></center><br><br>";

echo elgg_view_form("reportes/form_impresion");
?>

    <div>
        <ul class="tabs-coordinacion">
            <li class="selected" onclick="verEstaditicas(this)"><a href="#" class="tab-asesores" name="asignados" rel="nofollow">Estadisticas</a></li>
            <li onclick="verListado(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Asesorias</a></li>
        </ul>
        <div class="tabs-asesores">
            <div>
                <?php echo $asesor; ?>
            </div>
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
                        
                        <?php echo $select_t ?>
                    </div>
                    <div class="row">
                        <label>Tipo</label>
                        <?php echo $select_E ?>
                    </div>
                </div>
                    <br>
                    <div id="imprimir">
                         <h2 class="titulo-reportes">Asesorias de <?php echo $as->name." ".$as->apellidos ?></h2>
                        <form action="http://<?php echo elgg_get_url_server()?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-asesorias')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-asesorias" class="responstable">
                        <thead><tr><?php echo $head;?></tr></thead>
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
                $("#tabla-asesorias_filter label input").val("");
                var busqueda = "";
                $(".select-filtro").each(function() {
                    var text = $(this).val() + " ";
                    if (text != " ") {
                        busqueda += text;
                    }
                });
                $("#tabla-asesorias_filter label input")
                        .val(busqueda)
                        .change();
            }
            ;

            $(document).ready(function() {
                var table = $('#tabla-asesorias').dataTable({
                    "bPaginate": false
                });
                $("#listados").hide();
            });
        </script>
    </div>    
    