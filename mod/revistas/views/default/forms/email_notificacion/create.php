<?php
$asunto = elgg_view('input/text', array('name' => 'asunto',));
$mensaje = elgg_view('input/longtext', array('name' => 'mensaje'));
$button = elgg_view('input/submit', array('id' => 'Enviar', 'value' => "Enviar"));
?>
<div class="form-nuevo-album" style="margin-top: 30px; width: 92%; margin-left: 2%;margin-right: 2%;">
    <h2 class="title-legend">Redacte su Mensaje</h2>
    <div>
        <label>Asunto(*):</label>
        <?php echo $asunto; ?>
    </div>
    <div>
        <label>Mensaje:</label>
        <?php echo $mensaje; ?>
    </div>
    <?php echo $button;?>
</div>

