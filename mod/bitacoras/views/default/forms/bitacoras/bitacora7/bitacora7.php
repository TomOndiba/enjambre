<?php
/**
 * formualrio donde se gestiona la informacion de la bitacora 7
 * @author DIEGOX_CORTEX
 */


$inv = $vars['inv'];
$grupo = $vars['grupo'];
$bitacora = new Elgg_Bitacora7($vars['guid_bitacora']);
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
        <?php echo 'BITÁCORA N°7. REFLEXIÓN DE LA TRAYECTORIA DE INDAGACIÓN' ?>
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
    <h3 style="color: #000000; font-size: 12pt; alignment-adjust: central">1.	Barrido de los instrumentos y de las herramientas de investigación</h3>
    <br>
    <?php echo elgg_echo('bitacora7:actividades'); ?>
    <br>
    <table class="tabla-bitacoras">
        <tr>
            <th bgcolor="#FAA803" colspan="3">Fase 1.  Convocatoria y acompañamiento a la conformación del grupo, la formulación de las preguntas y el planteamiento del problema</th>
        </tr>
        <tr>
            <td>Barrido de los instrumentos de registro</td>
            <td>Barrido de las herramientas de investigación</td>
            <td>Anotaciones sobre los hallazgos y los aspectos que el grupo considere importantes resaltar</td>
        </tr>
        <tr>
            <td><textarea name="t11"><?php echo $bitacora->t11?></textarea></td>
            <td><textarea name="t12"><?php echo $bitacora->t12?></textarea></td>
            <td><textarea name="t13"><?php echo $bitacora->t13?></textarea></td>
        </tr>
    </table>    
    <br>
    <table class="tabla-bitacoras">
        <tr>
            <th bgcolor="#CE9AD0" colspan="3">Fase 2.  Diseño y recorrido de las trayectorias de indagación</th>
        </tr>
        <tr>
            <td>Barrido de los instrumentos de registro</td>
            <td>Barrido de las herramientas de investigación</td>
            <td>Anotaciones sobre los hallazgos y los aspectos que el grupo considere importantes resaltar</td>
        </tr>
        <tr>
            <td><textarea name="t21"><?php echo $bitacora->t21?></textarea></td>
            <td><textarea name="t22"><?php echo $bitacora->t22?></textarea></td>
            <td><textarea name="t23"><?php echo $bitacora->t23?></textarea></td>
        </tr>               
    </table>
    <br>
    <table class="tabla-bitacoras">
        <tr>
            <th bgcolor="#8E8EFB" colspan="3">Fase 3. Reflexión, propagación de las Ondas y construcción de la Comunidad Enjambre.</th>
        </tr>
        <tr>
            <td>Barrido de los instrumentos de registro</td>
            <td>Barrido de las herramientas de investigación</td>
            <td>Anotaciones sobre los hallazgos y los aspectos que el grupo considere importantes resaltar</td>
        </tr>
        <tr>
            <td><textarea name="t31"><?php echo $bitacora->t31?></textarea></td>
            <td><textarea name="t32"><?php echo $bitacora->t32?></textarea></td>
            <td><textarea name="t33"><?php echo $bitacora->t33?></textarea></td>
        </tr>               
    </table>
    <br>
    <p><b>3.Ejecución de los recursos asignados por el Proyecto Enjambre a nuestro grupo de investigación.</b></p><br>
    <p>Recuerden por favor que cada uno de los gastos que se realicen, por muy pequeños que sean debieron 
        quedar soportados con un recibo, factura y comprobante de caja menor. Dichos recibos deben contener 
        la siguiente información:</p>
    <p><?php echo "     "?>a)La fecha de la compra.</p>
    <p><?php echo "     "?>b)Los datos del almacén o de la persona que nos prestó 
        el servicio o nos vendió el producto:</p>
    <p><?php echo "         "?>• Nombre o razón social (cuando es un negocio).</p>
    <p><?php echo "         "?>• Su NIT o cédula de ciudadanía.</p>
    <p><?php echo "         "?>• Su dirección.</p>
    <p><?php echo "         "?>• Su número de teléfono.</p>
    <p><?php echo "         "?>• Su firma.</p>
    <p><?php echo "         "?>• Descripción del gasto y su valor de compra.</p><br>
    <p><b>Nota:</b>Con base en el presupuesto elaborado por el grupo y los gastos 
        realizados elaborar la bitácora 5.2.  Anexar los soportes originales de 
        los gastos efectuados.</p><br>
    <p><b>REGISTRO DE SISTEMATIZACIÓN para el maestro (a) acompañante/coinvestigador: </b>
        Complementar la bitácora 7 del semillero de investigación de usted acompaña: 
    <table class="tabla-bitacoras">
        <tr>
            <td>• Enuncie los tres aspectos que más le asombraron y le sirven para 
                incorporar en su práctica de maestro en esta etapa de la reflexión 
                de la trayectoria de indagación. 
            </td>
        </tr>
        <tr>
            <td>
                <textarea name="aspectos"><?php echo $bitacora->aspectos?></textarea>
            </td>
        </tr>
        <tr>
            <td>• ¿Cuáles serían las principales capacidades que desarrollan 
                los niños, las niñas y los jóvenes en esta etapa del Proyecto Enjambre?
            </td>
        </tr>
        <tr>
            <td><textarea name="capacidades"><?php echo $bitacora->capacidades?></textarea></td>
        </tr>
        <tr>
            <td>• Como maestro o maestra Enjambre, señale los principales cambios que deben 
                realizarse en la cultura escolar para que la investigación se convierta en una estrategia pedagógica.</td>
        </tr>
        <tr>
            <td><textarea name="cambios"><?php echo $bitacora->cambios?></textarea></td>
        </tr>
        <tr>
            <td>• ¿Cuáles serían las características de la indagación (tres últimas etapas)
                que practican los maestros en el Proyecto Enjambre?</td>
        </tr>
        <tr>
            <td><textarea name="caracteristicas"><?php echo $bitacora->caracteristicas?></textarea></td>
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