<?php

/**
 * Formulario para crear una área de feria
 * @author DIEGOX_CORTEX
 */


$nombre_input = elgg_view('input/text', array(
    'name' => 'nombre',
    'required' => 'true',
    'placeholder' => 'Nombre de la subcategoría de innovación',
        ));

$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Registrar')
 ));


?>
<div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2> Crear Subcategoría de Innovación</h2>
        </div>

    
<?php
$url=  elgg_get_site_url()."subcategorias/listar";

echo <<<HTML


<div>
        <label>Nombre de la subcategoría de innovación: </label><br />$nombre_input<br/>
</div>
<div class="contenedor-button">
        $button
        <a class='link-button' href='$url' class='elgg-button elgg-button-submit'>Cancelar</a>
</div>
HTML;
?>

</div>