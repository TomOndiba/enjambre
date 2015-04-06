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
        <?php echo elgg_view('page/elements/head_inicio', $vars);
        ?>
    </head>
    <body>
        <script>
            $(document).ready(function() {
                $('.bxslider').bxSlider();
            });

        </script>
        <div class="elgg-page-messages">
            <?php echo $messages; ?>
            <?php echo $notices_html; ?>
        </div>
        <div class="todo">
            <div class="left-inicio">
                <div class="header-inicio">
                    <div class="banner-titulo">
                        <div class="logo"></div>
                        <div class="titulo"></div>
                    </div>
                    <div class="header-menu">
                        <nav>
                            <ul>
                                <li onclick="location.href = '<?php echo $site_url ?>'" class="fc-rojo">Inicio</li>
                                <li onclick="location.href = '<?php echo $site_url . "instituciones" ?>'" class="fc-azul">Instituciones</li>
                                <li onclick="location.href = '<?php echo $site_url . "redes_tematicas" ?>'" class="fc-purpura">Redes Temáticas<li>
                                        <li onclick="location.href = '<?php echo $site_url . "grupo_investigacion" ?>'" class="fc-verde">Grupos de Investigación</li>
                                        </ul>
                                        </nav>
                                        </div>
                                        </div>
                                        <div class="contenido">
                                            <div class="slider">
                                                <ul class="bxslider">
                                                    <li><img src="http://104.131.19.127/imagenes/demo/col.jpg" style="width:100%; height: 100%;"/></li>
                                                    <li><img src="http://104.131.19.127/imagenes/demo/col2.jpg" style="width:100%; height: 100%;" /></li>
                                                    <li><img src="http://104.131.19.127/imagenes/demo/col3.jpg" style="width:100%; height: 100%;"/></li>
                                                    <li><img src="http://104.131.19.127/imagenes/demo/familia.jpg" style="width:100%; height: 100%;"/></li>
                                                </ul>
                                            </div>
                                            <div class="triangulo"></div>
                                            <div class="triangulo2"></div>
                                        </div>
                                        <div class="pie">
                                            <nav>
                                                <ul class="nav-footer">
                                                    <li></li>
                                                    <li></li>
                                                    <li></li>
                                                    <li></li>
                                                    <li></li>
                                                </ul>
                                            </nav>
                                        </div>
                                        </div>
                                        <div class="right-inicio">
                                            <div class="search">

                                            </div>
                                            <div class="panel">
                                                <div class="entrar" data-reveal-id="myModal"></div>
                                                <div class="girl"></div>
                                                <div class="box-item">
                                                    <div class="titulo-box-item bd-radius-white">
                                                        <h2>Grupos</h2>
                                                    </div>
                                                    <div class="contenido-box-item bd-radius-white">
                                                        <ul class="galeria-imagenes">
                                                            <?php echo $grupos; ?>                            
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="box-item">
                                                    <div class="titulo-box-item bd-radius-white">
                                                        <h2>Investigadores</h2>
                                                    </div>
                                                    <div class="contenido-box-item bd-radius-white">
                                                        <ul class="galeria-imagenes">
                                                            <?php echo $usuarios; ?>               
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                        <div id="myModal" class="reveal-modal">
                                            <div class="login">
                                                <?php echo $form_login; ?>
                                            </div>
                                        </div>
                                        <footer>
                                            <?php echo elgg_view('page/elements/footer_chat', array()); ?>
                                        </footer>
                                        </body>

                                        </html>
