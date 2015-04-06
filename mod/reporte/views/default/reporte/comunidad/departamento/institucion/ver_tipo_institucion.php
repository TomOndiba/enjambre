<?php
$departamento = get_input("departamento");
$datos = elgg_get_instituciones_por_departamento_tipo_institucion($departamento);

$tabla = $datos['tabla'];
$table['cols'] = array(
    array('label' => 'Grado', 'type' => 'string'),
    array('label' => 'Total', 'type' => 'number')
);

$tabla_resumen = "<table class='responstable'>"
        . "<thead><tr><th>Género</th><th>Número de Niños</th></tr></thead>";

$rows = array();
$total = 0;
foreach ($tabla as $element => $valor) {
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



$lista = $datos['lista'];
$contenido = "";
$filtros = array('tipo' => array());
foreach ($lista as $element => $lista) {
    foreach ($lista as $item) {
         if (!in_array($item->tipo_institucion, $filtros['tipo'])) {
            $filtros['tipo'][] = $item->tipo_institucion;
        }
        $contenido.="<tr>"
                . "<td>$item->name </td>"
                . "<td>$item->municipio</td>"
                . "<td>$item->tipo_institucion</td>"
                . "</tr>";
    }
}

$select_tipo = '<select onchange="consultarTabla(this)"><option></option>';
foreach ($filtros['tipo'] as $tipo) {
    $select_tipo.="<option value='$tipo'>$tipo</option>";
}
$select_tipo.="</select>";
echo elgg_view_form("reportes/form_impresion");


?>
<script  type = "text/javascript">
    var data= <?php echo $json_data;?>;
    var titulo=  "";
    drawChart(data, titulo);
</script>  

<div class="vista-reporte">
    <h2 class="titulo-reporte">Instituciones de <?php echo $departamento ?> por Tipo</h2>

    <div class="div-graficos">
        <div id = "grafica"  style = "height :  300px ; " ></div> 
        <div id="tabla-resumen" >
            <?php echo $tabla_resumen; ?>
        </div>
    </div>
    <a onclick="imprimirReporte()">Imprimir</a>


<table id="tabla-datos" class="responstable">
    <thead><tr><th>Nombre</th><th>Municipio</th><th>Tipo de Institucion</th></tr></thead>
    <tfoot><tr><th class="column-footer"></th><th class="column-footer"></th><th class="column-footer"><?php echo $select_tipo; ?></th></tr></tfoot>
    <tbody><?php echo $contenido ?></tbody>
</table>
<script>
    $(document).ready(function() {
        var table = $('#tabla-datos').dataTable();
        $(".column-footer").each(function(i) {
             alert(table.column(i));
            var select = $('<select><option value=""></option></select>')
                    .appendTo($(this).empty())
                    .live('change', function() {
                       
                        var val = $(this).val();
                        table.column(i)
                                .search(val ? '^' + $(this).val() + '$' : val, true, false)
                                .draw();
                    });
          //alert(table.column(i).data());
//            table.column(i).data().unique().sort().each(function(d, j) {
//                select.append('<option value="' + d + '">' + d + '</option>')
//            });
//        });
        });
    })

</script>
