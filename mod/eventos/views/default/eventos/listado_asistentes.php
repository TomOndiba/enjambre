<?php 

$guid=  $vars['id'];
$nombre_evento=$vars['nombre'];
$nombre_convocatoria=$vars['nombre_conv'];
$id_conv=  $vars['id_conv'];
$asistentes=  $vars['asistentes'];

$url=elgg_get_site_url();
$url1= $url."eventos/registro_asistencia/$guid/$id_conv";


if(!empty($asistentes)){
$tabla1.="<table class='tabla-coordinador' width='30%' align='center'> 
        <tr>
           <th>Nombres</th>
           <th>Tipo Documento</th>
           <th>N° Documento</th>
           <th>Email</th>
           <th>Tipo Usuario</th>
        </tr>";
}
else{
    $tabla1="No hay asistentes registrados";
}
foreach ($asistentes as $user) {
    
    $id_user=$user['id_usuario'];
    $fbnombre=$user['nombres_usuario'];
    $fbapellido=$user['apellidos_usuario'];
    $nombres=$fbapellido." ".$fbnombre;
    $tipo_doc=$user['tipo_documento'];
    $num_doc=$user['numero_documento'];
    $tipo_user=ucfirst($user['tipo_user']);
    $email=$user['email'];

    $tabla1.="<tr>
                    <td>$nombres</td>
                    <td>$tipo_doc</td>
                    <td>$num_doc</td>
                    <td>$email</td>
                    <td>$tipo_user</td>
                 </tr>";
}

$tabla1.="</table>";

$id=  elgg_view('input/hidden', array('name'=>'id_evento','value'=>$guid));
$id_c=  elgg_view('input/hidden', array('name'=>'id_conv','value'=>$id_conv));

$entity=  get_entity($id_conv);

?>

<div class = "content-coordinacion">
<div class = "titulo-coordinacion">
 <?php 
 if($entity->getSubtype()=="convocatoria"){
     echo "<h2>Convocatoria: $entity->name</h2>";
 }
 else if($entity->getSubtype()=="feria"){
     echo "<h2>Feria: $entity->name</h2>";
 }
 else{}
?>
</div>
<div class="menu-coordinacion">
<?php 
if($entity->getSubtype()=="convocatoria"){
echo elgg_view("convocatorias/menu", array('guid' => $id_conv)); 
}
 else if($entity->getSubtype()=="feria"){
echo elgg_view("ferias/menu", array('guid' => $id_conv)); 
}
else{}
?>
    
</div>
<div class="contenido-coordinacion">
<?php


echo <<<HTML

    <h2> Listado de Asistentes al Evento: $nombre_evento  </h2>
    
   $tabla1
    
    <a class='link-button' href='$url1'>Registrar Asistentes</a>
   
   $id
   $id_c


HTML;
?>
</div>


