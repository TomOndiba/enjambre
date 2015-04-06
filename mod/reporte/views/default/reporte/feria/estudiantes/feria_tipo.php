<?php

/** Vista Ajax que lista las instituciones de un municipio seleccionado
 */

$tipo=get_input('tipo');
$id=get_input('id');


$ferias=elgg_get_ferias_tipo($tipo);
$option_feria=array();
$option_feria['']='';
foreach($ferias as $feria){
    $option_feria[$feria->guid]=$feria->name; 
    
}
$feria_input = elgg_view('input/dropdown', array('name' => 'feria', 'class'=>'select-reportes', 'required'=>'true', 'id' => $id, 'options_values'=>$option_feria,));
echo '<label>Feria</label>';
echo $feria_input;
