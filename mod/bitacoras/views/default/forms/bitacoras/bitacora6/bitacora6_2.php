
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
$bitacora = new Elgg_Bitacora6_2($vars['guid_bitacora']);
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
        <?php echo 'BITÁCORA N°6.2. RECORRIDO DE LA TRAYECTORIA DE INDAGACIÓN' ?>
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
    </table><br><br>
    <p><b>REGISTRO DE SISTEMATIZACIÓN para el maestro (a) acompañante/coinvestigador:</b>
        Complementar la bitácora 6 del semillero de investigación de usted acompaña: </p><br>
    <table class="tabla-bitacoras">
        <tr>
            <td>• Describir las dificultades que se presentaron en el grupo para obtener 
                los resultados en los segmentos de investigación propuestos</td>
        </tr>
        <tr>
            <td>
                <textarea name="dificultades"><?php echo $bitacora->dificultades ?></textarea>
            </td>
        </tr>
        <tr>
            <td>• Describir las fortalezas del grupo de investigación para tomar 
                decisiones sobre los resultados de las trayectorias y para argumentarlas.</td>
        </tr>
        <tr>
            <td>
                <textarea name="fortalezas"><?php echo $bitacora->fortalezas ?></textarea>
            </td>
        </tr>
        <tr>
            <td>• Después de desarrollar los segmentos para la trayectoria de indagación, 
                cuáles serían las características del espíritu científico que se fomenta desde el Proyecto Enjambre.</td>
        </tr>
        <tr>
            <td>
                <textarea name="caracteristicas"><?php echo $bitacora->caracteristicas ?></textarea>
            </td>
        </tr>
        <tr>
            <td>• A la luz de las etapas de investigación trabajadas hasta ahora, enuncie 
                lo que para usted serían las principales características de un proceso de formación 
                en el cual la investigación es la estrategia pedagógica.</td>
        </tr>
        <tr>
            <td>
                <textarea name='estrategia'><?php echo $bitacora->estrategia ?></textarea>
            </td>
        </tr>
        <tr>
            <td>• Mencione los Logros y Dificultades en el proceso investigativo de este segmento o trayecto.</td>
        </tr>
        <tr>
            <td>
                <textarea name='logros'><?php echo $bitacora->logros ?></textarea>
            </td>
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

