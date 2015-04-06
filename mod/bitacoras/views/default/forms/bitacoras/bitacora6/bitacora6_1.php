
<?php
/**
 * Formulario que muestra los datos para llenar en la bitácora4
 * @author CARLOS RINCON
 */
elgg_load_js("vista_modal");
elgg_load_js("reveal2");
elgg_load_css('reveal');

$inv = $vars['inv'];
$grupo = $vars['grupo'];
$bitacora = new Elgg_Bitacora6_1($vars['guid_bitacora']);
$institucion = $bitacora->getInstitucion($grupo);
$user = elgg_get_logged_in_user_guid();
?>
<style>
    p{
        font-weight: normal !important;
    }

    textarea{
        width: 100%;
    }
</style>

<div class="box div-editar-bitacoras">
    <h2 class='title-legend'>
        <?php echo 'BITÁCORA N°6.1. RECORRIDO DE LA TRAYECTORIA DE INDAGACIÓN' ?>
    </h2><br>
    <br><table class="tabla-bitacoras">
        <tr>
            <td>
                <b>Nombre del EE al que pertenece el grupo de investigación</b> 
            </td>
            <td><?php echo $institucion->name ?></td>
        </tr>
        <tr>
            <td><b>Municipio :   </b><?php echo $institucion->municipio; ?></td>
            <td><b>Dirección :   </b><?php echo $institucion->direccion; ?></td>
        </tr>
        <tr>
            <td><b>Email de la Institución :   </b><?php echo $institucion->email; ?></td>
            <td><b>Tipo de Institución :   </b><?php echo $institucion->tipo; ?></td>
        </tr>
        <tr>
            <td><b>Nombre del Grupo de Investigacion: </b></td>
            <td><?php echo $grupo->name; ?></td>
        </tr>         
    </table><br>
    <table class='tabla-bitacoras'>
        <tr>
            <td> Resultados de las técnicas e instrumentos utilizados para el segmento de investigación. 
                Con base en la identificación de las técnicas a emplear en su investigación, como la entrevista,
                encuesta, experimentos, mediciones y/o otros, realizar una descripción de los resultados obtenidos 
                hasta el momento en la utilización de cada una de estas técnicas e instrumentos. <br>
                Se plasman los resultados obtenidos hasta el momento, evidencia   fotográfica y/o videos 
                (esto es propio de cada grupo de investigación)</td>
        </tr>
        <tr>
            <td><textarea name='tecnicas'><?php echo $bitacora->tecnicas?></textarea></td>
        </tr>
        <tr>
            <td>Resultados salida de campo. Se consignan los resultados obtenidos en las salidas de campo. 
                Se requiere evidencia fotográfica y/o videos (esto es propio de cada grupo de investigación).</td>
        </tr>        
        <tr>
            <td><textarea name='salidas'><?php echo $bitacora->actividades?></textarea></td>
        </tr>
        <tr>
            <td>Organización adecuada de la información recogida. <br>
                Se sugiere que organicen la información obtenida (resultados) de cada uno 
                de los segmentos en forma organizada. Aquí el grupo de investigación puede elaborar 
                una lista, a manera de resumen, de los resultados más significativos.</td>
        </tr>        
        <tr>
            <td><textarea name='organizacion'><?php echo $bitacora->actividades?></textarea></td>
        </tr>
        <tr>
            <td>Actividades no propuestas durante la trayectoria o segmento de investigación. 
                Se plasman las actividades no propuestas en el cronograma de actividades y que son necesarias 
                para el desarrollo y solución para la pregunta de investigación. (Esta depende de cada grupo 
                de investigación y si es necesario)</td>
        </tr>        
        <tr>
            <td><textarea name='actividades'><?php echo $bitacora->actividades?></textarea></td>
        </tr>
    </table>
    <?php
    if ($user == $inv->owner_guid) {
        ?>
        <input type='hidden' name='bitacora' value='<?php echo $bitacora->guid;?>'/>
        <input type="submit" value="Guardar">
        <?php
    }
    ?>
</div>

