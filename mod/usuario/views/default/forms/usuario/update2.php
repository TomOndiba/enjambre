
<div class="form-nuevo-album">
    <h2 class='title-legend'>Editar Datos de Usuario </h2>

    <?php
    /**
     * Formulario de actualización de datos de un usuario
     */
    elgg_load_css('logged');
    elgg_load_js("mun-dpto");
    elgg_load_js("departamento_municipios");
    elgg_load_js('validarCampos');
    elgg_load_js('validate');
    elgg_load_js('datepick');

//Datos Personales
    $id = elgg_view('input/hidden', array('name' => 'id', 'value' => $vars['id'])); //Recibe y envia el id del grupo que se edita

    $nombre_input = elgg_view('input/text', array('name' => 'nombres', 'value' => $vars['nombres']));
    $apellido_input = elgg_view('input/text', array('name' => 'apellidos', 'value' => $vars['apellidos']));
    $sexo_input = elgg_view('input/dropdown', array('name' => 'sexo', 'options' => array('Femenino' => 'Femenino', 'Masculino' => 'Masculino'), 'value' => $vars['sexo']));
    $tipo_documento_input = elgg_view('input/dropdown', array('name' => 'tipo_documento', 'id' => 'tipoDocumento', 'class' => 'select', 'value'=>$vars['tipo_d'],'options_values' => array('RC:REGISTRO CIVIL DE NACIMIENTO' => 'RC:Registro Civil', 'CC:CÉDULA DE CIUDADANÍA' => 'CC:Cédula de Ciudadanía', 'NES:NÚMERO ESTABLECIDO POR LA SECRETARÍA' => 'NES:Número establecido por la Secretaría', 'NIP:NÚMERO DE IDENTIFICACIÓN PERSONAL' => 'NIP:Número de Identificación Personal', 'NUIP:NÚMERO UNICO DE IDENTIFICACIÓN PERSONAL' => 'NUIP:Número Unico de Identificación Personal', 'TI:TARJETA DE IDENTIDAD' => 'Tarjeta de Identidad',),));
    $numero_documento_input = elgg_view('input/text', array('id' => 'input1', 'name' => 'numero_documento', 'class' => 'input_text', 'value' => $vars['numero'],));
    $pais_nacimiento_input = elgg_view('input/dropdown', array('name' => 'pais_nacimiento', 'class' => 'select', 'options' => array('Colombia' => 'Colombia'), 'value' => '', 'disabled' => 'disabled'));

    $params = array('departamento_n' => $vars['departamento_n'], 'municipio_n' => $vars['municipio_n']);

    $params2 = array('departamento_ins' => $vars['departamento_inst'], 'municipio_ins' => $vars['municipio_inst'], 'institucion' => $vars['guid_inst']);

    $dpto_mun_nacimiento = elgg_view("municipio_dep_nac", $params);
    $dpto_mun_institucion = elgg_view("municipios_departamento", $params2);

    $fecha_nacimiento_input = elgg_view('input/date', array('name' => 'fecha_nacimiento', 'class' => 'input_text', 'value' => $vars['fecha_n']));
    $grupo_etnico = elgg_view('input/dropdown', array('name' => 'grupo_etnico', 'class' => 'select', 'options_values' => array('' => 'Seleccione', 'Indígenas' => 'Indígenas', 'Afrocolombianos' => 'Afrocolombianos', 'ROM' => 'ROM', 'Raizales' => 'Raizales', 'Ninguno' => 'Ninguno'), 'value' => $vars['grupo_etnico']));
    $barrio_input = elgg_view('input/text', array('name' => 'barrio', 'value' => $vars['barrio']));
    $direccion_input = elgg_view('input/text', array('name' => 'direccion', 'value' => $vars['direccion']));
    $telefono_input = elgg_view('input/text', array('id' => 'asistentes', 'name' => 'telefono', 'class' => 'input_text', 'value' => $vars['telefono']));
    $celular_input = elgg_view('input/text', array('id' => 'input2', 'name' => 'celular', 'class' => 'input_text', 'value' => $vars['celular']));



