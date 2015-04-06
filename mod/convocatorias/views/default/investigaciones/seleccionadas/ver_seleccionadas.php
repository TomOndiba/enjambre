<?php

$ajax = get_input("ajax");
$relacion = get_input('relacion');
$guid_convocatoria = get_input('convocatoria');
$id_linea = get_input('linea');
$convocatoria = new ElggConvocatoria($guid_convocatoria);
$lineasAsociadas = elgg_get_relationship($convocatoria, "tiene_la_línea_temática");
$lineas_asociadas = Array();

if (!$ajax) {
    foreach ($lineasAsociadas as $linea) {
        $lin = array('id_linea' => $linea->guid, 'nombre_linea' => $linea->name);
        array_push($lineas_asociadas, $lin);
    }
    $listado_lineas = $lineas_asociadas;

    $option = array();

    foreach ($listado_lineas as $listado) {
        $option[$listado['id_linea']] = $listado['nombre_linea'];
    }

    $lineas_input = elgg_view('input/dropdown', array('name' => 'linea', 'id' => 'linea', 'class' => 'select', 'required' => 'true', 'options_values' => $option));
    $relacion_input = elgg_view('input/hidden', array('id' => 'relacion', 'value' => $relacion));
    $url=  elgg_get_site_url();
    $url1= $url."convocatorias/presupuesto_investigaciones/$guid_convocatoria";
    echo "  <div class='box contet-grupo-investigacion'><div class='padding20'>"
    . "<div class='header-list-group'><div class='titulo-list-group'> "
    . "$titulo <br /></div></div>"
    . "<div class='contenedor-button'><a class='link-button' href='$url1'>Presupuesto</a></div>"
    . "<br><label>Seleccione la Línea Temática:  </label><div class='form-div-middle'>" . $lineas_input . "</div>"
    . "</div></div>" . $convocatoria_input . $relacion_input . "<div id='investigaciones'>";
    echo elgg_get_investigaciones_linea_convocatoria(15, 0, $guid_convocatoria, $listado_lineas[0]['id_linea'], $relacion);
    echo "</div>";
} else {
    echo elgg_get_investigaciones_linea_convocatoria(15,$offset, $guid_convocatoria, $id_linea, $relacion);
}
echo "<div style='display:none;' id='dialog' title='Definir Categoría'><p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;></span></p></div>";