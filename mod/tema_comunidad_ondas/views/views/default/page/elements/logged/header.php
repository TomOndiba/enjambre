<?php
elgg_load_js('busqueda_gral');
$site_url = elgg_get_site_url();
if ($vars["list"]) {
    $class = "total";
}
$class = "total";
$user = elgg_get_logged_in_user_entity();
$logout_url = $site_url . "action/logout";
$final_logout = elgg_add_action_tokens_to_url($logout_url);
$element_coordinacion = "";
if (elgg_is_rol_logged_user("coordinador")) {
    $element_coordinacion = "<li><a href='{$site_url}convocatorias' target=7+'_blank'>Coordinacion</a></li>";
}
if (elgg_is_rol_logged_user("asesor")) {
    $element_coordinacion.= "<li><a href='{$site_url}asesores/listado_convocatorias' target='_blank'>Asesor</a></li>";
}
if (elgg_is_rol_logged_user("evaluador")) {
    $element_coordinacion.= "<li><a href='{$site_url}evaluadores/listar_convocatorias_evaluador' target='_blank'>Evaluador</a></li>";
}

if (elgg_is_rol_logged_user("SuperAdmin")) {
    $element_coordinacion.= "<li><a href='{$site_url}admin' target='_blank'>Administración</a></li>";
}
$url = elgg_get_site_url();
$url_buscar = $url . "busqueda/usuario";
$mensajes_usuario = elgg_get_mensajes_usuario();
$div_msj = '<div class="row notificacion-mensaje" id="mensajes">' . $mensajes_usuario . '</div>';
$notificaciones = elgg_get_total_notificaciones();
$notificaciones_div = '<div class="row notificaciones" id="notificaciones-not">' . $notificaciones . '</div>';
$view = elgg_get_site_url() . "ajax/view/info/notificaciones";
$nombre = explode(" ", $user->name)[0];
$nombre.= " " . explode(" ", $user->apellidos)[0];
?>
<div class="banner">
    <div class="logo-ondas" onclick="location.href = '<?php echo elgg_get_site_url(); ?>'">

    </div>
    <div class="banner-ondas" onclick="location.href = '<?php echo elgg_get_site_url(); ?>'">

    </div>
    <div class="infos">
        <div class="buscar row">
            <input class='busqueda' type="text" placeholder="Ingresa aqui tu busqueda"/>
            <input id='url_buscar' type="hidden" value="<?php echo $url_buscar ?>"/>
        </div>
        <div class="banner-soporte row">
            <a href="http://soporte.enjambre.co/mibew/client.php?locale=es&amp;style=silver" target="_blank" onclick="if (navigator.userAgent.toLowerCase().indexOf('opera') != - 1 & amp; & amp; window.event.preventDefault) window.event.preventDefault(); this.newWindow = window.open( & #039; http://soporte.enjambre.co/mibew/client.php?locale=es&amp;style=silver&amp;url=&#039;+escape(document.location.href)+&#039;&amp;referrer=&#039;+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><img src="http://soporte.enjambre.co/mibew/b.php?i=mibew&amp;lang=es" border="0" style='width:100%'< alt=""/></a></div>
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
    <ul class="<?php echo $class; ?>">
        <li><a href="<?php echo $site_url . "grupo_investigacion"; ?>">Grupos de Investigación</a></li>
        <li><a href="<?php echo $site_url . "instituciones"; ?>">Instituciones</a></li>
        <li><a href="<?php echo $site_url . "redes_tematicas"; ?>">Redes Temáticas</a></li>
        <li><a href="<?php echo $site_url . "feria"; ?>">Ferias</a></li>
        <li><a href="<?php echo $site_url . "revistas"; ?>">Periódicos</a></li>
        <li><a href="<?php echo $site_url . "soporte"; ?>">Soporte</a></li>
        <li><a href="<?php echo $site_url . "contenidos"; ?>">Contenidos</a></li>
        <li><a href="<?php echo $site_url . "contenidos/tutoriales"; ?>">Tutoriales</a></li>
        <li></li>
    </ul>
</nav>

<script>
    $(document).ready(function() {
        if ($("#notificaciones-not").html() == 0) {
            $("#notificaciones-not").css('display', 'none');
        }
         if ($("#mensajes").html() == 0) {
            $("#mensajes").css('display', 'none');
        }
        ;
    });
//    function hacerAlgo() {
//        actualizarNotificaciones();
//        setTimeout('hacerAlgo()', 10000);
//    }
//    function actualizarNotificaciones() {
//        elgg.get('ajax/view/info/mensajes', {
//            timeout: 30000,
//            success: function(result, success, xhr) {
//                var datos = JSON.parse(result);
//                var mensajes = datos.mensajes;
//                var notificaciones = datos.notificaciones;
//                if (mensajes > 0) {
//                    $("#mensajes").css('display', 'inline-block');
//                    $("#mensajes").html(mensajes);
//                    
//                } else {
//                    $("#mensajes").css('display', 'none');
//                }
//                if (notificaciones > 0) {
//                    $("#notificaciones-not").css('display', 'inline-block');
//                    $("#notificaciones-not").html(notificaciones);
//                } else {
//                    $("#notificaciones-not").css('display', 'none');
//                }
//            },
//        });
//    }
    imprimirLoader = function() {
        return '<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>';
    }
</script>