<?php

/**
 * Formulario para crear una área de feria
 * @author DIEGOX_CORTEX
 */


$nombre_input = elgg_view('input/text', array(
    'name' => 'nombre',
    'required' => 'true',
    'placeholder' => 'Nombre del área de feria',
        ));

$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Registrar')
 ));

?>
<div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2> Crear Área de Feria</h2>
        </div>

    
<?php
$url=  elgg_get_site_url()."area/listar";

echo <<<HTML


<div>
        <label>Nombre del Área: </label><br />$nombre_input<br/>
</div>
<div class="elgg-foot">
        $button
        <a href='$url' class='elgg-button elgg-button-submit'>Cancelar</a>
</div>
HTML;
?>
</div>