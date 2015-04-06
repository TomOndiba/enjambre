<?php

$entity = $vars['entity'];
$user = new ElggUsuario($entity->guid);
$var = array('guid' => $grupo->guid,
    'owner_guid' => $grupo->owner_guid);
$site_url = elgg_get_site_url();
$url="{$site_url}profile/{$user->username}";
if ($title_link === '') {
    $text= $user->name . " " .$user->apellidos;
    $params = array(
        'text' => elgg_get_excerpt($text, 100),
        'href' => $url,
        'is_trusted' => true,
    );
    $title_link = elgg_view('output/url', $params);
}
$url_icono=$user->getIconURL();
$imagen= "<a href='$url'><img src='$url_icono' class='imagen-group-list'></img>";
echo "<div class='grupo-item-list box'>";
echo "<div class'imagen-grupo-item-list'>$imagen</div>";
echo "<div class='contenido-grupo-item-list'><h3>$title_link</h3>";
echo elgg_view("grupo_investigacion/lista/option", $var);
echo"</div></div>";


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

