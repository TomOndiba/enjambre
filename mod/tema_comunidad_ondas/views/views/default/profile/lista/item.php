<?php
$entity = $vars['entity'];
$user = new ElggUsuario($entity->guid);
$guid = $vars['guid'];
$site_url = elgg_get_site_url();
$url = "{$site_url}profile/{$user->username}";


$text = $entity->name . " " . $entity->apellidos;
$params = array(
    'text' => elgg_get_excerpt($text, 100),
    'href' => $url,
    'is_trusted' => true,
);
$title_link = elgg_view('output/url', $params);

//error_log("VIENDO TITULO LINK -> $title_link");

$url_icono = $user->getIconURL();

if (elgg_get_logged_in_user_guid() == $guid) {
    $url1 = elgg_get_site_url() . "action/tema_comunidad_ondas/delete_friend?id={$guid}&idf={$user->guid}";
    $url_eliminar = elgg_add_action_tokens_to_url($url1);
    $lista = '<li><a onclick="confirmar(\'' . $url_eliminar . '\')">Eliminar Amigo</a></li>';
}
?>

<!--<ul class='list-usuarios'>-->
<li class="item-usuario">
    <a href="<?php echo $url; ?>"><img class="imagen-perfil"src="<?php echo $url_icono; ?>"/></a>
    <div>
        <div>
            <a href="<?php echo $url; ?>"><span class='name-usuario'><?php echo $title_link; ?></span></a>
        </div>
        <br><br>
        <ul>
            <?php echo $lista; ?>         
        </ul>
    </div>
</li>

<!--</ul>-->
