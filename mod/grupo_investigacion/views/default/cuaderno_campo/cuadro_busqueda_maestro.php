<?php

elgg_load_js('acciones');
elgg_load_js('buscar_maestros');

$id_grupo = $vars['id_grupo'];
$id_cuad = $vars['id_cuad'];
$listado = $vars['maestros'];

$url_re = elgg_get_site_url();
$url_volver = $url_re . "grupo_investigacion/ver/" . $id_grupo . "/cuadernos/" . $id_cuad;

$cuaderno = get_entity($id_cuad);

$tabla1.="<ul class='list-usuarios'>";


foreach ($listado as $user) {
    $url1 = elgg_get_site_url() . "action/cuaderno_campo/eliminar_integrante?id=" . $user['id'] . "&id_cuad=" . $id_cuad;
    $url_eliminar = elgg_add_action_tokens_to_url($url1);
    $fbnombre = $user['nombre'];
    $fbapellido = $user['apellidos'];
    $nombres = $fbapellido . " " . $fbnombre;
    $curso = $user['curso'];
    $sexo = $user['sexo'];
    $email = $user['email'];
    $tabla1.="<li class='item-usuario' style='width:220px; min-height:150px;'>";
    $tabla1.="<a href='$url_re.'profile/{$user['username']}'><img src='{$user['icono']}'/></a>";
    $tabla1.="<div>"
            . "<a href='{$url_re}profile/{$user['username']}'><span class='name-usuario'>{$user['nombre']} {$user['apellidos']}</span></a><br>"
            . "<span>$email</span><br><br>"
            . "<span><b>Curso:</b> $curso</span><br>"
            . "<span><b>Sexo:</b> $sexo</span><br><br><br>"
            . "<ul><li><span><a onclick='confirmar(\"{$url_eliminar}\")'>Eliminar</a></span></li></ul>"
            . "</div>";
    $tabla1.= "</li>";
}

$tabla1.="</ul>";


if (sizeof($listado) > 0) {
    $int = $tabla1;
} else {
    $int = "<div class='no-element' style='margin-left:40px; margin-top:10px; color:black'><b>Aun no existen maestros en la Investigación </b></div>";
}

if ($cuaderno->getSubtype() == "cuaderno_campo") {
    $url_re = elgg_get_site_url();
    $url_volver = "<a href='" . $url_re . "grupo_investigacion/ver/" . $id_grupo . "/cuadernos/" . $id_cuad . "'>Volver </a><br><br>";
    $texto = "Seleccione los maestros que quiera agregar a la iniciativa de investigación: {$cuaderno->name}";
} else {
    $url_volver = "";
    $texto = "Seleccione los maestros que quiera agregar a la Investigación: {$cuaderno->name}";
}

$content = elgg_view_form('cuaderno_campo/lista_maestros', NULL, $params);
echo <<<HTML
<div class='box'>
$url_volver
        <h2 class='title-legend'>Agregar Maestros</h2>
<div style="display:none;" id="dialog-confirm" title="Confirmación"> Está seguro de eliminar el Maestro de la investigación?</div>
<div class='busqueda-integrantes'>
    <br><label style='color:black'>$texto</label><br><br>
    <input type="text" class="buscar_maestros" id="cajabusqueda" placeholder="Escriba el nombre del maestro..."/>
    <input type="hidden" id="id_grupo" value='$id_grupo'/>
    <input type="hidden" id="id_cuad" value='$id_cuad'/>
    <br>
</div>
        <div>
            $content
            $int <br> 
       </div>
</div>
HTML;
?>
             