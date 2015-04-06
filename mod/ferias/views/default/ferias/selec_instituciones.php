<?php

/**
 * 
 */
$departamento = get_input('departamento');
$municipio = get_input('municipio');


$intituciones = elgg_buscar_instituciones_Municipio($municipio, $departamento);
$option_institucion = array();
foreach ($intituciones as $institucion) {
    error_log("GUID INSt -> {$institucion['id']} && NAME -> {$institucion['nombre']}");
    $option_institucion[$institucion['id']] = $institucion['nombre'];
}
$institucion_input = elgg_view('input/dropdown', array('name' => 'institucion', 'class' => 'select', 'required' => 'true', 'id' => 'inst', 'options_values' => $option_institucion, 'value' => $value));
echo "<label>Institución: </label>" . $institucion_input .'<br><br>';
