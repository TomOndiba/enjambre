<?php
$ajax=  get_input('ajax',0);
$idGrupo = get_input('id');
$grupo = new ElggGrupoInvestigacion($idGrupo);
$title = $grupo->name . ": Administración de Roles";
$miembrosGrupo = elgg_get_miembros_grupo_investigacion($grupo);
$params['title'] = $title;
$params['grupo'] = array(
    'nombre' => $grupo->name,
    'guid' => $grupo->guid,
    'rol_user' => $rol,
);
$params['ajax']=$ajax;
$params['buttons'] = array();
$params['miembros'] = $miembrosGrupo;
$content= elgg_view('grupo_investigacion/profile/header', $params);
$content.=elgg_view('grupo_investigacion/roles/admin_roles', $params);
$vars = array('content' => $content);
$body = elgg_view_layout('one_sidebar', $vars);
echo elgg_view_page($title, $body);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

