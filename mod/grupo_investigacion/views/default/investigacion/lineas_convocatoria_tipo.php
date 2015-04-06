<?php 



$guid_convocatoria=  get_input('id_convocatoria');
$guid_grupo=  get_input('id_grupo');
$guid_investigacion=  get_input('id_investigacion');
$tipo= get_input('tipo');

$convocatoria=new ElggConvocatoria($guid_convocatoria);

$lineasAsociadas = elgg_get_relationship($convocatoria, "tiene_la_línea_temática");

if(!empty($lineasAsociadas)){
    //$lineas_asociadas= Array();
    foreach ($lineasAsociadas as $linea) {
        
        if($tipo==$linea->tipo){
            //$lin= array('id_linea'=>$linea->guid, 'nombre_linea'=>$linea->name);
            $melany[$linea->name]=$linea->guid;
            //array_push($lineas_asociadas, $lin);
        }
    }
    $check=elgg_view('input/radio', array('required'=>'true', 'name'=>'lineas','align'=>'Vertical', 'options'=>$melany));
    $button = elgg_view('input/submit', array('value' => elgg_echo('Inscribirse')));
}else{
    $check = 'No existen lineas de este tipo asociadas a la convocatoria';
}

$url = elgg_get_site_url()."investigaciones/ver/$guid_investigacion/grupo/$guid_grupo";
echo <<<HTML
<br>
<div> <label>Lineas Tematicas</label><br><br></div>  
<div>
   $check
</div>
<div class="contenedor-button">
    <br><br>$button
</div>
HTML;
?>
