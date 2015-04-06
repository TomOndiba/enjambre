<?php

/**
 * 
 */

$grupo = get_input('grupo');
$id = get_input('id');

$investigaciones = elgg_get_investigaciones_por_grupo($grupo);

$option_inv=array();
$option_inv['']='';
foreach($investigaciones as $inv){
    $option_inv[$inv->guid]=$inv->name; 
    
}
if(sizeof($investigaciones) > 0){
$inv_input = elgg_view('input/dropdown', array('name' => 'investigaciones', 'class'=>'select-reportes', 'required'=>'true', 'id' => $id, 'options_values'=>$option_inv));
}else{
    $inv_input = "No existen investigaciones registradas con el Grupo....";
}

echo "<label>Investigaciones </label>";
echo $inv_input;
