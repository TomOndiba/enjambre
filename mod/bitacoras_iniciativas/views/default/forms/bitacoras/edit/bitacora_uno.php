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

# Integrandes del grupo de investigacion
$integrantes = $bitacora->getIntegrantesGrupo($grupo, array_merge($integrantes_investigacion['estudiantes'], $integrantes_investigacion['maestros']));
$lista_integrantes = elgg_view('bitacoras/util/lista_integrantes_grupo', 
        array('integrantes' => $integrantes['estudiantes'],
    'investigacion' => $bitacora->owner_guid));
$lista_integrantes_maestros = elgg_view('bitacoras/util/lista_integrantes_grupo', 
        array('integrantes' => $integrantes['maestros'],
    'investigacion' => $bitacora->owner_guid));
$entity_grupo= new ElggGrupoInvestigacion($grupo->guid);
$url_icono=$entity_grupo->getIconURL('large');
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
    <a href="#" data-reveal-id="addIntegrantes">Agregar Integrantes</a>
    <br><br><p><b>A. MAESTROS ACOMPAÑANTES</b></p><br>
    
<?php echo $lista_integrantes_investigacion_maestros; ?>
    
    <a href="#" data-reveal-id="addMaestros">Agregar Maestros Acompañantes</a>
    
    <br /><br />
    <p><b>IDENTIDAD DEL SEMILLERO DE INVESTIGACIÓN: </b>Les sugerimos representar, mediante una foto,
        un dibujo o una caricatura a su semillero de investigacion</p><br>
    <div style="width: 100%; text-align: center; border: #000 solid 1px">
        <img src="<?php echo $url_icono?>" style="width: 50%"/>
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
                <textarea class="text-item-bitacora" name="campo_uno"> <?php echo $bitacora->campo1 ?> </textarea>
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
                <textarea class="text-item-bitacora" name="campo_dos"><?php echo $bitacora->campo2 ?></textarea>                
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
                <textarea class="text-item-bitacora" name="campo_tres"><?php echo $bitacora->campo3 ?></textarea>
            </td>
        </tr>
    </table>    
    <input type="hidden" name='id_bitacora' value='<?php echo $bitacora->guid; ?>'/>
    <input type='submit' value='guardar'/>
</div>
<div id="addIntegrantes" class="reveal-modal">
    <div class="close-reveal-modal cierre-eventos"></div>
    <div class="pop-up-calendar pop-up">
        <h2 class="title-legend">Agregar Integrantes</h2>
        <p> Seleccione el estudiante perteneciente al grupo que quieras agregar a tu investigación.</p>
        <br />
<?php echo $lista_integrantes; ?>
    </div>
</div>
<div id="addMaestros" class="reveal-modal">
    <div class="close-reveal-modal cierre-eventos"></div>
    <div class="pop-up-calendar pop-up">
        <h2 class="title-legend">Agregar Mestros</h2>
        <p> Seleccione el profesor perteneciente al grupo que quieras agregar a tu investigación.</p>
        <br />
<?php echo $lista_integrantes_maestros; ?>
    </div>
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
</script>