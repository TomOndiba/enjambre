<?php
$usuario = $vars['user'];
$usuario_entity= new ElggUsuario($usuario);
$user = elgg_get_logged_in_user_entity();
$list = "";
$permiso = $rol;
$link_url=elgg_get_site_url()."action/usuario/add_request?friend=$usuario";
$url_agregar=  elgg_add_action_tokens_to_url($link_url);
$params['buttons'] = array();
if(!$user->isFriendsWith($usuario) && $user->guid != $usuario && !$usuario_entity->isFriendsWith($user->guid)&&!$user->isRequestFrient($usuario)&& !$usuario_entity->isRequestFrient($user->guid)){    
    $list.="<li><a href='{$url_agregar}' title='Agregar'><div class='icon-agregar' data-tooltip='Agregar como Amigo'></div></a></li>";
}
else if($user->guid==$usuario){
$list.="<li><a href='".elgg_get_site_url()."profile/$usuario_entity->username/edit' ><div class='icon-editar' data-tooltip='Editar Usuario'></div></a></li>";
$list.="<li><a href='".elgg_get_site_url()."profile/$usuario_entity->username/cambiar_password' ><div class='icon-pass' data-tooltip='Cambiar contraseña'></div></a></li>";
}

?><ul>
    <?php
    echo $list;
    ?>
</ul>