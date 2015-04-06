<!DOCTYPE html>
<html>
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
$img_url = $site_url . "imagenes/";
?>
    <head>
        <?php echo elgg_view('page/elements/head_inicio', $vars);
        ?>
    </head>
    <body>
        <style>
            .pagination-item{
                cursor: pointer;
            }
        </style>
        <div class="elgg-page-messages">                                                                                                                                     
            <?php //echo $messages; ?>
            <?php //cho $notices_html; ?>
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
                                <li onclick="location.href = '<?php echo $site_url ?>revistas'" class="fc-verde">Periódicos</li>
                                <li onclick="location.href = '<?php echo $site_url ?>faqs/preguntas'" class="fc-azul">Preguntas Frecuentes</li>
                                <li onclick="location.href = '<?php echo $site_url ?>contenidos'" class="fc-azul">Contenidos Digitales</li>
                                <li onclick="location.href = '<?php echo $site_url ?>contenidos/tutoriales'" class="fc-azul">Tutoriales</li>
                            
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="contenido">
                <div style="">
                <?php echo elgg_view('contenidos/index_2')?>
                </div>
                </div>
                <div style="background-color: white; width: 100%; height: 90px; text-align: center">
                    <ul class="icons-footer">
                        <li><img src="http://104.131.19.127/imagenes/logo_gob.png" /></li>
                        <li><img src="http://104.131.19.127/imagenes/logo_ufps.png"/></li>
                        <li><img src="http://104.131.19.127/imagenes/logo_cun.png"/></li>
                    </ul>                    
                </div>
            </div>
            <div class="right-inicio">
                <div class="search">

                </div>
                <div class="panel">
                    <div class="entrar" data-reveal-id="myModal">
                        
                    </div>
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
        </footer>
    </body>

</html>
