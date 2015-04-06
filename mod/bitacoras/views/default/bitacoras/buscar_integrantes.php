<?php



$guid=  get_input('id_grupo');
$clave=  get_input('id');
$nuevos=buscar_integrantes_grupo($guid, $clave);


foreach ($nuevos as $user) {
        $fbnombre=$user['nombres_usuario'];
        $fbapellido=$user['apellidos_usuario'];
       
        $nombres=$fbapellido." ".$fbnombre;
        $options[$nombres]=$user['id_usuario'];
        
}

$tabla1.="<form name='prueba' id='prueba'><table class='elgg-table-alt' width='30%' align='center'> 
        <tr>
           <th>Integrantes</th>
           <th>Seleccionar</th>
        </tr>";

$tabla1.=elgg_view('input/checkboxes_1', array('name'=>'integrantes','align'=>'Vertical', 'options'=>$options));
$tabla1.="</form></table>";

$button = elgg_view('input/submit', array('value' => elgg_echo('Agregar'), 'id'=>'boton-agregar'));
$id=  elgg_view('input/hidden', array('name'=>'id_grupo','value'=>$guid));

echo <<<HTML
<div>
   $tabla1
   $id
</div>
<div class="elgg-foot" align="center">
    <br><a  id="boton-agregar">Agregar </a>
</div>
HTML;
?>
