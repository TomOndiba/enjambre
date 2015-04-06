<?php

elgg_load_js('acciones');
$entity = $vars['entity'];
$usuario = new ElggUsuario($entity->guid);
$guid_grupo = $vars['grupo'];

$url = elgg_get_site_url()."action/grupo_investigacion/desactivar_integrante?id=".$usuario->guid.'&grupo='.$guid_grupo;
$url_des = elgg_add_action_tokens_to_url($url);

$vars = array('guid' => $entity->guid);
$title_link = elgg_extract('title', $vars, '');
$subtype=$usuario->getSubtype();

$admin="";
$grupo=get_entity($guid_grupo);
if(elgg_get_logged_in_user_guid()==$grupo->owner_guid){
$admin = "<br<a onclick='confirmarDesactivarEstudiante(\"".$url_des."\")'>Desactivar</a>";
}
$datos="";
if($subtype=="estudiante"){
    
    $fecha = $usuario->fecha_nacimiento;
    list($Y, $m, $d) = explode("-", $fecha);
    $edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
    $datos="<br><label> Edad:</label>".$edad."<br>"
         . "<label> Curso:".$usuario->curso;           
}


$contenido = "<li class='item-usuario'>"
        . "<a href='".elgg_get_site_url()."profile/".$entity->username."'><img src='{$usuario->getIconURL()}' /></a><div><a><span class='name-usuario'>{$usuario->name} {$usuario->apellidos}</span></a>"
        ."<br>$datos <br>"
        . "<br><br>".  ucfirst($subtype)
        . "<br>$admin"
        . "</div></li>";
        
echo '<div style="display:none;" id="dialog-confirm-desactivar-integrante" title="Confirmación"> Está seguro de Desactivar el Integrante?</div>';
echo $contenido;

