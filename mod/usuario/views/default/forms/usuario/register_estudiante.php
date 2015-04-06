<style>
    #sexo-error{
        margin-top: -20px !important;
    }
    .div-datos2{
        width: 30% !important;
    }
</style>
<div id="dialog-message" title="Advertencia" >

</div>
<?php
elgg_load_js('validarCampos');
elgg_load_js("mun-dpto");
elgg_load_js('validate');
elgg_load_js('datepick');


$evento = $vars['evento'];
$id_conv = $vars['id_conv'];
$event = elgg_view('input/hidden', array('name' => 'event', 'value' => $evento));
$id_c = elgg_view('input/hidden', array('name' => 'id_conv', 'value' => $id_conv));


if (elgg_is_sticky_form('register')) {
    extract(elgg_get_sticky_values('register'));
    elgg_clear_sticky_form('register');
}

//Datos Personales
$nombre_input = elgg_view('input/text', array('name' => 'nombres', 'id' => 'nombre',));
$apellido_input = elgg_view('input/text', array('name' => 'apellidos', 'id' => 'apellidos'));
$sexo_input = elgg_view('input/dropdown', array('name' => 'sexo', 'class' => 'select', 'id' => 'sexo', 'options_values' => array('' => 'Seleccione', 'Femenino' => 'Femenino', 'Masculino' => 'Masculino'),));
$tipo_documento_input = elgg_view('input/dropdown', array('name' => 'tipo_documento', 'id' => 'tipoDocumento', 'class' => 'select', 'options_values' => array(
        'RC:REGISTRO CIVIL DE NACIMIENTO' => 'RC:Registro Civil', 'CC:CÉDULA DE CIUDADANÍA' => 'CC:Cédula de Ciudadanía', 'NES:NÚMERO ESTABLECIDO POR LA SECRETARÍA' => 'NES:Número establecido por la Secretaría',
        'NIP:NÚMERO DE IDENTIFICACIÓN PERSONAL' => 'NIP:Número de Identificación Personal', 'NUIP:NÚMERO UNICO DE IDENTIFICACIÓN PERSONAL' => 'NUIP:Número Unico de Identificación Personal', 'TI:TARJETA DE IDENTIDAD' => 'Tarjeta de Identidad',),));

$numero_documento_input = elgg_view('input/text', array('id' => 'asistentes', 'class' => 'documento', 'name' => 'numero_documento',));


$option_curso = array('Grado 0' => 'Grado 0', 'Primero' => 'Primero', 'Segundo' => 'Segundo', 'Tercero' => 'Tercero', 'Cuarto' => 'Cuarto', 'Quinto' => 'Quinto', 'Sexto' => 'Sexto', 'Septimo' => 'Septimo', 'Octavo' => 'Octavo', 'Noveno' => 'Noveno', 'Décimo' => 'Décimo', 'Undécimo' => 'Undécimo');
$curso_input = elgg_view('input/dropdown', array('name' => 'curso', 'id' => 'curso', 'class' => 'select', 'options' => $option_curso, 'value' => $vars['curso']));

$dpto_municipio = elgg_view("municipios_departamento");
$fecha_nacimiento_input = elgg_view('input/date', array('name' => 'fecha_nacimiento',));

$grupo_etnico = elgg_view('input/dropdown', array('name' => 'grupo_etnico', 'class' => 'select', 'options_values' => array('Ninguno' => 'Ninguno', 'Indígenas' => 'Indígenas', 'Afrocolombianos' => 'Afrocolombianos', 'ROM' => 'ROM', 'Raizales' => 'Raizales')));
$institucion_input = elgg_view('input/dropdown', array('name' => 'institucion', 'id' => 'institucion', 'class' => 'select', 'options_values' => array($vars['guid_inst'] => $vars['nombre_inst'])));
//$tipo_usuario_input = elgg_view('input/dropdown', array('name' => 'tipo_usuario', 'class' => 'select', 'options_values' => array('Estudiante' => 'Estudiante', 'Maestro' => 'Maestro'),));
//Datos de Usuario
$email_input = elgg_view('input/email', array('name' => 'email',));
$nombre_usuario_input = elgg_view('input/text', array('name' => 'nombre_usuario', 'id' => 'username'));
$password_input = elgg_view('input/password', array('name' => 'password', 'id' => 'password'));
$password2_input = elgg_view('input/password', array('name' => 'password2', 'id' => 'password2'));

