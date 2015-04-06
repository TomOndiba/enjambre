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

// render content before head so that JavaScript and CSS can be loaded. See #4032
if (!elgg_is_rol_logged_user("coordinador")) {
    $site_url = elgg_get_site_url();
    forward($site_url);
}
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));
$header = elgg_view('page/elements/coordinacion/header', $vars);
$body = elgg_view('page/elements/coordinacion/body', $vars);
// Set the content type
elgg_unregister_css('inicio');
header("Content-type: text/html; charset=UTF-8");
$lang = get_current_language();
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
            <div class="header">
                <?php echo $header; ?>
            </div>
            <div class="contenido">
                <?php echo $body; ?>
            </div>
        </div>
        <footer>
            <?php echo elgg_view('page/elements/footer_chat', array()); ?>
        </footer>
    </body>

</html>
