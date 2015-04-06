<?php

/**
 * Formulario para crear un Patrocinador
 * @author DIEGOX_CORTEX
 */


//$instructions = elgg_echo('help:admin:instruct');


$nombre_input = elgg_view('input/text', array(
    'name' => 'nombre',
    'required' => 'true',
    'placeholder' => 'Nombre del Patrocinador'
        ));

$logo_input=elgg_view('input/file', array('name' => 'images'));


$cancel = elgg_get_site_url().'patrocinadores/listar';

$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Registrar')
 ));


?>

<div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2> Crear Patrocinadores</h2>
        </div>

    
<?php


echo <<<HTML


<div>
        <label>Nombre del Patrocinador: </label><br />$nombre_input<br/>
        <label>Logotipo: </label><br />$logo_input<br/>
</div>
<div class="contenedor-button">
        $button
        <a class='link-button' href='$cancel' class='elgg-button elgg-button-submit'>Cancelar</a>
</div>
HTML;
?>

</div>