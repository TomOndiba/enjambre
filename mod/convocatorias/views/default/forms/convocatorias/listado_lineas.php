<?php
/**
 * Formulario que permite realizar la administración de las líneas temáticas dentro de una convocatoria
 */
$guid=$vars['id'];
$nombre=$vars['nombre'];
$departamento=$vars['departamento'];
$convenio=$vars['convenio'];
$fecha_apertura=$vars['fecha_apertura'];
$fecha_cierre=$vars['fecha_cierre'];
$lineas_sin_asociar=$vars['lineas_sin_asociar'];
$lineas_asociadas=$vars['lineas_asociadas'];
$tipo=$vars['tipo'];
$lineas_sin_asociar_abiertas=$vars['lineas_sin_asociar_abiertas'];
$lineas_abiertas_asociadas=$vars['lineas_asociadas_abiertas'];

$options=array();
if($tipo=="Mixta"){
    if(!empty($lineas_asociadas)){
        $asociadas="<tr><th><i>Proyectos preestructurados</i></th></tr><tr><td>&nbsp;</td></tr>";
    }
    if(!empty($lineas_abiertas_asociadas)){
        $asociadas2="<tr><td>&nbsp;</td></tr><tr><th><i>Proyectos abiertos</i></th></tr><tr><td>&nbsp;</td></tr>";
    }
}

foreach ($lineas_sin_asociar as $lin){
    $options[$lin['nombre_linea']]=$lin['id_linea'];
}

foreach ($lineas_asociadas as $lin){
    
    $guid_lin=$lin['id_linea'];
    $nombre_lin=$lin['nombre_linea'];
    
    $url1= elgg_get_site_url()."action/convocatorias/desasociar?id=".$guid."&linea=".$guid_lin;
    $url_desasociar= elgg_add_action_tokens_to_url($url1);
    
    $asociadas.="<tr>
                    <td><b>-&nbsp;&nbsp;$nombre_lin</b></td>
                    <td><a href='$url_desasociar'>Desasociar</></td>
                 </tr>";
}

if($tipo=='Mixta'){
    $options2=array();
    
    foreach ($lineas_sin_asociar_abiertas as $lin){
        $options2[$lin['nombre_linea']]=$lin['id_linea'];
    }

    foreach ($lineas_abiertas_asociadas as $lin){

        $guid_lin=$lin['id_linea'];
        $nombre_lin=$lin['nombre_linea'];

        $url1= elgg_get_site_url()."action/convocatorias/desasociar?id=".$guid."&linea=".$guid_lin;
        $url_desasociar= elgg_add_action_tokens_to_url($url1);

        $asociadas2.="<tr>
                        <td><b>-&nbsp;&nbsp;$nombre_lin</b></td>
                        <td><a href='$url_desasociar'>Desasociar</></td>
                     </tr>";
    }
}

$msjeLineasAsociadas=elgg_echo('convocatoria:lineas:asociadas');
if(empty($lineas_asociadas) && empty($lineas_abiertas_asociadas)){
    $asociadas="";
    $asociadas2="";
    $msjeLineasAsociadas=elgg_echo('convocatoria:lineas:asociadas:vacia');
   
}


$msjeLineasNoAsociadas=elgg_echo('convocatoria:lineas:no:asociadas');
if(empty($lineas_sin_asociar) && empty($lineas_sin_asociar_abiertas)){
    $titulo1="";
    $titulo2="";
    $msjeLineasNoAsociadas=elgg_echo('convocatoria:lineas:no:asociadas:vacia');
    $button=" ";
}
else{
    
 $button = elgg_view('input/submit', array('value' => elgg_echo('Asociar')));   
}



$linea=elgg_view('input/checkboxes', array('name'=>'lineas','align'=>'Vertical', 'options'=>$options));

if($tipo=="Mixta"){
    if(!empty($lineas_sin_asociar)){
        $titulo1="<i>Proyectos preestructurados</i> <br><br>";
    }
    if(!empty($lineas_sin_asociar_abiertas)){
        $titulo2="<br><i>Proyectos abiertos</i> <br><br>";
        $linea2=elgg_view('input/checkboxes', array('name'=>'lineas2','align'=>'Vertical', 'options'=>$options2));
    }
}

$id=  elgg_view('input/hidden', array('name'=>'id','value'=>$guid));


//$linea_admin = elgg_get_site_url().'linea/listar';

echo <<<HTML
   $id
      
<div>
    <center><br><b> Líneas temáticas </b></center>
    <hr>
        $msjeLineasAsociadas
        <br><br>
        <table class='tabla-coordinador'>
            $asociadas
            $asociadas2
        </table>
        <br><br>
        $msjeLineasNoAsociadas
        <br><br>$titulo1
        $linea $titulo2
        $linea2
</div>
<div class="contenedor-button" align="center">
    $button
    
</div><br><br>

HTML;
?>