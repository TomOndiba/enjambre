<?php 

$guid_convocatoria=  get_input('id_convocatoria');
$guid_linea=  get_input('id_linea');
$guid_investigacion=  get_input('id_investigacion');
$tipo= get_input('tipo');

$convocatoria=new ElggConvocatoria($guid_convocatoria);

$lineasAsociadas = elgg_get_relationship($convocatoria, "tiene_la_línea_temática");
if(!empty($lineasAsociadas)){
    $sw=false;
    $contador=0;
    foreach ($lineasAsociadas as $linea) {
        if($tipo==$linea->tipo){
            $contador++;
            if($guid_linea != $linea->guid){
                $lineas[$linea->name]=$linea->guid;
            }else{
                $sw=true;
            }
        }
    }
  
    if($contador==1 && $sw){
        $check = 'No existen otras lineas de este tipo asociadas a la convocatoria';
    }else{
        $check=elgg_view('input/radio', array('required'=>'true', 'name'=>'lineas','align'=>'Vertical', 'options'=>$lineas));
        $button = elgg_view('input/submit', array('value' => elgg_echo('Guardar')));
    }
}else{
    $check = 'No existen otras lineas de este tipo asociadas a la convocatoria';
}

echo <<<HTML
<br>
<div>
   $check
</div>
<div class="elgg-foot" align="center">
    <br><br>$button &nbsp; &nbsp; &nbsp;
</div>
HTML;
?>