// Datos del Estudiante
    $option_curso = array('Grado 0' => 'Grado 0', 'Primero' => 'Primero', 'Segundo' => 'Segundo','Tercero' => 'Tercero', 'Cuarto' => 'Cuarto', 'Quinto' => 'Quinto', 'Sexto' => 'Sexto', 'Septimo' => 'Septimo', 'Octavo' => 'Octavo', 'Noveno' => 'Noveno', 'Décimo' => 'Décimo', 'Undécimo' => 'Undécimo');
    $curso_input = elgg_view('input/dropdown', array('name' => 'curso', 'class' => 'select', 'options' => $option_curso, 'value' => $vars['curso']));

    $option_vive = array('Mamá' => 'Mamá', 'Papá' => 'Papá', 'Los dos' => 'Los dos', 'Familiar' => 'Familiar', 'Otro' => 'Otro');

    $vive_input = elgg_view('input/dropdown', array('name' => 'vive', 'class' => 'select', 'options' => $option_vive, 'value' => $vars['vive']));
    $zona_input = elgg_view('input/dropdown', array('name' => 'zona', 'class' => 'select', 'options' => array('Rural' => 'Rural', 'Urbana' => 'Urbana'), 'value' => $vars['zona']));
//$tiempo_libre_input = elgg_view('input/longtext', array('name' => 'tiempo_libre', 'value'=>$vars['tiempo_libre']));


    $tiempo_libre_input = "<textarea name='tiempo_libre' style='height:100px;' >" . $vars['tiempo_libre'] . "</textarea>";
// Datos del Maestro
    $titulo_input = elgg_view('input/text', array('name' => 'titulo', 'value' => $vars['titulo']));
    $especialidad_input = elgg_view('input/text', array('name' => 'especialidad', 'value' => $vars['especialidad']));
    $universidad_input = elgg_view('input/text', array('name' => 'universidad', 'class' => 'input_text', 'value' => $vars['universidad']));
    $anio_grado_input = elgg_view('input/text', array('id' => 'input3', 'name' => 'anio_grado', 'value' => $vars['anio']));
    $area_desempenio = elgg_view('input/text', array('name' => 'area_desempenio', 'value' => $vars['area']));



    $guid = elgg_extract('guid', $vars, null);
    $file_guid = elgg_view('input/hidden', array('name' => 'file_guid', 'value' => $guid));

    $institucion_input = elgg_view('input/dropdown', array('name' => 'institucion', 'class' => 'select', 'options_values' => array($vars['guid_inst'] => $vars['nombre_inst'])));
    $tipo_usuario = $vars['tipo_usuario'];

    $avatar = elgg_echo("avatar:upload");
    $avatar_icon = elgg_view("input/file", array('name' => 'avatar', 'onchange' => 'nombre(this.value)'));

    $email="";
    if($vars['email']==""){
     $email_input = elgg_view('input/text', array('id' => 'email', 'name' => 'email', 'class' => 'input_text'));  
     $email="<div><label>Email </label>$email_input </div>";
    }
    
    
    
    
    
    $datos_personales = " 
    
<br>

<div>
$id
</div>

<div>
	<label>$avatar</label><br />
        <label class='lbl-button'>    
            <span>Seleccione una imagen</span>
	       $avatar_icon
         </label>
