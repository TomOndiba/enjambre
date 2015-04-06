<?php
elgg_load_js('tinymce');
elgg_load_js("reveal2");
elgg_load_css('reveal');

$id_bitacora = $vars['id_bitacora'];
$bitacora = new BitacoraDos($id_bitacora);
$grupo = $bitacora->getGrupoInvestigacion();
$institucion = $bitacora->getInstitucion($grupo);
$data = array('bitacora' => $bitacora);
$preguntas = elgg_view('bitacoras/util/preguntas', $data);
$preguntas_resultado = elgg_view('bitacoras/util/preguntas_resultado', $data);
?>

<div class="box div-editar-bitacoras">
    <h2 class="title-legend"><?php echo $bitacora->title; ?></h2>
    <div style="width: 100%; text-align: right; font-style: italic">
        <p>"Toda pregunta es un clamor por entender el mundo"</p>
        <p>Carl Sagan</p>
    </div>
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
    <p>
    <b>La pregunta como punto de partida. </b>Como resultado del Taller de la Pregunta
    del grupo de investigación realizado el  (Fecha) se presenta el proceso de selección
    de la pregunta que orientará el desarrollo del proyecto de investigación.
</p><br>
<table class="tabla-bitacoras">
    <colgroup>
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
    </colgroup>
    <tr>
        <td colspan="20">A) Haga una síntesis del desarrollo del taller de la pregunta realizada con los
            integrantes del semillero de investigación, estrategias utilizadas y reflexiones
            significativas a partir de este encuentro:</td>
    </tr>
    <tr>
        <td colspan="20">
            <textarea class="text-item-bitacora format-text" name="sintesis"><?php echo $bitacora->sintesis ?></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="20">B) Escriban cinco de las preguntas que formularon inicialmente los integrantes
            del grupo de investigación</td>
    </tr>
    <?php echo $preguntas ?>
    <tr>
        <td colspan="20">
            C) Indique cuáles fueron los resultados de la busqueda / consulta de cada pregunta:
        </td> 
    </tr>
</table>
    <?php echo $preguntas_resultado;?>
<table class='tabla-bitacoras'>
    <tr>
        <td>
            <p>D) Escriban la pregunta seleccionada para el desarrollo de su investigación</p>
        </td> 
    </tr>
    <tr>
        <td><textarea name='pregunta' style="width: 100%; height: 100px;"><?php echo $bitacora->pregunta;?></textarea></td>
    </tr>
</table>
<br><br>
<p><b>REGISTRO DE SISTEMATIZACIÓN Para el maestro(a) acompañante /coinvestigador: </b>
    Complmentar la bitácora 2 del semillero de investigación que ud acompaña</p><br>
<table class="tabla-bitacoras">
    <colgroup>
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
        <col width="5%"><col width="5%">
    </colgroup>
    <tr>
        <td colspan="20" align="center"><b>Breve reflexión sobre el desarrollo de la bitácora #2
            por parte del maestro / coinvestigador</b></td>
    </tr>
    <tr>
        <td colspan="20"> B) Cómo se desarrolló la discusión al interior del semillero de
        investigación para solucionar la o las preguntas de investigación y enuncien los argumentos
        que expusieron para ello</td>
    </tr>
    <tr>
        <td colspan="20">
            <textarea class="text-bitacora format-text" name="discusion"><?php echo $bitacora->discusion?></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="20"> Desde su rol como maestro acompañante: cual es su reflexión sobre el proceso 
        que ha desarrollado con los estudiantes?</td>
    </tr>
    <tr>
        <td colspan="20">
            <textarea class="text-bitacora format-text" name="reflexion"><?php echo $bitacora->reflexion?></textarea>
        </td>
    </tr>
</table>
<input type="hidden" name='id_bitacora' value='<?php echo $bitacora->guid; ?>'/>
<input type='submit' value='guardar'/>
</div>
<script type="text/javascript">
    tinymce.init({
        selector: ".format-text",
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
    
    tinymce.init({
        selector: ".format-text-simple",
        theme: "modern",
        menubar : false,
        language: "es_MX",
        toolbar1: "bold italic | alignleft aligncenter alignright alignjustify| link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ]
    });
    
    function cambiarItemEspejo(element){
        var id = $(element).data('id');
        var text= $(element).val();
        $(".pregunta-"+id).html(text);
    }
</script>