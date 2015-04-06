<?php 

elgg_load_js('acciones_investigacion');
$guid=  get_input('id');
$guid_grupo=  get_input('id_grupo');
$guid_investigacion=  get_input('id_investigacion');

$convocatoria= new ElggConvocatoria($guid);
$departamento = $convocatoria->departamento;
$fecha_apertura = $convocatoria->fecha_apertura;
$fecha_cierre = $convocatoria->fecha_cierre;
$tipo_convocatoria = $convocatoria->tipo_convocatoria;

if($tipo_convocatoria=='Proyectos abiertos y preestructurados'){

    $tipo_input=elgg_view('input/dropdown', array('name'=>'tipo_linea', 'class'=>'buscar_linea','align'=>'Vertical', 'options_values'=>array('0'=>'Seleccionar..', 'Proyectos abiertos'=>'Proyectos abiertos', 'Proyectos preestructurados'=>'Proyectos preestructurados')));
    $content=  elgg_view('investigacion/lista_lineas_tipo',$params);
    $y = elgg_view('input/hidden', array('name' => 'id_convocatoria','class' => 'convocatoria', 'value' => $guid));
    $url = elgg_get_site_url()."investigaciones/ver/$guid_investigacion/grupo/$guid_grupo";

echo <<<HTML
<br>
<div>
    <table  class='vertical-table'>
        <tr><th>Tipo de Convocatoria:</th>
            <td>$tipo_convocatoria</td></tr>
        <tr><th>Departamento:</th>
            <td>$departamento</td></tr>
       <tr><th>Fecha de apertura de la convocatoria:</th>
            <td>$fecha_apertura</td></tr>
        <tr><th>Fecha de cierre de la convocatoria:</th>
            <td>$fecha_cierre</td></tr>
    </table><br><br>
</div>  
<div>
   Seleccione un tipo: $tipo_input
   <br>$y
   $content
</div>
<div id='href1' class="contenedor-button">
    
</div>
HTML;
}else{
    $lineasAsociadas = elgg_get_relationship($convocatoria, "tiene_la_línea_temática");

    if(!empty($lineasAsociadas)){
        $lineas_asociadas= Array();
        foreach ($lineasAsociadas as $linea) {
            $lin= array('id_linea'=>$linea->guid, 'nombre_linea'=>$linea->name);
           
            $melany[$linea->name]=$linea->guid;
            array_push($lineas_asociadas, $lin);
        }
        $check=elgg_view('input/radio', array('required'=>'true', 'name'=>'lineas','align'=>'Vertical', 'options'=>$melany));
    $button = elgg_view('input/submit', array('value' => elgg_echo('Inscribirse')));
    }else{
        $check = 'No existen lineas asociadas a la convocatoria';
    }

    $url = elgg_get_site_url()."investigaciones/ver/$guid_investigacion/grupo/$guid_grupo";
echo <<<HTML
<br>
<div>
    <table class='vertical-table'>
        <tr><th>Tipo de Convocatoria:</th>
            <td>$tipo_convocatoria</td></tr>
        <tr><th>Departamento:</th>
            <td>$departamento</td></tr>
       <tr><th>Fecha de apertura de la convocatoria:</th>
            <td>$fecha_apertura</td></tr>
        <tr><th>Fecha de cierre de la convocatoria:</th>
            <td>$fecha_cierre</td></tr>
    </table><br><br>
</div>
<div class='seleccion-linea'> <label>Lineas Tematicas</label><br><br> 
<div>
   $check
</div>
</div>
<div class="contenedor-button">
    <br><br>$button &nbsp; &nbsp; 
</div>
HTML;
}
?>
