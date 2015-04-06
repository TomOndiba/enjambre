<?php
/**
 * Elgg pageshell
 * The standard HTML page shell that everything else fits into
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['derecha']       Seccion derecha de la pagina (menu)
 * @uses $vars['izquierda']        Seccion Izquierda de la Pagina (Contenido)
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
if (!elgg_get_logged_in_user_guid()) {
    elgg_load_css('logged');
    echo elgg_view("usuarios/login_2", null, $vars);
    return true;
}

// render content before head so that JavaScript and CSS can be loaded. See #4032

$vars['list'] = 1;
$header = elgg_view('page/elements/logged/header', $vars);
$body = elgg_view('page/elements/lista/body', $vars);
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));
// Set the content type
elgg_load_js("investigaciones");
elgg_unregister_css('inicio');
header("Content-type: text/html; charset=UTF-8");
$lang = get_current_language();
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
    <head>
        <?php echo elgg_view('page/elements/logged/head', $vars);
        ?>
    </head>
    <body>
        <?php echo $vars['body']['content'];?>
        <div class="elgg-page-messages">
            <?php echo $messages; ?>
            <?php echo $notices_html; ?>
        </div>     

        <footer>
            <?php echo elgg_view('page/elements/footer_chat', array()); ?>
        </footer>
    </body> 
</html>
