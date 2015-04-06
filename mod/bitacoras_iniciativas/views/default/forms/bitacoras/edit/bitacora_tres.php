<?php
elgg_load_js('tinymce');
elgg_load_js("reveal2");
elgg_load_css('reveal');

$id_bitacora = $vars['id_bitacora'];
$bitacora = new BitacoraTres($id_bitacora);
$grupo = $bitacora->getGrupoInvestigacion();
$institucion = $bitacora->getInstitucion($grupo);
$data = array('bitacora' => $bitacora);
$preguntas = elgg_view('bitacoras/util/preguntas', $data);
$preguntas_resultado = elgg_view('bitacoras/util/preguntas_resultado', $data);
?>

<div class="box div-editar-bitacoras">
    <h2 class="title-legend"><?php echo $bitacora->title; ?></h2>

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
    </table>
    <br><br>
    <div style="width: 90%; text-align: center; font-style: italic; margin:0 auto">
        <p>Han pasado de las preguntas iniciales a las preguntas de investigación y a plantear
            el problema de investigación. Es hora de registrarlo en la comunidad virtual enjambre
            siguiendo los pasos que se indican en esta bitácora N° 3.</p>
    </div><br>
    <p>La descripción del problema investigación es muy importante, porque la selección de los
        proyectos por parte del Equipo Pedagódigo Departamental del Proyecto Enjambre depende en gran
        medida de la claridad con la cual el semillero registre en ella los siguientes aspectos:</p>
    <br>
    <table class="tabla-bitacoras">
        <tr>
            <td><b>A)Descripción del problema que se quiere investigar. </b>Recuperando lo 
            desarrollaro en este etapa de investigación, explique cúal es el problema que se han
            planteado asi como su importancia para los diferentes grupos humanos y ecológicos
            afectados. De iguaal manera, apartir de los recursos humanos, fisicos y económicos
            y del tiempo disponible argumenten hasta donde se pretende llegar con la investigación
            iniciada.</td>
        </tr>
        <tr>
            <td><textarea name='campo_uno'><?php echo $bitacora->campo1?></textarea></td>
        </tr>
        <tr>
            <td>B) Con base en los puntos anteriores, justifique la importancia de resolver el problema
            o avanzar en su solución</td>
        </tr>
        <tr>
            <td><textarea name='campo_dos'><?php echo $bitacora->campo2?></textarea></td>
        </tr>
    </table>
    <br><br>
    <p><b>REGISTRO DE SISTEMATIZACIÓN para el maestro acompañante / coinvestigador: </b> Completar
    la bitácora 3 del semillero de investigación que ud acompaña:</p>
    <table class="tabla-bitacoras"><br>
        <tr>
            <td>
                <p>En un escrito relate cuáles eementos le parecieron significativos del proceso de
                conformación de los grupos de investigación, formulación de la pregunta y planteamiento
                del problema, con relación con:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp; - Las semejanzas y diferencias entre nuestra manera adulta de hacer preguntas
                y la de los niños, niñas y jovenes.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp; - Los aspectos a resaltar que observó en el trabajo de las niñas, niños y
                jóvenes en su tránsito de formulación de las preguntas iniciales a las de investigación  y de ahí a
                la elaboración del planteamiento del problema</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp; - Las vivencias de los niños, niñas y jóvenes al asumirse como grupo de investigación.</p>
            </td>
        </tr>
        <tr>
            <td>
                <textarea name='campo_tres'><?php echo $bitacora->campo3?></textarea>
            </td>
        </tr>
    </table>
    <input type="hidden" name='id_bitacora' value='<?php echo $bitacora->guid; ?>'/>
    <input type='submit' value='guardar'/>
</div>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        language: "es_MX",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ]
    });

    function cambiarItemEspejo(element) {
        var id = $(element).data('id');
        var text = $(element).val();
        $(".pregunta-" + id).html(text);
    }
</script>