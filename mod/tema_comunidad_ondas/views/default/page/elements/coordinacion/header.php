<?php
$site_url = elgg_get_site_url();
if ($vars["list"]) {
    $class = "total";
}
$class = "total";
$user = elgg_get_logged_in_user_entity();
$logout_url = $site_url . "action/logout";
$final_logout = elgg_add_action_tokens_to_url($logout_url);
$element_coordinacion = "";
$url_convocatorias = $site_url . "convocatorias";
$url_lineas = $site_url . "linea";
$url_feria = $site_url . "ferias";
$url_evaluadores = $site_url . "evaluadores";
$url_asesores = $site_url . "asesores";
$url_administracion = $site_url . "convocatorias/administracion";
$url_reportes = $site_url . "reporte";

$url = elgg_get_site_url();
$url_buscar = $url . "busqueda/usuario";
$mensajes_usuario = elgg_get_mensajes_usuario();
$div_msj = '<div class="row notificacion-mensaje" id="mensajes">' . $mensajes_usuario . '</div>';
$notificaciones = elgg_get_total_notificaciones();
$notificaciones_div = '<div class="row notificaciones" id="notificaciones-not">' . $notificaciones . '</div>';
$view = elgg_get_site_url() . "ajax/view/info/notificaciones";
$nombre = explode(" ", $user->name)[0];
$nombre.= " " . explode(" ", $user->apellidos)[0];

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
    <div class="logo-ondas" onclick="location.href = '<?php echo elgg_get_site_url(); ?>'">

    </div>
    <div class="banner-ondas" onclick="location.href = '<?php echo elgg_get_site_url(); ?>'">

    </div>
    <div class="infos">
        <div class="buscar">
            <input class='busqueda' type="text" placeholder="Ingresa aqui tu busqueda"/>
            <input id='url_buscar' type="hidden" value="<?php echo $url_buscar ?>"/>
        </div>

        <div class="info-user">
            <a href="<?php echo $site_url . "profile/{$user->username}" ?>"><?php echo $nombre; ?></a>
            <img src="<?php echo $user->getIconURL("small"); ?>"/>
            <div id="menu" onclick="verMenu()">
                <div id="menuint">
                    <ul>
                        <?php echo $element_coordinacion; ?>
                        <li><a href="<?php echo $site_url . "faqs/ver"; ?>">Preguntas Frecuentes</a></li>
                        <li><a href="<?php echo $final_logout; ?>">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="info-mensajes">
            <a data-tooltip='Ver Mensajes' href="<?php echo $site_url . "mensajes"; ?>" id='notificacion-mensajes'><div class="icon-mensajes row"></div><?php echo $div_msj ?></a>
        </div>
        <div class="info-notificaciones">
            <a tooltip-view='<?php echo $view ?>' id='notificaciones'><div class="icon-notificacion row"></div><?php echo $notificaciones_div ?></a>
        </div>
    </div>
</div>

<nav class="menu-principal ">
    <ul>
        <li><a href="<?php echo $url_convocatorias; ?>">Convocatorias</a></li>
        <li><a href="<?php echo $url_feria; ?>">Ferias</a></li>
        <li><a href="<?php echo $url_evaluadores; ?>">Banco de Evaluadores</a></li>
        <li><a href="<?php echo $url_asesores; ?>">Banco de Asesores</a></li>
        <li><a href="<?php echo $url_lineas; ?>">Lineas Tematicas</a></li>
        <li><a href="<?php echo $url_administracion; ?>">Administración</a></li>
        <li><a href="<?php echo $url_reportes; ?>">Reportes</a></li>
    </ul>
</nav>
<script>
    window.onload = hacerAlgo();
    function hacerAlgo() {
        actualizarNotificaciones();
        setTimeout('hacerAlgo()', 10000);
    }
    function actualizarNotificaciones() {
        elgg.get('ajax/view/info/mensajes', {
            timeout: 30000,
            success: function(result, success, xhr) {
                var datos = JSON.parse(result);
                var mensajes = datos.mensajes;
                var notificaciones = datos.notificaciones;
                if (mensajes > 0) {
                    $("#mensajes").css('display', 'inline-block');
                    $("#mensajes").html(mensajes);
                } else {
                    $("#mensajes").css('display', 'none');
                }
                if (notificaciones > 0) {
                    $("#notificaciones-not").css('display', 'inline-block');
                    $("#notificaciones-not").html(notificaciones);
                } else {
                    $("#notificaciones-not").css('display', 'none');
                }
            },
        });
    }
    imprimirLoader = function() {
        return '<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>';
    }
</script>