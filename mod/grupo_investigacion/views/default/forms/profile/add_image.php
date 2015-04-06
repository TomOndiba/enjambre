<?php
   elgg_load_js('validate');
$entity = $vars['entity'];
$file_input = elgg_view('input/file', array('name' => 'images', 'id'=>'images', 'onchange'=>'nombre(this.value)'));
$foot = elgg_view('input/hidden', array('name' => 'guid', 'value' => $entity->guid));
$button = elgg_view('input/submit', array(
    'value' => elgg_echo("Publicar"),
    'align' => 'right',
        ));
?>
<div><br>
    <label class="lbl-button">
        <span>Seleccione aquí la imagen</span><?php echo $file_input; ?>
    </label><br><br>
<?php echo $foot ?>
    <div class='contenedor-button'><?php echo $button ?></div>
</div>
<script>

    function nombre(fic) {
        fic = fic.split('\\');
        var nombre=fic[fic.length - 1];
        if(nombre==""){
            nombre="Seleccione aquí la imagen";
        }
        $(".lbl-button span").html(nombre);
        
          
    }
    
   

        $(document).ready(function() {
            $(".elgg-form-profile-add-image").validate({/*sustituir "formulario" por el id de vuestro formulario*/
                rules: {
                    images: {/*id del campo que se aplica la regla*/
                        required: true,
                        extension: "png,jpeg,gif",
                        accept: "image/*"
                      
                       
                    },

                },
                messages: {
                     images: {
                        required: "Debe seleccionar una Imagen",
                        accept:"Solo se puede subir imagenes",
                       
                    },
                   
                }
            });
        });
  

</script>