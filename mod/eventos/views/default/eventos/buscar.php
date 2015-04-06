<?php 

$guid=  get_input('id_evento');

$id_conv=  get_input('id_conv');
$clave=  get_input('id');
$nuevos=buscar_directorio($guid, $clave);

foreach ($nuevos as $user) {
        $fbnombre=$user['nombres_usuario'];
        $fbapellido=$user['apellidos_usuario'];
        $nombres=$fbapellido." ".$fbnombre;
        $options[$nombres]=$user['id_usuario'];
}

$tabla1.="<table class='tabla-coordinador'> 
        <tr>
           <th>Nombres</th>
           <th>Asistió</th>
        </tr>";

$tabla1.=elgg_view('input/checkboxes_1', array('name'=>'asistentes','align'=>'Vertical', 'options'=>$options));
$tabla1.="</table>";
$button = elgg_view('input/submit', array('value' => elgg_echo('Vincular')));
$id=  elgg_view('input/hidden', array('name'=>'id_evento','value'=>$guid));
$id_c=  elgg_view('input/hidden', array('name'=>'id_conv','value'=>$id_conv));

echo <<<HTML
<div>
   $tabla1
   $id
   $id_c
</div>
<div class="contenedor-button">
    $button
</div>
HTML;
?>





