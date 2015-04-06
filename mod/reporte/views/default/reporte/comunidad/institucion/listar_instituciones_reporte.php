<?php

/** Vista Ajax que lista las instituciones de un municipio seleccionado
 */

$departamento=get_input('departamento');
$municipio=get_input('municipio');
$institucion2=  get_input('institucion');


$intituciones=elgg_buscar_instituciones_Municipio($municipio, $departamento);
$option_institucion=array();
$option_institucion['']='';
foreach($intituciones as $institucion){
    $option_institucion[$institucion['id']]=$institucion['nombre']; 
    if($institucion["nombre"]==$institucion2 || $institucion["id"]==$institucion2){
        $value=$institucion['id'];
    }
}
$institucion_input = elgg_view('input/dropdown', array('name' => 'institucion', 'class'=>'select-reportes', 'required'=>'true', 'id' => 'inst', 'options_values'=>$option_institucion,'value'=>$value));
echo $institucion_input;
