<?php
$entity = $vars['guid'];
$nombre_input = elgg_view('input/text', array('name' => 'nombre', ));
$descripcion = elgg_view('input/longtext', array('name' => 'descripcion'));
$file_input = elgg_view('input/file', array('name' => 'imagenes[]', 'id' => "files", 'required' => 'true', 'multiple' => 'true'));
$button = elgg_view('input/submit', array('id' => 'aceptar', 'value' => elgg_echo('Aceptar')));

$hidden_input = "<input type='hidden' name='guid' value='{$entity}'/> ";
?>
<style>
    .thumb{ 
        display: inline-block;
        margin:5px;
        background-color: ghostwhite;
    }

    .thumb>img{
        height: 105px;
        border:none;
    }
</style>
<div class="form-nuevo-album" style="margin-top: 30px; width: 92%; margin-left: 2%;margin-right: 2%;">
    <h2 class="title-legend">Crear Álbum</h2>
    <div>
        <label>Nombre(*):</label>
        <?php echo $nombre_input; ?>
    </div>
    <div>
        <label>Descripcion:</label>
        <?php echo $descripcion; ?>
    </div>
    <div>
        <label>Seleccione las imagenes</label>
        <label class="lbl-button">
            <span>Seleccione las fotos</span><?php echo $file_input; ?>
        </label>
    </div>
    <output id="list"></output>
    <?php echo $hidden_input; ?>
    <div class="contenedor-button"><?php echo $button; ?></div>
</div>

<script>
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object
          $("#list").html("");
        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                  
                    var span = document.createElement('span');
                    span.innerHTML = ['<div class="thumb"><img class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '"/></div>'].join('');
                    document.getElementById('list').insertBefore(span, null);
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }

    document.getElementById('files').addEventListener('change', handleFileSelect, false);
    
    $(document).ready(function() {
        $(".elgg-form-album-crear-album").validate({/*sustituir "formulario" por el id de vuestro formulario*/
            rules: {
                nombre: {/*id del campo que se aplica la regla*/
                    required: true,
                    minlength: 3 /*caracteres mínimos*/
                },     
                files: {/*id del campo que se aplica la regla*/
                    required: true,
                },     
               
            },
            messages: {
                nombre: {
                    required: "Es necesario el nombre para crearlo",
                    minlength: "Minimo 3 caracteres!"
                },
                files: {/*id del campo que se aplica la regla*/
                    required: 'Debe seleccionar alguna imagen',
                },     
            }
        });
    });
</script>       