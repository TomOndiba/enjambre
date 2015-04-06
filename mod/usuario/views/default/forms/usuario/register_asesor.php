<?php
/**
 * Formulario de registro de usuario
 */
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
$apellido_input = elgg_view('input/text', array('name' => 'apellidos',));
$sexo_input = elgg_view('input/dropdown', array('name' => 'sexo', 'class' => 'select', 'options_values' => array('' => 'Seleccione', 'Femenino' => 'Femenino', 'Masculino' => 'Masculino'),));
$tipo_documento_input = elgg_view('input/dropdown', array('name' => 'tipo_documento', 'id' => 'tipoDocumento', 'class' => 'select', 'options_values' => array('RC:REGISTRO CIVIL DE NACIMIENTO' => 'RC:Registro Civil', 'CC:CÉDULA DE CIUDADANÍA' => 'CC:Cédula de Ciudadanía', 'NES:NÚMERO ESTABLECIDO POR LA SECRETARÍA' => 'NES:Número establecido por la Secretaría', 'NIP:NÚMERO DE IDENTIFICACIÓN PERSONAL' => 'NIP:Número de Identificación Personal', 'NUIP:NÚMERO UNICO DE IDENTIFICACIÓN PERSONAL' => 'NUIP:Número Unico de Identificación Personal', 'TI:TARJETA DE IDENTIDAD' => 'Tarjeta de Identidad',),));
$numero_documento_input = elgg_view('input/text', array('id' => 'asistentes', 'name' => 'numero_documento',));
$dpto_municipio = elgg_view("municipios_departamento");
$fecha_nacimiento_input = elgg_view('input/date', array('name' => 'fecha_nacimiento',));

$institucion_input = elgg_view('input/dropdown', array('name' => 'institucion', 'class' => 'select', 'options_values' => array($vars['guid_inst'] => $vars['nombre_inst'])));
$tipo_usuario_input = elgg_view('input/dropdown', array('name' => 'tipo_usuario', 'class' => 'select', 'options_values' => array(''=>'Seleccione', 'Estudiante' => 'Estudiante', 'Maestro' => 'Maestro'),));
$grupo_etnico = elgg_view('input/dropdown', array('name' => 'grupo_etnico', 'class' => 'select', 'options_values' => array('' => 'Seleccione', 'Indígenas' => 'Indígenas', 'Afrocolombianos' => 'Afrocolombianos', 'ROM' => 'ROM', 'Raizales' => 'Raizales', 'Ninguno' => 'Ninguno')));


//Datos de Usuario
$email_input = elgg_view('input/email', array('name' => 'email', 'id' => 'input-correo'));
$nombre_usuario_input = elgg_view('input/text', array('name' => 'nombre_usuario',));
$password_input = elgg_view('input/password', array('name' => 'password', 'id' => 'password'));
$password2_input = elgg_view('input/password', array('name' => 'password2',));
$button = elgg_view('input/submit', array('value' => elgg_echo('Registrarme'), 'id' => 'button-registro'));
$convocatoria = "<input type='hidden' name='convocatoria' value='{$vars['convocatoria']}'/>";

echo <<<HTML

<div class="registro">
    <div>$event $id_c
<label>Nombres: </label>
$nombre_input
</div>
         
<div>
<label>Apellidos: </label>
$apellido_input
</div>       
  
<div class="div-datos2">
<label>Sexo: </label><br>
$sexo_input
</div>
        
<div class="div-datos2">
<label>Tipo de Documento: </label>
$tipo_documento_input
</div>
        
<div class="div-datos2">
<label>Número de Documento: </label>
$numero_documento_input
</div>
 
<div >
<label>Fecha de Nacimiento: </label>
$fecha_nacimiento_input
</div>
 
<div>
  
               
<div>
<label>Email: </label>
$email_input
</div>
        
<div>
<label>Nombre de Usuario (Mínimo 4 caracteres): </label>
$nombre_usuario_input
</div>
 
<div class="div-datos-con">
<label >Contraseña (Mínimo 6 caracteres): </label>
$password_input
</div>
 
<div class="div-datos-con"> 
<label>Repita la Contraseña</label>
$password2_input
</div>
   </div>
       $convocatoria
<div class="boton-registro" style=''>
$button
</div>
<div style="display:none;" id="dialog-confirm" title="Confirmación de Correo">
    <p>Esta seguro que desea registrar con el correo:</p>
        <p style='text-align:center;font-weight:700'>
            <b><span id='correo'></span></b>
         </p>
        <p>
            Este correo será usado para la validación de su cuenta,
            una vez confirmado revisar su bandeja de entrada o bandeja 
            de correos no deseado (Spam), para efectuar el proceso de activación.
        
        </p>
</div>
HTML;
?>
<script>
    var enviar = false;
    $(document).ready(function() {
        $(".elgg-form-usuario-register").validate({/*sustituir "formulario" por el id de vuestro formulario*/
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
                email: {/*id del campo que se aplica la regla*/
                    required: true,
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
                    required: "Este campo es obligatorio",
                },
                email: {/*id del campo que se aplica la regla*/
                    required: "Este campo es obligatorio",
                    email: "Por favor, digite una direccioón de correo válida",
                },
                nombre_usuario: {/*id del campo que se aplica la regla*/
                    required: "Este campo es obligatorio",
                    minlength: "Mínimo 4 caracteres",
                },
                password: {/*id del campo que se aplica la regla*/
                    required: "Este campo es obligatorio",
                    minlength: "Mínimo 6 caracteres",
                },
                password2: {/*id del campo que se aplica la regla*/
                    equalTo: "Las contraseñas no coinciden",
                    required: "Este campo es obligatorio",
                    minlength: "Mínimo 6 caracteres",
                },
            },
            errorPlacement: function(error, element) {
                $('#button-registro').removeAttr('disabled');
                error.insertAfter(element);
            },
            submitHandler: function(form) {
                $("#correo").html($("#input-correo").val());
                confirmate(form)
            }
        });
    });
    function enviarForm() {
        ;
    }
    function confirmate(form) {
        $("#dialog-confirm").dialog({
            resizable: false,
            height: 300,
            width: 500,
            modal: true,
            buttons: {
                Si: function() {
                   form.submit();
                },
                No: function() {
                    $(this).dialog("close");
                }
            }
        });
    }


</script>

