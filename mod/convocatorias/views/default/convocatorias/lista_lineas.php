<?php

$relacion=get_input('relacion');
$guid_convocatoria=get_input('convocatoria');
$convocatoria= new ElggConvocatoria($guid_convocatoria);
$lineasAsociadas = elgg_get_relationship($convocatoria, "tiene_la_línea_temática");
$lineas_asociadas= Array();
foreach ($lineasAsociadas as $linea) {
    $lin= array('id_linea'=>$linea->guid, 'nombre_linea'=>$linea->name);
    array_push($lineas_asociadas, $lin);
}
$listado_lineas=$lineas_asociadas;
//relacion es la variable para distinguir si se van a mostrar las investigaciones preinscritas o las inscritas
if($relacion=="inscritas")
    $titulo = elgg_view_title("Investigaciones Inscritas en la convocatoria $nombre_conv");
else
    $titulo = elgg_view_title("Investigaciones PreInscritas en la convocatoria $nombre_conv"); 

$option=array();

foreach($listado_lineas as $listado){
    $option[$listado['id_linea']]=$listado['nombre_linea'];    
}

$lineas_input = elgg_view('input/dropdown', array('name' => 'linea', 'id'=>'linea', 'class'=>'select', 'required'=>'true','options_values'=>$option));
$relacion_input=  elgg_view('input/hidden', array('id'=>'relacion', 'value'=>$relacion));

echo "  <div class='box contet-grupo-investigacion'><div class='padding20'>"
. "<div class='header-list-group'><div class='titulo-list-group'> "
. "$titulo <br /></div></div>"
."<label>Seleccione la Línea Temática:  </label><div class='form-div-middle'>".$lineas_input. "</div>"
. "</div></div>".$convocatoria_input.$relacion_input."<div id='investigaciones'> </div>";