$button_buscar = elgg_view('input/submit', array('value' => elgg_echo('Buscar'), 'id' => 'button-buscar'));
$button = elgg_view('input/submit', array('value' => elgg_echo('Registrar'), 'id' => 'button-registro'));
?>

<div class="content-coordinacion">
    <div class="titulo-coordinacion">
        <h2>Administración</h2>
    </div>
    <div class="menu-coordinacion">
        <?php echo elgg_view("convocatorias/menu_admin", array()); ?>
    </div>

<div class="contenido-coordinacion">
    <div class="titulo-coordinacion">
            <h2>Registrar Estudiante</h2>
        </div>
    
    <div class="registro">
        <div class="div-datos2">
            <label>Tipo de Documento: </label>
            <?php echo $tipo_documento_input; ?>
        </div>

        <div class="div-datos2">
            <label>Número de Documento: </label>
            <?php echo $numero_documento_input ?>
        </div>


        <div onclick="mostrarDatosRegistro(this)" class="div-button row link-button" style="width: 120px;text-align:center; margin-top: 21.5px !important;
             margin-left: 50px;">Buscar</div> 



        <div style="display: none;" class="registro" id="registroUsuario">


            <div><?php echo $event . $id_c ?>
                <label>Nombres: </label>
                <?php echo $nombre_input ?>
            </div>

            <div>
                <label>Apellidos: </label>
                <?php echo $apellido_input ?>
            </div>       

            <div class="div-datos2">
                <label>Sexo: </label><br>
                <?php echo $sexo_input ?>
            </div>

            <div class="div-datos2">
                <label>Grado: </label><br>
                <?php echo $curso_input ?>
            </div>
            <div class="div-datos2">
                <label>Grupo Etnico al que pertenece: </label><br>
                <?php echo $grupo_etnico ?>
            </div>
            <div>
                <label>Fecha de Nacimiento: </label>
                <?php echo $fecha_nacimiento_input ?>
            </div>


            <h4> Seleccione el departamento y municipio donde se encuentra la institucion a la que pertenece:</h4><br>
            <?php echo $dpto_municipio ?>

            <div class="div-datos2" id="instituciones">
                <?php echo $institucion_input ?>
            </div>


            <div>
                <label>Email: </label>
                <?php echo $email_input ?>
            </div>

            <div>
                <label>Nombre de Usuario (Mínimo 4 caracteres): </label>
                <?php echo $nombre_usuario_input ?>
            </div>

            <div class="div-datos-con">
                <label >Contraseña (Mínimo 6 caracteres): </label>
                <?php echo $password_input ?>
            </div>

            <div class="div-datos-con"> 
                <label>Repita la Contraseña</label>
                <?php echo $password2_input ?>
            </div>

            <div class="boton-registro" style=''>
                <?php echo $button ?>
            </div>
            <div style="display: none;" class="registro" id="loader">

            </div>
        </div>     
    </div>
</div>
</div>


