<?php   

$guid=$vars['id'];
$id_conv=$vars['id_conv'];
$preinscritos=$vars['preinscritos'];
$nombre_evento=$vars['nombre'];
$options=array();

$tabla1="<br><table class='tabla-coordinador' width='40%' align='center'> 
        <tr><th>Nombres</th>
            <th>Asistió</th></tr>";
foreach ($preinscritos as $pre){
    $nombres=$pre['apellidos_usuario']." ".$pre['nombres_usuario'];
    $options[$nombres]=$pre['id_usuario'];
}
$tabla1.=elgg_view('input/checkboxes_1', array('name'=>'asistentes','align'=>'Vertical', 'options'=>$options));
$button = elgg_view('input/submit', array('value' => elgg_echo('Vincular')));
$id=  elgg_view('input/hidden', array('name'=>'id','value'=>$guid));
$id_c=  elgg_view('input/hidden', array('name'=>'id_conv','value'=>$id_conv));
$tabla1.="</table>";

if(!empty($preinscritos)){
    $instruct=  elgg_echo('evento:asistentes:instruct');    
}else{
    $instruct=  elgg_echo('evento:no:preinscritos:instruct');
    $tabla1="";
    $button="";
}

$url=elgg_get_site_url();
$url1= $url."eventos/buscar_asistentes/$guid/$id_conv";

$url2=elgg_get_site_url();
$url3= $url2."eventos/registro_usuarios/$guid/$id_conv";

echo <<<HTML
<h2> Registrar asistentes al evento $nombre_evento </h2>
<div>
   $instruct 
   $tabla1
   $id $id_c
        <div class="contenedor-button" align="center">
   $button
</div>
</div>

<div class="contenedor-button">
    <a class='link-button' href='$url1'>Directorio</a>
    <a class='link-button' href='$url3'>Nuevo Usuario</a>    
</div>
HTML;
?>