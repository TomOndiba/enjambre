<?php
$site_url = elgg_get_site_url();
if ($vars["list"]) {
    $class = "total";
}
$url_convocatorias = $site_url . "evaluadores/listar_convocatorias_evaluador";
$url_feria = $site_url . "evaluadores/listar_ferias_asignadas";
$url_hoja_vida = $site_url . "evaluadores/hojadevida";
$user = elgg_get_logged_in_user_entity();
$logout_url = $site_url . "action/logout";
$final_logout = elgg_add_action_tokens_to_url($logout_url);
$element_coordinacion = "";
if (elgg_is_rol_logged_user("coordinador")) {
    $element_coordinacion = "<li><a href='{$site_url}convocatorias' target='_blank'>Coordinacion</a></li>";
}
if (elgg_is_rol_logged_user("asesor")) {
    $element_coordinacion.= "<li><a href='{$site_url}asesores/listado_convocatorias' target='_blank'>Asesor</a></li>";
}
if (elgg_is_rol_logged_user("evaluador")) {
    $element_coordinacion.= "<li><a href='{$site_url}evaluadores/listar_convocatorias_evaluador' target='_blank'>Evaluador</a></li>";
}
?>

<div class="banner">
    <div class="logo-ondas">

    </div>
    <div class="banner-ondas">

    </div>
    <div class="infos">
        <div class="buscar">
            <input type="text" placeholder="Ingresa aqui tu busqueda"/>
        </div>
        <div class="info-user">
            <a href="<?php echo $site_url . "profile/{$user->username}" ?>"><?php echo $user->name . " " . $user->apellidos; ?></a>
            <img src="<?php echo $user->getIconURL("small"); ?>"/>
            <div id="menu" onclick="verMenu()">
                <div id="menuint">
                    <ul>
                        <?php echo $element_coordinacion; ?>
                        <li><a href="<?php echo $site_url . "mensajes"; ?>">Mensajes</a></li>
                        <li><a href="<?php echo $final_logout; ?>">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<nav class="menu-principal ">
    <ul>
       <li><a href="<?php echo $url_convocatorias; ?>">Mis Convocatorias</a></li>
        <li><a href="<?php echo $url_feria; ?>">Mis Ferias</a></li>
        <li><a href="<?php echo $url_hoja_vida; ?>">Mi Hoja de Vida</a></li>
    </ul>
</nav>