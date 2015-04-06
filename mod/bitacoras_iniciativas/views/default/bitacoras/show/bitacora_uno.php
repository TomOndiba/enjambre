<?php
elgg_load_js('tinymce');
elgg_load_js("reveal2");
elgg_load_css('reveal');

$id_bitacora = $vars['id_bitacora'];
$bitacora = new BitacoraUno($id_bitacora);
$grupo = $bitacora->getGrupoInvestigacion();
$institucion = $bitacora->getInstitucion($grupo);
$direccion = ($institucion->direccion != "") ? $institucion->direccion : " No registrada";
$email = ($institucion->email != "") ? $institucion->email : " No registrada";
$tipo = ($institucion->tipo_institucion != "") ? $institucion->tipo_institucion : " No registrada";

# Integrantes de la bitacora
$integrantes_investigacion = $bitacora->getIntegrantes();
$lista_integrantes_investigacion_estudiantes = elgg_view('bitacoras/util/table_integrantes_investigacion', array('integrantes' => $integrantes_investigacion['estudiantes']));
$lista_integrantes_investigacion_maestros = elgg_view('bitacoras/util/listar_integrantes_maestros', array('integrantes' => $integrantes_investigacion['maestros']));
$entity_grupo = new ElggGrupoInvestigacion($grupo->guid);
$url_icono = $entity_grupo->getIconURL('large');
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
    <br><br><br>
    <p><b>A. INTEGRANTES DEL GRUPO</b></p><br>
    <table class="tabla-bitacoras">
        <thead>
            <tr><th>Nombre</th><th>Edad</th><th>Grado</th><th>Sexo</th><th>Documento</th><th>Email</th></tr>
        </thead>
        <?php echo $lista_integrantes_investigacion_estudiantes; ?>
    </table>
    <br><br><p><b>A. MAESTROS ACOMPAÑANTES</b></p><br>

    <?php echo $lista_integrantes_investigacion_maestros; ?>


    <br /><br />
    <p><b>IDENTIDAD DEL SEMILLERO DE INVESTIGACIÓN: </b>Les sugerimos representar, mediante una foto,
        un dibujo o una caricatura a su semillero de investigacion</p><br>
    <div style="width: 100%; text-align: center; border: #000 solid 1px">
        <img src="<?php echo $url_icono ?>" style="width: 50%"/>
    </div>
    <br> 
    <br><p><b>REGISTRO DE SISTEMATIZACIÓN para el maestro acompañante / coinvestigador:</b> completar las reflexiones del grupo
        de investigación</p>.
    <table class="tabla-bitacoras">
        <tr><td>3. Bitácora #1</td><td>Fecha Inicio</td><td>Fecha Fin</td></tr>
        <tr>
            <td colspan="3">
                <p>1. Describa cómo se entero de la apertura de la Convocatoria del Proyecto Ennjambre en su
                    departamento. Haga un relato en el que:</p>
                <p>- Dé cuenta de el proceso que hubo en su institución para conformar el grupo de
                    investigación.</p>
                <p>- Realice una caracterización del grupo de Investigación desde sus motivaciones,
                    expectativas, sentimientos e intereses de los integrantes.</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?php echo $bitacora->campo1 ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p>2. Explique cuáles fueron los motivos que lo llevaron a participar en el proyecto
                    enjambre y exprese las sensaciones personales que le generaron el acompañamiento que realizó para
                    conformar su Grupo de Investigación.</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?php echo $bitacora->campo2 ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p>Texto de reflexión  sobre el grupo de investigación por parte del maestro / cooinvestigador:
                    Expectativas de formación, impacto de la IEP dentro de los procesos del aula, mejoramiento de los procesos
                    acádemicos, proyección comunitaria, etc.</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">               
                <?php echo $bitacora->campo3 ?>
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
