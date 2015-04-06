<h2 class="titulo-reportes title-legend">Reporte de Convocatorias por Fechas</h2>
<br><label> Seleccione el rango de fechas, desde - hasta, para consultar las convocatorias.</label>
<?php

/**
 * Vista que muestra el rango de fechas para consultar el listado de convocatorias
 * @author DIEGOX_CORTEX
 */
$fecha_desde = elgg_view('input/date', array('name' => 'fecha_desde', 'id' => 'fecha_desde'));
$fecha_hasta = elgg_view('input/date', array('name' => 'fecha_hasta', 'id' => 'fecha_hasta'));
?>
<label>Feche desde:</label>
<?php echo $fecha_desde;?>
<label>Fecha hasta:</label>
<?php echo $fecha_hasta;?>
<a onclick="verlistadoConvocatorias()" class="elgg-button elgg-button-submit">Verificar</a><br> <br>
<div id="contenido-reporte">

</div>

<script>
    function verlistadoConvocatorias() {
        var decha_desde = $('#fecha_desde').val();
        var fecha_hasta = $('#fecha_hasta').val();
        elgg.get('ajax/view/reporte/convocatoria/listado_convocatorias/reporte_listado_convocatorias', {
            timeout: 30000,
            data: {
                fecha_desde: decha_desde,
                fecha_hasta: fecha_hasta
            },
            success: function(result, success, xhr) {
                $("#contenido-reporte").html(result);
            },
        });

    }

</script>