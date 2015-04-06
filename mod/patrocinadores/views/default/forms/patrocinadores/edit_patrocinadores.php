<?php

/**
 * Formulario para editar la información de un Patrocinador
 * @author DIEGOX_CORTEX
 */
elgg_load_js('acciones_patrocinandores');
$id = $vars['ide'];
$nombre = $vars['nombre'];
$href_editar = $vars['edit'];
$logo = $vars['logo'];

$nombre_input = elgg_view('input/text', array(
    'name' => 'nombre',
    'required' => 'true',
    'value' => $nombre
        ));


$logo_input = elgg_view('input/file', array('name' => 'images', 'required' => 'true'));

$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Editar')
        ));

$site_url = elgg_get_site_url();
$url = $site_url . "photos/thumbnail/{$logo}/small/";

$ide = elgg_view('input/hidden', array('name' => 'id', 'value' => $id));

?>
<div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2> Editar Patrocinador de Feria</h2>
        </div>

    
<?php
$url_cancelar=  elgg_get_site_url()."patrocinadores/listar";

echo <<<HTML
<div style='display:none;' id="dialog-confirm" title="Confirmación">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Está seguro que desea editar la informaicon del patrocinador?</p>
</div>


        <h3>Datos Actuales:</h3> <br>
        <label>Imagen Actual:</label><br>
        <img width='50' src='$url'><br>
        <label>Nombre del Patrocinador: </label><br />$nombre<br>

<br><br>
        <h3>Actualizar Datos:</h3><br>
        <label>Nombre del Patrocinador: </label><br />$nombre_input<br>
        <label>Logo: </label><br />$logo_input <br>

<div class="contenedor-button">
        $button
        $ide
        <a class='link-button' href='$url_cancelar' class='link-button'>Cancelar</a>
</div>
HTML;
?>