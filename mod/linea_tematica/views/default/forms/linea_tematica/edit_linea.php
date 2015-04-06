<?php

/**
 * Formulario para editar la información de una Línea temática
 * @author DIEGOX_CORTEX
 */

elgg_load_js('acciones_linea');
$id = $vars['ide'];
$descripcion = $vars['descripcion'];
$nombre = $vars['nombre'];
$href_editar = $vars['edit'];
$tipo = $vars['tipo'];

$nombre_input = elgg_view('input/text', array(
    'name' => 'nombre',
    'required' => 'true',
    'value' => $nombre
        ));
$descripcion_input = elgg_view('input/longtext', array('name' => 'descripcion', 'value' => $descripcion));
$tipo_input = elgg_view('input/radio', array('options' => array('Proyectos abiertos' => 'Proyectos abiertos', 'Proyectos Preestructurados' => 'Proyectos Preestructurados'), 'name' => 'tipo','value' => $tipo));
$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Modificar')
 ));

$ide = elgg_view('input/hidden', array('name' => 'id', 'value' => $id));

?>
<div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2> Editar Linea Temática</h2>
        </div>

    
<?php

echo <<<HTML
<div style='display:none;' id="dialog-confirm" title="Confirmación">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Está seguro que desea editar la linea tematica?</p>
</div>

<div>
        <label>Nombre de la línea: </label><br />$nombre_input<br>
        <label>Tipo: </label><br />$tipo_input <br>
        <label>Descripción: </label><br />$descripcion_input<br>
        
</div>
<div class="elgg-foot">
        $button
        $ide
</div>
HTML;
?>

</div>