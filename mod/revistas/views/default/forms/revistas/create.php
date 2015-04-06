<?php
$nombre_input = elgg_view('input/text', array('name' => 'nombre',));
$url_flash = elgg_view('input/text', array('name' => 'url_flash'));
$url_web = elgg_view('input/text', array('name' => 'url_web'));
$file_input = elgg_view('input/file', array('name' => 'images', 'id' => "files", 'required' => 'true'));
$button = elgg_view('input/submit', array('id' => 'aceptar', 'value' => elgg_echo('Aceptar')));
?>
<div class="form-nuevo-album" style="margin-top: 30px; width: 92%; margin-left: 2%;margin-right: 2%;">
    <h2 class="title-legend">Crea Revista</h2>
    <div>
        <label>Nombre(*):</label>
        <?php echo $nombre_input; ?>
    </div>
    <div>
        <label>Url Web:</label>
        <?php echo $url_web; ?>
    </div>
    <div>
        <label>Url Flash:</label>
        <?php echo $url_flash; ?>
    </div>
    <div>
        <label>Imagen para mostrar</label>
        <label class="lbl-button">
            <span>Seleccione la imagen</span><?php echo $file_input; ?>
        </label>
    </div>
    <output id="list"></output>
    <?php echo $hidden_input; ?>
    <div class="contenedor-button"><?php echo $button; ?></div>
</div>

