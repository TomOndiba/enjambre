<?php
/**
 * formualrio donde se gestiona la informacion de la bitacora 8
 * @author DIEGOX_CORTEX
 */
$inv = $vars['inv'];
$grupo = $vars['grupo'];
$bitacora = new Elgg_Bitacora8($vars['guid_bitacora']);
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
        <?php echo 'BITÁCORA N°8. PROPAGACION DE RESULTADOS' ?>
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
    <br>
    <h3 style="color: #000000; font-size: 14pt">Actividades a realizar</h3>
    <table>
        <tr><td>Describir qué tipo de comunidades de saber o redes se lograron a 
                través de la ejecución de la investigación, mencionarlas  y ampliar el cómo 
                se hicieron posibles y qué aportes o apoyos obtuvieron de las mismas.</td>
        </tr>
        <tr>
            <td><textarea name="comunidades" ><?php echo $bitacora->comunidades; ?></textarea></td>
        </tr>
    </table><br><br>
    <p><b>REGISTRO DE SISTEMATIZACIÓN Para el maestro (a) acompañante/coinvestigador:</b>
        Complementar la bitácora 7 del semillero de investigación de usted acompaña: </p><br>
    <table class="tabla-bitacoras">
        <tr>
            <td> ¿Cuáles serían las características del espíritu científico que se 
                fomenta en el tipo de organización que propone el Proyecto Enjambre (grupos, líneas, redes y comunidades)?
                Enumérelas.</td>
        </tr>
        <tr>
            <td><textarea name="caracteristicas" ><?php echo $bitacora->caracteristicas; ?></textarea></td>
        </tr>
        <tr>
            <td>¿De qué manera la organización de líneas temáticas, redes y 
                comunidades favorece el desarrollo de estas capacidades: sociales, 
                cognitivas, comunicativas y científicas y cómo se manifiestan en los
                miembros del grupo?.</td>
        </tr>
        <tr>
            <td><textarea name="organizacion" ><?php echo $bitacora->organizacion; ?></textarea></td>
        </tr> 
    </table>
    <?php
    if ($user == $inv->owner_guid) {
        ?>
        <input type='hidden' name='bitacora' value='<?php echo $bitacora->guid; ?>'/>
        <input type="submit" value="Guardar">
        <?php
    }
    ?>
</div>