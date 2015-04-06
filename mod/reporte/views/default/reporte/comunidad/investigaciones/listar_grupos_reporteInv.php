<?php

/** Vista Ajax que lista las instituciones de un municipio seleccionado
 */


$institucion=  get_input('institucion');
$id=  get_input("id");


$grupos=  elgg_get_grupos_por_institucion($institucion);
$option_grupo=array();
$option_grupo['']='';
foreach($grupos as $grupo){
    $option_grupo[$grupo->guid]=$grupo->name; 
    
}
$grupo_input = elgg_view('input/dropdown', array('name' => 'grupo', 'class'=>'select-reportes', 'required'=>'true', 'id' => $id, 'options_values'=>$option_grupo));
echo "<label>Grupo </label>";
echo $grupo_input;