</div><br><br>

    <div>
    <label>NOMBRES:</label>
    $nombre_input
    </div>
         
    <div>
    <label>Apellidos: </label>
    $apellido_input
    </div>       


    
    <div >
    <label>Tipo de Documento:</label>
    $tipo_documento_input
    </div>
        
  <div class='div-datos2'>
    <label>Número de Documento: </label>
    $numero_documento_input
    </div>
    
   <div class='div-datos2'>
    <label>Sexo: </label>
    $sexo_input
    </div>


    <div>
    <label>País de Nacimiento:</label>
    $pais_nacimiento_input
    </div>
    $dpto_mun_nacimiento

        <div >
        <label>Fecha de Nacimiento: </label>
        $fecha_nacimiento_input
        </div>

        <div >
        <label>Grupo Etnico al que pertenece: </label>
        $grupo_etnico
        </div>

        <div >
        <label>Telefono:</label>
        $telefono_input
        </div>

        <div>
        <label>Celular:</label>
        $celular_input
        </div>
    


    <div >
    <label>Dirección: </label>
    $direccion_input
    </div>

    <div >
    <label>Lugar de Residencia (Barrio o Vereda):</label>
    $barrio_input
    </div>"
    ;



    $datos_est = "

    <div >
    <label>Curso: </label>
    $curso_input
    </div>
 
    <div >
    <label>Con quien Vive: </label>
    $vive_input
    </div>
    
    <div >
    <label>Zona: </label>
    $zona_input 
    </div>


    <div>
    <label>Qué hace en el Tiempo Libre: </label>
    $tiempo_libre_input
    </div>";



    $datos_maestro = "

    <div >
    <label>Universidad: </label>
    $universidad_input
    </div> 

    <div >
    <label> Año de Graduación: </label>
    $anio_grado_input
    </div>




    <div >
    <label>Titulo: </label>
    $titulo_input
    </div>

    <div >
    <label>Especialidad: </label>
    $especialidad_input
    </div> 

        
<div>  
<label> Área del conocimiento en el cual se desempeña: </label>
$area_desempenio
</div>";


    $institucion = "<div><label> Seleccione el departamento y municipio donde se encuentra la institucion a la que pertenece:</label></div> $dpto_mun_institucion 

       <div id=\"instituciones\">
      
       
       </div> $email ";


    $imp_boton = "<div class=\"elgg-foot\">
<hr>$button
</div>"
    ;

    if ($tipo_usuario == 'estudiante')
        echo $datos_personales . $datos_est . $institucion;

    elseif ($tipo_usuario == 'maestro')
        echo $datos_personales . $datos_maestro . $institucion;
    else
        echo $datos_personales . $datos_maestro . $institucion;


    elgg_clear_sticky_form('profile:edit');
    ?>
    <div class="elgg-foot">
        <?php
        echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['entity']->guid));
        echo elgg_view('input/submit', array('value' => elgg_echo('save')));
        ?>
    </div>
</div>

<script>

    function nombre(fic) {
        fic = fic.split('\\');
        var nombre = fic[fic.length - 1];
        if (nombre == "") {
            nombre = "Seleccione aquí la imagen";
        }
        $(".lbl-button span").html(nombre);

    }


    $(document).ready(function() {
        $(".elgg-form-usuario-update").validate({/*sustituir "formulario" por el id de vuestro formulario*/
            rules: {
                nombres: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                apellidos: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                sexo: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                tipo_documento: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                numero_documento: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                fecha_nacimiento: {/*id del campo que se aplica la regla*/
                    required: true,
                    date: true,
                },
                grupo_etnico: {/*id del campo que se aplica la regla*/
                    required: true,
                   
                },
                institucion: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                email:{
                    required:true,
                    email:true,
                }
            },
            messages: {
                nombres: {
                    required: "Este campo es obligatorio",
                },
                apellidos: {
                    required: "Este campo es obligatorio",
                },
                sexo: {
                    required: "Es necesario seleccionar una opción",
                },
                tipo_documento: {/*id del campo que se aplica la regla*/
                    required: "Es necesario seleccionar una opción",
                },
                numero_documento: {/*id del campo que se aplica la regla*/
                    required: "Este campo es obligatorio",
                },
                fecha_nacimiento: {/*id del campo que se aplica la regla*/
                    required: "Este campo es obligatorio",
                },
                grupo_etnico: {/*id del campo que se aplica la regla*/
                    required: "Este campo es obligatorio",
                   
                },
                email: {/*id del campo que se aplica la regla*/
                    required: "Este campo es obligatorio",
                    email: "Por favor, digite una direccioón de correo válida"
                },
                institucion: {/*id del campo que se aplica la regla*/
                    required: "Este campo es obligatorio"
                },
            }
        });
    });
</script>


</script>