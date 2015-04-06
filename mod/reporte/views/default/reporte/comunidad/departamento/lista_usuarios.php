<?php
$dpto = get_input('dpto');
$tipo_usuario = get_input('tipo_usuario');
$genero = get_input('genero');
$grupo_etnico = get_input('grupo_etnico');
$grado = get_input('grado');

$usuarios = elgg_get_usuarios_by_filtros($dpto, $tipo_usuario, $genero, $grupo_etnico);
$total = sizeof($usuarios);
$mujeres = 0;
foreach ($usuarios as $usuario) {
    if ($usuario->sexo == "Femenino") {
        
        $mujeres++;
    }
}
$hombres = $total - $mujeres;
$table['cols'] = array(
    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Genero', 'type' => 'string'),
    array('label' => 'Total', 'type' => 'number')
);
$temp = array();
$temp[] = array('v' => 'Masculino');
$temp[] = array('v' => $hombres);
$rows[] = array('c' => $temp);
$temp= array();
$temp[] = array('v' => 'Femenino');
$temp[] = array('v' => $mujeres);
$rows[] = array('c' => $temp);
$table['rows'] = $rows;
$json_data = json_encode($table);
?>
<script  type = "text/javascript"  src = "https://www.google.com/jsapi" ></script> 
<script  type = "text/javascript" >
    google.load("visualization", "1", {packages: ["corechart"]});
    function drawChart() {
        var data = new google.visualization.DataTable(<?php echo $json_data ?>);

        var opciones = {
            titulo: 'Mi diario Activities',
        };

        var chart = new google.visualization.PieChart(document.getElementById('grafica'));
        chart.draw(data, opciones);
    }
</script>  
<div  id = "grafica"  style = " width :  700px ;  height :  500px ; " ></div> 
