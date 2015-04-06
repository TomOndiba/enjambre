<?php
elgg_load_js('validate');

$user = $vars['entity'];

$password_actual = elgg_view('input/password', array('name' => 'passwordVieja', 'id' => "validate-password"));
$password_input = elgg_view('input/password', array('name' => 'password1', 'id' => 'password1'));
$passwordnueva_input = elgg_view('input/password', array('name' => 'password2',));
$button = elgg_view('input/submit', array('value' => elgg_echo('Guardar'),));
?>

<div class="form-nuevo-album" style="margin-top: 20px;">
    <h2 class='title-legend'>Cambiar Contraseña </h2>

    <div>
        <label>Contraseña Actual:</label> <?php echo $password_actual ?>
    </div> 
    <div>
        <label>Contraseña Nueva:</label> <?php echo $password_input ?><div id="msj-pass" style="margin-left: 30px;"></div>
    </div> 
    <div>
        <label>Repita la Contraseña:</label> <?php echo $passwordnueva_input ?>
    </div> 
    <div class="contenedor-button">
        <?php echo $button; ?>
    </div>  
</div>

<script>

    $(document).ready(function() {
        $("#password1").focusout(function() {
            var pass = $(this).val();
            elgg.get('ajax/view/usuario/validar_password', {
                timeout: 30000,
                data: {
                    pass: pass,
                },
                success: function(result, success, xhr) {
                    var data= JSON.parse(result);
                    if(data.val==0){
                        $("#msj-pass").html("");
                    }else{
                         $("#msj-pass").html("Su nueva contraseña es similar a la que tenia anteriormente, le recomendamos que ingrese una contraseña diferente.");
                    }
                },
            });
        });
        
        $(".elgg-form-usuario-cambiar-password").validate({/*sustituir "formulario" por el id de vuestro formulario*/
            rules: {
                passwordVieja: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                password1: {/*id del campo que se aplica la regla*/
                    required: true,
                    minlength: 6,
                },
                password2: {/*id del campo que se aplica la regla*/
                    equalTo: "#password1",
                    required: true,
                },
            },
            messages: {
                passwordVieja: {
                    required: "Campo Obligatorio",
                },
                password1: {/*id del campo que se aplica la regla*/
                    required: "Campo Obligatotio",
                    minlength: "Mínimo 6 caracteres",
                },
                password2: {/*id del campo que se aplica la regla*/
                    equalTo: "Las contraseñas no coinciden",
                    required: "Campo Obligatorio",
                },
            },
        });
    });


</script>

