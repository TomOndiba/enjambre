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
if (!elgg_get_logged_in_user_guid()) {
    elgg_load_css('logged');
    echo elgg_view("usuarios/login_2", null, $vars);
    return true;
}
// render content before head so that JavaScript and CSS can be loaded. See #4032
$topbar = elgg_view('page/elements/topbar', $vars);
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));
$vars['list'] = 1;
$header = elgg_view('page/elements/logged/header', $vars);
$body = elgg_view('page/elements/lista/body', $vars);
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));
// Set the content type
elgg_unregister_css('inicio');
$footer = elgg_view('page/elements/footer', $vars);
elgg_load_css("inicio");
// Set the content type
header("Content-type: text/html; charset=UTF-8");
$form_login = elgg_view("usuarios/login", null, $vars);
$lang = get_current_language();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang; ?>" lang="<?php echo $lang; ?>">
    
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
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
