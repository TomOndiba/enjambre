<?php
elgg_load_js('tinymce');
elgg_load_js("reveal2");
elgg_load_css('reveal');

$id_bitacora = $vars['id_bitacora'];
$bitacora = new BitacoraDos($id_bitacora);
$grupo = $bitacora->getGrupoInvestigacion();
$institucion = $bitacora->getInstitucion($grupo);
$data = array('bitacora' => $bitacora);
$preguntas = elgg_view('bitacoras/util/preguntas_show', $data);
$preguntas_resultado = elgg_view('bitacoras/util/preguntas_resultado_show', $data);
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
            <td colspan="20" class="celda-titulo">A) Haga una síntesis del desarrollo del taller de la pregunta realizada con los
                integrantes del semillero de investigación, estrategias utilizadas y reflexiones
                significativas a partir de este encuentro:</td>
        </tr>
        <tr>
            <td colspan="20">
                <?php echo $bitacora->sintesis ?>
            </td>
        </tr>
        <tr>
            <td colspan="20" class="celda-titulo">B) Escriban cinco de las preguntas que formularon inicialmente los integrantes
                del grupo de investigación</td>
        </tr>
        <?php echo $preguntas ?>
        <tr>
            <td colspan="20" class="celda-titulo">
                C) Indique cuáles fueron los resultados de la busqueda / consulta de cada pregunta:
            </td> 
        </tr>
    </table>
    <?php echo $preguntas_resultado; ?>
    <table class='tabla-bitacoras'>
        <tr>
            <td class="celda-titulo">
                <p>D) Escriban la pregunta seleccionada para el desarrollo de su investigación</p>
            </td> 
        </tr>
        <tr>
            <td><?php echo $bitacora->pregunta; ?></td>
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
            <td colspan="20" align="center" class="celda-titulo"><b>Breve reflexión sobre el desarrollo de la bitácora #2
                    por parte del maestro / coinvestigador</b></td>
        </tr>
        <tr>
            <td colspan="20" class="celda-titulo"> B) Cómo se desarrolló la discusión al interior del semillero de
                investigación para solucionar la o las preguntas de investigación y enuncien los argumentos
                que expusieron para ello</td>
        </tr>
        <tr>
            <td colspan="20">
                <?php echo $bitacora->discusion ?>
            </td>
        </tr>
        <tr>
            <td colspan="20" class="celda-titulo"> Desde su rol como maestro acompañante: cual es su reflexión sobre el proceso 
                que ha desarrollado con los estudiantes?</td>
        </tr>
        <tr>
            <td colspan="20">
                <?php echo $bitacora->reflexion ?>
            </td>
        </tr>
    </table>
</div>

<script>
    $(document).ready(function () {
        document.body.innerHTML = document.body.innerHTML
                .replace(/&lt;/g, '<')
                .replace(/&gt;/g, '>');
    })
</script>
