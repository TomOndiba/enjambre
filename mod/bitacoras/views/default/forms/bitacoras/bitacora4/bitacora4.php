<?php
/**
 * Formulario que muestra los datos para llenar en la bitácora4
 * @author DIEGOX_CORTEX
 */
elgg_load_js("vista_modal");
elgg_load_js("reveal2");
elgg_load_css('reveal');

$investigacion = $vars['id_inv'];
$group = $vars['id_group'];
$bit = $vars['bit'];
$actividades = $vars['actividades'];
$informacion = $vars['info'];
$owner_inv = $vars['owner_inv'];
$user = elgg_get_logged_in_user_guid();
$grupo = get_entity($group);
$inv = get_entity($investigacion);
$bitacora = new Elgg_Bitacora4($bit);
$institucion = $bitacora->getInstitucion($grupo);
?>
<style>
    p{
        font-weight: normal !important;
    }
    
    textarea{
        width: 100%;
    }
</style>


<input type="hidden" name='id_inv' value="<?php echo $investigacion; ?>">
<input type="hidden" name='id_group' value="<?php echo $group; ?>">
<input type="hidden" name='bit' value="<?php echo $bit; ?>">
<div class="box div-editar-bitacoras">
    <h2 class='title-legend'>
        <?php echo 'BITÁCORA N°4. TRAYECTORIAS DE LA INDAGACIÓN' ?>
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
            <td><b>Dirección :   </b><?php echo $direccion; ?></td>
        </tr>
        <tr>
            <td><b>Email de la Institución :   </b><?php echo $email; ?></td>
            <td><b>Tipo de Institución :   </b><?php echo $tipo; ?></td>
        </tr>
        <tr>
            <td><b>Nombre del Grupo de Investigacion: </b></td>
            <td><?php echo $grupo->name; ?></td>
        </tr>         
    </table><br>
    Antes de iniciar se recomienda realizar lo siguiente: <br>
    <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Definir un cronograma de actividades.</p>
    <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Designar las funciones a cada integrante.</p>
    <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Obtener una libreta de aputes.</p>
    <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Seleccionar el estudiante tesorero para el manejo de los rubros.</p>
    <br><div style="width:70%; display: inline-block">
        <p><b>¿Qué significa TRAYECTORIA DE LA INDIGACIÓN?: </b>Actividades que se proponen a realizar de una forma organizada y sistemáticamente para resolver la pregunta y el problema 
            planteado por el semillero de investigación.</p><br>
        <p>Utilizando la metáfora del río, definir la trayectoria de indagación, 
            es señalar el recorrido durante la búsqueda de respuestas a la pregunta de investigación, 
            los recursos necesarios para llevarla a cabo y los instrumentos de registro que permitirán 
            consolidar la información</p><br>
        <p>A continuación se enmarcan paso a paso las trayectorias a seguir en el proceso de investigación, 
            estas pueden varias dependiendo de la línea temática del proyecto</p>
    </div>
    <div style="width:28%; display: inline-block">

    </div>
    <br><br><table class="tabla-bitacoras">
        <tr>
            <td>
                1. Búsqueda de información <br>
                2. Herramientas necesarias para la recolección de la información
            </td>
            <td>
                <b>Primer Trayecto</b>
            </td>
        </tr>
        <tr>
            <td>
                3. Salida de campo                
            </td>
            <td>
                <b>Segundo Trayecto</b>
            </td>
        </tr>
        <tr>
            <td>
                4. Organización de la información recogida
            </td>
            <td>
                <b>Tercer Trayecto</b>
            </td>
        </tr>
        <tr>
            <td>
                5. Agregar Actividades no previstas
            </td>
            <td>
                <b>Segundo Trayecto</b>
            </td>
        </tr>
        <tr>
            <td>
                6. Reflexión de la trayectoria de indagación (informe final)
                7. Discutir con la comunidad los hallazgos de la investigación
                8. Propagación de los resultados
            </td>
            <td></td>
        </tr>
    </table><br><br>
    <p>Se recomienda a cada semillero de investigación diseñar su propia trayectoria 
        y emplear para ello la representación gráfica que mejor se adecúe, la cual 
        debe incluir la pregunta como punto de partida y la meta como punto de llegada: 
        ¿hasta dónde nos proponemos llegar con nuestro proyecto de investigación?</p>
    <table class="tabla-bitacoras">
        <tr>
            <td><b>Representación Gráfica de la Trayectoria de indagación</b></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td><p>Una vez hayan establecido acuerdos sobre la trayectoria de la indagación, 
                    organicen el camino a recorrer a través de un cronograma de actividades 
                    que les permitirá medir los tiempos y establecer los recursos necesarios 
                    para el desarrollo de las actividades: </p>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if ($user == $owner_inv) {
                    echo "<br> <a onclick='cargarCrearActividad($bit, $investigacion, $group)' id='boton-agregar-actividad-bit4' class='elgg-button button-publicar'>Agregar Actividad</a><br><br>";
                }
                ?>

                <div id="form-crear-actividad-bit4">
                </div>
                <div id="tabla-actividades-bit4">
                    <?php
                    // IMPRIMO EL FORMULARIO DE ADMINISTRAR CONOGRAMA
                    $vars = array('id_inv' => $investigacion, 'owner_inv' => $owner_inv, 'id_group' => $group, 'bit' => $bit, 'actividades' => $actividades);
                    $content = elgg_view_form('bitacoras/bitacora4/admin_cronograma', array(), $vars);
                    echo $content;
                    ?>
                </div>
            </td>
        </tr>
    </table>
    <br>
    <p><b>REGISTRO DE SISTEMATIZACIÓN para el maestro (a) acompañante/coinvestigador:</b> 
        Complementar la bitácora 4 del semillero de investigación de usted acompaña: </p><br>
    <table class="tabla-bitacoras">
        <tr>
            <td> • Describir las dificultades que se presentaron en el grupo para diseñar la trayectoria de indagación:</td>
        </tr>
        <tr>
            <td>
                <textarea name="dificultades"><?php echo $bitacora->dificultades?></textarea> 
            </td>
        </tr>
        <tr>
            <td> • Describir la fortalezas del grupo de investigación para tomar 
                decisiones sobre el diseño de las trayectorias y para argumentarlas:</td>
        </tr>
        <tr>
            <td>
                <textarea name="fortalezas" ><?php echo $bitacora->fortalezas?></textarea> 
            </td>
        </tr>
        <tr>
            <td> • A la luz de las etapas de investigación trabajadas hasta ahora, enuncie lo que para usted serían las principales 
                características de un proceso de formación en el cual la investigación es la estrategia pedagógica:</td>
        </tr>
        <tr>
            <td>
                <textarea name="caracteristicas_proceso" ><?php echo $bitacora->caracteristicas_proceso?></textarea> 
            </td>
        </tr>
        <tr>
            <td> • Argumente la importancia y viabilidad de colocar 
                a la investigación como estrategia pedagógica en la cultura escolar:</td>
        </tr>
        <tr>
            <td>
                <textarea name="importancia" ><?php echo $bitacora->importancia?></textarea> 
            </td>
        </tr>
        <tr>
            <td> • A partir de su acompañamiento a los grupos de investigación en el Proyecto Enjambre,
                enuncie las preguntas que le han surgido de este proceso y los aspectos que podrían dar elementos para la transformación de su práctica pedagógica:</td>
        </tr>
        <tr>
            <td>
                <textarea name="preguntas_aspectos" ><?php echo $bitacora->preguntas_aspectos?></textarea> 
            </td>
        </tr>
    </table>
    <?php
    if ($user == $owner_inv) {
        ?>
        <input type="submit" value="Guardar">
        <?php
    }
    ?>


