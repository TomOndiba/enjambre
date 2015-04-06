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
    <h3 style="color: #000000; font-size: 14pt; align:center">Actividades a realizar</h3>
    <h3 style="color: #000000; font-size: 12pt; alignment-adjust: central">1.	Definir los espacios o escenarios para la propagación</h3><br>

    <?php echo elgg_echo('bitacora8:actividades'); ?>
    <br>
    <h3 style="color: #000000; font-size: 12pt; alignment-adjust: central">Registre en las siguientes tablas, los espacios, lenguajes y medios utilizados para la propagación de la Onda:</h3>
    <br>
    <table class="tabla-bitacoras">
        <tr>
            <th bgcolor="#FAA803" colspan="5">1.	La propagación de los resultados de la convocatoria en nuestra institución educativa, en la comunidad y en la familia</th>
        </tr>
        <tr>
            <td>Espacios</td>
            <td>Lenguaje</td>
            <td>Medios</td>
            <td>Fecha</td>
            <td>Responsable</td>
        </tr>               
        <tr>
            <td><textarea name="t11"><?php echo $bitacora->t11 ?></textarea></td>
            <td><textarea name="t12"><?php echo $bitacora->t12 ?></textarea></td>
            <td><textarea name="t13"><?php echo $bitacora->t13 ?></textarea></td>
            <td><textarea name="t14"><?php echo $bitacora->t14 ?></textarea></td>
            <td><textarea name="t15"><?php echo $bitacora->t15 ?></textarea></td>
        </tr>
    </table>  
    <br>
    <table class="tabla-bitacoras">
        <tr>
            <th bgcolor="#CE9AD0" colspan="5">2.	La propagación durante el recorrido de la trayectoria de indagación y una vez finalizada la investigación</th>
        </tr>
        <tr>
            <td>Espacios</td>
            <td>Lenguaje</td>
            <td>Medios</td>
            <td>Fecha</td>
            <td>Responsable</td>
        </tr>
        <tr>
            <td><textarea name="t21"><?php echo $bitacora->t21 ?></textarea></td>
            <td><textarea name="t22"><?php echo $bitacora->t22 ?></textarea></td>
            <td><textarea name="t23"><?php echo $bitacora->t23 ?></textarea></td>
            <td><textarea name="t24"><?php echo $bitacora->t24 ?></textarea></td>
            <td><textarea name="t25"><?php echo $bitacora->t25 ?></textarea></td>
        </tr>
    </table>
    <br>
    <table class="tabla-bitacoras">
        <tr>
            <th bgcolor="#8E8EFB" colspan="5">3.	La propagación finalizada la investigación</th>
        </tr>
        <tr>
            <td>Espacios</td>
            <td>Lenguaje</td>
            <td>Medios</td>
            <td>Fecha</td>
            <td>Responsable</td>
        </tr>
        <tr>
            <td><textarea name="t31"><?php echo $bitacora->t31 ?></textarea></td>
            <td><textarea name="t32"><?php echo $bitacora->t32 ?></textarea></td>
            <td><textarea name="t33"><?php echo $bitacora->t33 ?></textarea></td>
            <td><textarea name="t34"><?php echo $bitacora->t34 ?></textarea></td>
            <td><textarea name="t35"><?php echo $bitacora->t35 ?></textarea></td>
        </tr>
    </table> 
    <br>
    <label>c.	Describa los medios propuestos y utilizados para la divulgación del proyecto, así como sus resultados.</label>
    <br><br>
    <h3 style="color: #000000; font-size: 12pt; alignment-adjust: central">2.	En este espacio deben escribir como se proyecta el equipo de investigación para el próximo año, teniendo en cuenta todos los aprendizajes y logros obtenidos en su experiencia investigativa con el apoyo del Programa ONDAS.</h3>
    <br>
    <p><b>REGISTRO DE SISTEMATIZACIÓN Para el maestro (a) acompañante/coinvestigador:</b>
        Complementar la bitácora 7 del semillero de investigación de usted acompaña: </p>
    <br>
    <table class="tabla-bitacoras">
        <tr>
            <td>• Has recorrido la travesía de el Proyecto Enjambre, ahora realiza un ensayo en el 
                que muestres el proceso metodológico de la investigación como estrategia 
                pedagógica para los maestros. En él debes incluir lo que sería tu fundamentación 
                conceptual sobre este asunto y la indagación que realza y aprende el niño, 
                la niña y el joven en el Proyecto Enjambre</td>
        </tr>
        <tr>
            <td><textarea name="ensayo"><?php echo $bitacora->ensayo; ?></textarea></td>
        </tr>
        <br>

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