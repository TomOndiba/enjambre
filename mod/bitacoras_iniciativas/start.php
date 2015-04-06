<?php
/**
 * Iniciativas
 *
 * @package iniciativas
 */

elgg_register_event_handler('init', 'system', 'bitacoras_iniciativas_init');

/**
 * Bookmark init
 */
function bitacoras_iniciativas_init(){
    
    # Ruta de los actions de bitacoras
    $action_path = elgg_get_plugins_path()."bitacoras_iniciativas/actions/bitacoras_iniciativas";
    $action_path_conv = elgg_get_plugins_path()."bitacoras_iniciativas/actions/convocatoria";
    
    
    #Registro de JS con el HTML Text Editor
    elgg_register_js('tinymce','mod/bitacoras_iniciativas/vendors/tinymce/js/tinymce/tinymce.min.js');
    
    #Registro de action para guardar la bitacora uno, dos y tres
    elgg_register_action('bitacoras/edit/bitacora_uno', "$action_path/editar_bitacora_uno.php", "logged_in");
    elgg_register_action('bitacoras/edit/bitacora_dos', "$action_path/editar_bitacora_dos.php", "logged_in");
    elgg_register_action('bitacoras/edit/bitacora_tres', "$action_path/editar_bitacora_tres.php", "logged_in");
    elgg_register_action('bitacoras/edit/bitacora_tres', "$action_path/editar_bitacora_tres.php", "logged_in");
    
    #Action para el nuevo proceso de inscribir iniciativa a una convocatoria
    elgg_register_action('bitacoras/convocatorias/inscribir', "$action_path_conv/inscribir_bitacora.php", "logged_in");
    
# Action para agregar integrantes
    elgg_register_action('bitacoras/agregar_integrante', "$action_path/agregar_integrante.php", "logged_in");
}