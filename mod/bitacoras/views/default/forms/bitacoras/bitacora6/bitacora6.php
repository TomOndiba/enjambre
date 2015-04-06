
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
$bitacora = new Elgg_Bitacora6($vars['guid_bitacora']);
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
        <?php echo 'BITÁCORA N°6. RECORRIDO DE LA TRAYECTORIA DE INDAGACIÓN' ?>
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
    <p><b>RECORRIDO DEL PRIMER SEGMENTO O TRAYECTO</b></p><br>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;<b>1. Retomar la trayectoria de indagación diseñada en la Bitácora 4: </b>
        revisando qué actividades, herramientas, tiempos, responsables y metas parciales que se propusieron 
        para el primer segmento o trayecto, así como las funciones de cada uno de los integrantes del grupo 
        para iniciar las actividades de este primer segmento.</p><br>
    <p>&nbsp;&nbsp;&nbsp;<b>2. Organizar un archivo y asignar un responsable del mismo.</b> Los registros diligenciados
        deben ser entregados al encargado del archivo, quien será el responsable por su organización y cuidado.</p><br>
    <p>&nbsp;&nbsp;&nbsp;<b>3. Recolección de información:</b> Consultar diferentes fuentes informativas para conocer 
        los resultados de otras investigaciones sobre el problema de investigación que van a trabajar.  
        En este primer segmento puede ayudarte mucho tu asesor, sugiriéndote algunas fuentes de información 
        para consultar y los criterios para seleccionar las mismas.  </p><br>
    <p>&nbsp;&nbsp;&nbsp;<b>4. Elaboración del estado del arte.</b>  Con la información recolectada elaborar el 
        estado del arte; este nos permite conocer los resultados de otras investigaciones sobre el tema bajo 
        investigación. Además se puede optar por hablar con investigadores y conocer experiencias de otros 
        grupos de investigación. Es importante mantener un registro de las fuentes consultadas 
        y los resultados obtenidos a partir de dichas consultas, como registros audiovisuales,
        mapas conceptuales, cuestionarios y/o entrevistas, así como los comentarios relevantes 
        del grupo, los cuales pueden compartir con los grupos de la misma línea de investigación a través de 
        un espacio virtual. </p><br>
    <p>&nbsp;&nbsp;&nbsp;<b>5. Identificar las técnicas e instrumentos necesarios para el desarrollo de la investigación.</b>
        Con base en el estado del arte, se identifican las técnicas como la entrevista, encuesta, experimentos,
        mediciones y/o otros a emplear en la investigación. Como instrumentos se tienen en cuenta los materiales e 
        insumos para realizar las pruebas de laboratorio. </p><br>
    <p>&nbsp;&nbsp;&nbsp;Se realiza un mapa conceptual de las técnicas e instrumentos a emplear (este mapa es propio de 
        cada semillero de investigación)</p><br>
    <p><b>Recuerde: </b>Realizar los registros de cada actividad durante cada segmento o trayecto y en el tiempo
        más breve posible después de su finalización.  </p><br>
    <table class="tabla-bitacoras">
        <tr>
            <td>• Comparta sus evidencias fotográficas y comentarios sobre el recorrido de esta primera trayectoria</td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table><br><br>
    <p><b>REGISTRO DE SISTEMATIZACIÓN para el maestro (a) acompañante/coinvestigador:</b>
        Complementar la bitácora 6 del semillero de investigación de usted acompaña: </p><br>
    <table class="tabla-bitacoras">
        <tr>
            <td>• Describir las dificultades que se presentaron en el grupo para diseñar la trayectoria de indagación.</td>
        </tr>
        <tr>
            <td>
                <textarea name="dificultades"><?php echo $bitacora->dificultades ?></textarea>
            </td>
        </tr>
        <tr>
            <td>• Describir las fortalezas del grupo de investigación para tomar decisiones 
                sobre el diseño de las trayectorias y para argumentarlas.</td>
        </tr>
        <tr>
            <td>
                <textarea name="fortalezas"><?php echo $bitacora->fortalezas ?></textarea>
            </td>
        </tr>
        <tr>
            <td>• Después de hacer la trayectoria de indagación, cuáles serían las características 
                del espíritu científico que se fomenta desde el Proyecto Enjambre.</td>
        </tr>
        <tr>
            <td>
                <textarea name="caracteristicas"><?php echo $bitacora->caracteristicas ?></textarea>
            </td>
        </tr>
        <tr>
            <td>• Cuáles son las acciones del recorrido del a trayectoria de indagación que 
                fomenta cada una de estas capacidades: sociales, cognitivas, comunicativas y científicas y cómo
                se manifiestan en los miembros del grupo.</td>
        </tr>
        <tr>
            <td>
                <textarea name='acciones'><?php echo $bitacora->acciones ?></textarea>
            </td>
        </tr>
        <tr>
            <td>• A la luz de las etapas de investigación trabajadas hasta ahora, enuncie lo que 
                para usted serían las principales características de un proceso de formación en el cual 
                la investigación es la estrategia pedagógica.</td>
        </tr>
        <tr>
            <td>
                <textarea name='caracteristicas_2'><?php echo $bitacora->caracteristicas_2 ?></textarea>
            </td>
        </tr>
        <tr>
            <td>• Mencione los Logros y Dificultades en el proceso investigativo de este segmento o trayecto</td>
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

