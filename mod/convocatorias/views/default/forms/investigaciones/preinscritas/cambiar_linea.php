<?php

$guid_conv=$vars['id_conv'];
$guid_linea=$vars['id_linea'];

$guid_inv=$vars['id_inv'];

$linea= new ElggLineaTematica($guid_linea);
$convocatoria= new ElggConvocatoria($guid_conv);
$tipo_convocatoria = $convocatoria->tipo_convocatoria;
$y = elgg_view('input/hidden', array('name' => 'id_convocatoria','class' => 'convocatoria', 'value' => $guid_conv));
$x = elgg_view('input/hidden', array('name' => 'id_investigacion','class' => 'investigacion', 'value' => $guid_inv));
$z = elgg_view('input/hidden', array('name' => 'id_linea_ant','class' => 'linea', 'value' => $guid_linea));

    
if($tipo_convocatoria=='Proyectos abiertos y preestructurados'){

    $tipo_input=elgg_view('input/dropdown', array('name'=>'tipo_linea', 'class'=>'buscar_linea','align'=>'Vertical', 'options_values'=>array('0'=>'Seleccionar..', 'Proyectos abiertos'=>'Proyectos abiertos', 'Proyectos preestructurados'=>'Proyectos preestructurados')));
    $content=  elgg_view('investigaciones/preinscritas/lista_lineas_tipo',$params);
    
echo <<<HTML
<div>
    Actualmente se encuentra inscrito con la línea temática: <b>$linea->guid</b>
</div>
<div>
   Para cambiar la línea seleccione un tipo: <br>$tipo_input
   <br>$y $x $z
   $content
</div>
HTML;
}else{
    $lineasAsociadas = elgg_get_relationship($convocatoria, "tiene_la_línea_temática");

    if(!empty($lineasAsociadas)){
        foreach ($lineasAsociadas as $lineaa) {
            if($guid_linea != $lineaa->guid){
                $lineas[$lineaa->name]=$lineaa->guid;
            }
        }
        $check=elgg_view('input/radio', array('required'=>'true', 'name'=>'lineas','align'=>'Vertical', 'options'=>$lineas));
        $button = elgg_view('input/submit', array('value' => elgg_echo('Guardar')));
    }else{
        $check = 'No existen otras lineas asociadas a la convocatoria';
    }

echo <<<HTML
<br>
<div>
    Actualmente se encuentra inscrito con la línea temática: $linea->name
</div>
<div> <label>Seleccione la nueva línea temática:</label><br><br></div>  
<div>$y $x $z
   <div class='form-lineas'>$check</div>
</div>
<div class="elgg-foot" align="center">
    <br><br>$button &nbsp; &nbsp; &nbsp;
</div>
HTML;
}
?>
