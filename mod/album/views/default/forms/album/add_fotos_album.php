<?php
$album = $vars['guid'];
$file_input = elgg_view('input/file', array('name' => 'imagenes[]', 'id' => "files", 'required' => 'true', 'multiple' => 'true'));
$button = elgg_view('input/submit', array('id' => 'Agregar', 'value' => elgg_echo('Aceptar')));

$hidden_input = "<input type='hidden' name='album' value='{$album}'/> ";
$titulo = elgg_view_title(elgg_echo('crear:album'));
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
<div class="form-nuevo-album">
    <div>
        <h2 class="title-legend">Agrega imagenes al albúm</h2><br><br>
        <label  style="color:black;">Selecciona las fotos que quiere agregar al albúm.</label><br>
        <label style=" margin-top: 10px;" class="lbl-button">
            <span>Selecciona aquí las fotos</span><?php echo $file_input; ?><br><br>      
        </label><br>
        <output id="list"></output>      
            <?php echo $hidden_input; ?>
            <?php echo $button ?>
    </div>
</div>
<script>function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object

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
</script> 