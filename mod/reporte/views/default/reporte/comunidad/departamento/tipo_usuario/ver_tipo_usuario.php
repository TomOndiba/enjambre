<?php

/**
 * Vista ajax que recibe el departamento y busca los maestros y estudiantes registrados en la comunidad
 * @author DIEGOX_CORTEX
 */

$dpto = get_input('dpto');

$datos = elgg_get_usuarios_by_tipo($dpto);

$tabla = $datos['tabla'];
$table['cols'] = array(
    array('label' => 'Genero', 'type' => 'string'),
    array('label' => 'Total', 'type' => 'number')
);
$total = 0;
$tabla_resumen = "<table class='responstable'>"
        . "<thead><tr><th>Tipo de Usuario</th><th>Número de Usuarios</th></tr></thead>";
$rows=array();
foreach ($tabla as $element => $valor) {
    $temp = array();
    $temp[] = array('v' => $element);
    $temp[] = array('v' => $valor);
    $rows[] = array('c' => $temp);
    $tabla_resumen.="<tr><td><b>$element</b></td><td>$valor</td></tr>";
    $total += $valor;
}
$tabla_resumen.="<tr><td><b>Total</b></td><td>$total</td></tr></table>";  
$table['rows'] = $rows;
$json_data = json_encode($table);

//Total del resultado de la consulta
$num=$tabla['estudiante'];
$num+= $tabla['maestro'];



$lista = $datos['lista'];
$contenido = "";
foreach ($lista as $element => $lista) {
    foreach ($lista as $item) {
        $sub = $item->getSubtype();
        $contenido.="<tr>"
                . "<td>$item->name $item->apellidos</td>"
                . "<td>$item->sexo</td>"
                . "<td>$sub</td>"
                . "<td>$item->institucion</td>"
                . "<td>$item->municipio</td>"
                . "</tr>";
    }
}


?>
<script  type = "text/javascript">
    var data= <?php echo $json_data;?>;
    var titulo= "Gráfica de Usuarios de <?php echo $dpto?> por Tipo";
    drawChart(data, titulo);
</script>  
<div class="vista-reporte">
    <h2 class="titulo-reporte">Tipos de Usuarios de <?php echo $dpto ?></h2>

    <div class="div-graficos">
        <div id = "grafica"  style = "height :  300px ; " ></div> 
        <div id="tabla-resumen" >
            <?php echo $tabla_resumen; ?>
        </div>
    </div>

    <table id="tabla-datos" class="responstable">
        <thead><tr><th>Nombre</th><th>Genero</th><th>Tipo</th><th>Institución</th><th>Municipio</th></tr></thead>
        <tfoot><tr><th class="column-footer">Nombre</th><th class="column-footer">Genero</th><th class="column-footer">Curso</th><th>Institución</th><th>Municipio</th></tr></tfoot>
        <tbody><?php echo $contenido ?></tbody>
    </table>
</div>






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
