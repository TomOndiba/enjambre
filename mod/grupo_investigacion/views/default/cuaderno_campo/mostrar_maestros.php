<?php



$id_grupo=  get_input('id_grupo');
$id_cuad= get_input('id_cuad');
$clave=  get_input('id');



$nuevos=elgg_buscar_maestros($id_grupo, $id_cuad, $clave);


foreach ($nuevos as $user) {
        $fbnombre=$user['nombres_usuario'];
        $fbapellido=$user['apellidos_usuario'];
        $nombres=$fbnombre." ".$fbapellido;
        $options[$nombres]=$user['id_usuario'];
        
}
$tabla1 = "<ul>";
$tabla1.=elgg_view('input/checkboxes_2', array('name' => 'integrantes', 'align' => 'Vertical', 'options' => $options));
$tabla1.="</ul>";
if (count($nuevos)==0) {
    echo "<div class='no-element' style='margin-left:40px; margin-top:10px; color:black'><b>No existen integrantes del grupo con ese nombre</b></div>";
} else {
    $button = elgg_view('input/submit', array('value' => elgg_echo('Agregar')));
    $id_g = elgg_view('input/hidden', array('name' => 'id_grupo', 'value' => $id_grupo));
    $id_c = elgg_view('input/hidden', array('name' => 'id_cuad', 'value' => $id_cuad));
    echo <<<HTML
<div>
   $tabla1
   $id_g
   $id_c
</div>
<div class="elgg-foot" align="center">
   $button <br><br>
</div>
</div>
HTML;
}
?>
