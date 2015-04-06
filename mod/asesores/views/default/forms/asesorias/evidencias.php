<?php
/**
 * Form que permite gestionar evidencias de una asesoria off-line
 * @author DIEGOX_CORTEX
 */
$asesoria = $vars['ases'];
$inv = $vars['inv'];

$file_input1 = elgg_view('input/file', array('name' => 'archivo2', 'id' => "files", 'required' => 'true'));
$button = elgg_view('input/submit', array('id' => 'Agregar', 'value' => elgg_echo('Aceptar')));

$hidden_input = "<input type='hidden' name='inv' value='{$inv}'/> ";
$hidden_input2 = "<input type='hidden' name='ases' value='{$asesoria}'/> ";
?>

<div class="form-nuevo-album">
    <label  style="color:black;">Selecciona el archivo que desea adicionar.</label><br>
    <label style=" margin-top: 10px;" class="lbl-button">
            <?php echo $file_input1; ?><br><br>      
    </label><br>
    <output id="list"></output>      
        <?php echo $hidden_input; ?>
        <?php echo $hidden_input2; ?>
        <?php echo $button ?>
</div>
