<?php
/**
 * Elgg pageshell
 * The standard HTML page shell that everything else fits into
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['title']       The page title
 * @uses $vars['body']        The main content of the page
 * @uses $vars['sysmessages'] A 2d array of various message registers, passed from system_messages()
 */
// backward compatability support for plugins that are not using the new approach
// of routing through admin. See reportedcontent plugin for a simple example.
if (elgg_get_context() == 'admin') {
    if (get_input('handler') != 'admin') {
        elgg_deprecated_notice("admin plugins should route through 'admin'.", 1.8);
    }
    elgg_admin_add_plugin_settings_menu();
    elgg_unregister_css('elgg');
    echo elgg_view('page/admin', $vars);
    return true;
}

// render content before head so that JavaScript and CSS can be loaded. See #4032
$topbar = elgg_view('page/elements/topbar', $vars);
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));
$header = elgg_view('page/elements/header', $vars);
$body = elgg_view('page/elements/body', $vars);
$footer = elgg_view('page/elements/footer', $vars);
$grupos = elgg_view("grupo_investigacion/ultimos_grupos", array());
$usuarios = elgg_view("usuarios/ultimos_usuarios", array());
// Set the content type
header("Content-type: text/html; charset=UTF-8");
$form_login = elgg_view("usuarios/login", array(), array());
$lang = get_current_language();
$site_url = elgg_get_site_url();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang; ?>" lang="<?php echo $lang; ?>">
    <head>
        <?php echo elgg_view('page/elements/logged/head', $vars);
        ?>
    </head>
    <body>
        <div class="elgg-page-messages">
            <?php echo $messages; ?>
            <?php echo $notices_html; ?>
        </div>
        <div class="todo">
            <div class="left-inicio" style="width: 100%;">
                <div class="header-inicio" style="text-align: center;">
                    <div class="banner-titulo">
                        <div class="logo" onclick="location.href = '<?php echo elgg_get_site_url(); ?>'"></div>
                        <div class="titulo" onclick="location.href = '<?php echo elgg_get_site_url(); ?>'"></div>
                    </div>
                    <div class="header-menu">
                        <nav>
                            <ul style="margin-left: 150px;">
                                <li onclick="location.href = '<?php echo $site_url ?>'" class="fc-rojo">Inicio</li>
                                <li onclick="location.href = '<?php echo $site_url ?>revistas'" class="fc-verde">Periódicos</li>
                                <li onclick="location.href = '<?php echo $site_url ?>faqs/preguntas'" class="fc-azul">Preguntas Frecuentes</li>
                                <li onclick="location.href = '<?php echo $site_url ?>contenidos'" class="fc-azul">Contenidos Digitales</li>
                                <li onclick="location.href = '<?php echo $site_url ?>contenidos/tutoriales'" class="fc-azul">Tutoriales</li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="form-registro" style="margin-bottom: 30px;">
                    <?php echo $vars['body']['content'] ?>
                </div>
            </div>
        </div>
        <footer>
            <?php echo elgg_view('page/elements/footer_chat', array()); ?>
        </footer>
        <script>
            imprimirLoader = function () {
                return '<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>';
            };
        </script>
    </body>

</html>
