<?php

/**
 * Formulario para editar la información de una Línea temática
 * @author DIEGOX_CORTEX
 */

elgg_load_js('acciones_area');
$id = $vars['ide'];
$nombre = $vars['nombre'];
$href_editar = $vars['edit'];

$nombre_input = elgg_view('input/text', array(
    'name' => 'nombre',
    'required' => 'true',
    'value' => $nombre
        ));
$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Editar')
 ));

$ide = elgg_view('input/hidden', array('name' => 'id', 'value' => $id));


?>
<div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2> Editar Subcategoría de Innovación</h2>
        </div>

    
<?php
$url=  elgg_get_site_url()."subcategorias/listar";

echo <<<HTML
<div style='display:none;' id="dialog-confirm" title="Confirmación">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Está seguro que desea editar la linea tematica?</p>
</div>

<div>
        <label>Nombre de la línea: </label><br />$nombre_input<br>
        
</div>
<div class="contenedor-button">
        $button
        $ide
        <a class='link-button' href='$url' class='elgg-button elgg-button-submit'>Cancelar</a>
</div>
HTML;
?>
</div>