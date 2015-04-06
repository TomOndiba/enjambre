<?php

/**
 * Formulario para crear un nivel de feria
 * @author DIEGOX_CORTEX
 */


$nombre_input = elgg_view('input/text', array(
    'name' => 'nombre',
    'required' => 'true',
    'placeholder' => 'Nombre del nivel de feria',
        ));

$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Registrar')
 ));
?>

<div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2> Crear Nivel de Feria</h2>
        </div>

    
<?php
$url=  elgg_get_site_url()."nivel/listar";

echo <<<HTML


<div>
        <label>Nombre del Nivel de Feria: </label><br />$nombre_input<br/>
</div>
<div class="contenedor-button">
        $button
        <a class='link-button' href='$url' class='elgg-button elgg-button-submit'>Cancelar</a>
</div>
HTML;
?>
</div>