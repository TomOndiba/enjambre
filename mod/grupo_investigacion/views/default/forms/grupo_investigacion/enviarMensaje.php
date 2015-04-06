<?php
/**
 * Formulario para redactar el mensaje que se envia a los miembros del grupo de inv
 */
elgg_load_js("validate");
$guid = $vars['guid'];
?>
<br><br>
<div class='form-nuevo-album'><h2 class='title-legend'>Enviar Mensajes</h2>
   
        <div class="mensajes">
            <label>Asunto:</label>
            <?php echo elgg_view('input/text', array('name' => 'asunto',)); ?>
        </div>
        <div class="mensajes">
            <label> Nuevo Mensaje:</label>
            <textarea name='mensaje' style='height:100px;' ></textarea>
        </div>
        <?php
        echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
        ?>
        <div class="contenedor-button">
        <?php echo elgg_view('input/submit', array('value' =>'Enviar')); ?>

        </div>
   
</div>

<script>

        $(document).ready(function() {
            $(".elgg-form-grupo-investigacion-enviarMensaje").validate({/*sustituir "formulario" por el id de vuestro formulario*/
                rules: {
                    asunto: {/*id del campo que se aplica la regla*/
                        required: true,
                       
                    },
                    mensaje: {/*id del campo que se aplica la regla*/
                        required: true,
                    },
                    
                },
                messages: {
                    asunto: {
                        required: "Es necesario especificar el asunto",
                       
                    },
                   mensaje: {/*id del campo que se aplica la regla*/
                        required: 'Es necesario escribir un mensaje',
                    },
                }
            });
        });
    </script>