<script>
    var enviar = true;
    $(document).ready(function() {
        $(".elgg-form-usuario-register-estudiante").validate({/*sustituir "formulario" por el id de vuestro formulario*/
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
                    date: true,
                },
                email: {/*id del campo que se aplica la regla*/
                    email: true
                },
                nombre_usuario: {/*id del campo que se aplica la regla*/
                    required: true,
                    minlength: 4
                },
                password: {/*id del campo que se aplica la regla*/
                    required: true,
                    minlength: 6
                },
                password2: {/*id del campo que se aplica la regla*/
                    equalTo: "#password",
                    required: true,
                    minlength: 6
                },
                institucion: {/*id del campo que se aplica la regla*/
                    required: true,
                },
            },
            messages: {
                nombres: {
                    required: "Es necesario su nombre para registrarse",
                },
                apellidos: {
                    required: "Es necesario su apellido para registrarse",
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
                    date: "El formato de la fecha no es válido",
                },
                email: {/*id del campo que se aplica la regla*/
                    email: "Por favor, digite una direccioón de correo válida"
                },
                nombre_usuario: {/*id del campo que se aplica la regla*/
                    required: "Este campo es obligatorio",
                    minlength: "Mínimo 4 caracteres"
                },
                password: {/*id del campo que se aplica la regla*/
                    required: "Este campo es obligatorio",
                    minlength: "Mínimo 6 caracteres"
                },
                password2: {/*id del campo que se aplica la regla*/
                    equalTo: "Las contraseñas no coinciden",
                    required: "Este campo es obligatorio",
                    minlength: "Mínimo 6 caracteres"
                },
                institucion: {/*id del campo que se aplica la regla*/
                    required: "Este campo es obligatorio"
                },
            },
            errorPlacement: function(error, element) {
                $('#button-registro').removeAttr('disabled');
                error.insertAfter(element);
            },
            submitHandler: function() {
                $('#button-registro').attr('disabled', 'disabled');
                $("#registroUsuario").hide();
                $("#loader").show();
                $("#loader").html(imprimirLoader());
                $(".elgg-form-usuario-register-estudiante").submit();
            }

        });

        $('#asistentes').live("keypress", function(e) {
            if (e.keyCode == 13 && !e.shiftKey) {
                mostrarDatosRegistro();
                return false;
            }
        });
        $(".elgg-form-usuario-register-estudiante").live("keypress", function(e) {
            if (e.keyCode == 13 && !e.shiftKey) {
                return false;
            }
        });

    });

    function mostrarDatosRegistro(element) {
        var numeroDocumento = $("#asistentes").val();
        var tipoDocumento = $("#tipoDocumento").val();
        var form = $("#registroUsuario");
        var contenido = form.html();
        form.html(imprimirLoader());
        form.show();
        elgg.get('ajax/view/usuario/busqueda_documento', {
            timeout: 30000,
            data: {
                numero_documento: numeroDocumento,
                tipo_documento: tipoDocumento,
            },
            success: function(result, success, xhr) {
                var datosFinal = JSON.parse(result);
                if (datosFinal.user==false) {
                    lanzarMensaje(numeroDocumento, tipoDocumento, datosFinal.mensaje);
                    form.hide();
                    form.html(contenido);
                } else {
                    form.html(contenido);
                    var datos = datosFinal.user;
                    $("#nombre").val(datos.nombre);
                    $("#apellidos").val(datos.apellidos);
                    $("#tipoDocumento").val(datos.tipoDocumento);
                    $("#sexo").val(datos.sexo);
                    $("#curso").val(datos.grado);
                    $("#username").val(datos.username);
                    $("#password").val(datos.password);
                    $("#password2").val(datos.password);
                    var municipio = datos.municipio;
                    var departamento = datos.departamento;
                    var institucion = datos.institucion;
                    var mun = datos.mun;
                    inicializarDptoMuncipio(departamento, municipio, mun, institucion);
                }
            },
        });
    }

    function inicializarDptoMuncipio(dpto, municipio, mun, institucion) {
        cargarMunicipios(getMunicipios(dpto), municipio);
        $("#municipios").val(municipio);
        $("#departamentos").val(dpto);
        elgg.get('ajax/view/usuario/listar_instituciones', {
            timeout: 30000,
            data: {
                municipio: municipio,
                departamento: dpto,
                institucion: institucion,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#instituciones').html(result);
            },
        });
    }
    function lanzarMensaje(documento, tipo, msj) {
        $("#dialog-message").dialog({
            modal: true,
            width: 500,
            buttons: {
                Aceptar: function() {
                    $(this).dialog("close");
                }
            }
        });
        $("#dialog-message").html(msj);
    }


</script>

