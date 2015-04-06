<?php



$id_grupo=  $vars['id_grupo'];
$integrantes=  $vars['integrantes'];

$url=elgg_get_site_url();

$tabla1.="<table class='elgg-table-alt' width='30%' align='center'> 
        <tr>
           <th>Nombre</th>
           <th>Grado</th>
           <th>Sexo</th>
           <th>Email</th>
        </tr>";


$listado = array();
foreach($integrantes as $as){
    $options=array(
        'type'=>'user',
        'guid'=>$as,
    );
    $usuario=  elgg_get_entities($options);
    $user=$usuario[0];
    
   
     $integ = array('nombre' => $user->name, 'apellidos' => $user->apellido, 'sexo'=>$user->sexo, 'curso'=>$user->curso, 'email'=>$user->email);
     array_push($listado, $integ);
}



foreach ($listado as $user) {
    
    $fbnombre=$user['nombre'];
    $fbapellido=$user['apellidos'];
    $nombres=$fbapellido." ".$fbnombre;
    $curso=$user['curso'];
    $sexo=$user['sexo'];
    $email=$user['email'];

    $tabla1.="<tr>
                    <td>$nombres</td>
                    <td>$curso</td>
                    <td>$sexo</td>
                    <td>$email</td>
                 </tr>";
}

$tabla1.="</table>";

          


echo <<<HTML
<div>
    <hr>
    <br>
   $tabla1
  
</div>
<div class="elgg-foot" align="center">
</div>
HTML;
?>


