<?php

$entities=$vars['entities'];

$site_url=  elgg_get_site_url();



foreach($entities as $entity){
    
 $url1= elgg_get_site_url()."action/grupo_investigacion/activar_grupo?id=".$entity->guid;
 $url_activar= elgg_add_action_tokens_to_url($url1);

 
if(elgg_is_admin_logged_in() || elgg_is_rol_logged_user("coordinador") ){
    $activar="<a href='$url_activar'>Habilitar</a>";
}

  $lista.="<div class='item-convocatoria'><h3> {$entity->name}</h3> <div class='menu-item-coordinacion'>$activar </div><div class='subtitulo-convocatoria'></div></div>";
     
}

if(sizeof($entities)==0){
    $lista="<h3> No hay Entidades Inactivas </h3>";
}

echo $lista;


