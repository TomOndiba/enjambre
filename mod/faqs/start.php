<?php

/**
 * Start que controla el plugin faqs
 * @author DIEGOX_CORTEX
 */
elgg_register_event_handler('init', 'system', 'faqs_init');

function faqs_init() {
    //Agregar los action's
    $base = elgg_get_plugins_path() . 'faqs/actions/faqs';
    elgg_register_action("faqs/add_faq", "$base/add.php", "logged_in");
    elgg_register_action("faqs/eliminar", "$base/delete.php", "logged_in");
//    elgg_register_action('linea_tematica/eliminar', "$base/delete.php", "logged_in");
//    elgg_register_action('linea_tematica/edit_linea', "$base/edit.php", "logged_in");


    //Agregar las librerias
    $lib = elgg_get_plugins_path() . 'faqs/lib/lib_faqs.php';
    elgg_register_library('preguntas', $lib);
    elgg_load_library('preguntas');

    //Agrega js
    $url = "mod/FAQs/vendors/consultar_preguntas.js";
    elgg_register_js('consultar_preguntas', $url, 'head');
//    
    elgg_register_ajax_view('faqs/ver_preguntas');
    
    
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'faqs_owner_block_menu');

    //enrutador
    elgg_register_page_handler('faqs', 'faqs_page_handler');

    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'faqs_owner_block_menu');
}

function faqs_page_handler($page, $identifier) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'faqs/pages/faqs';
// select page based on first URL segment after /hello/
    switch ($page[0]) {
        case 'add':  
            set_input('id', $page[1]);
            require "$base_path/add.php";
            break; 
        case 'list': 
            set_input("category", $page[1]);
            require "$base_path/list.php";
            break; 
        case 'ver': 
            require "$base_path/ver.php";
            break; 
        case 'preguntas':
            require "$base_path/preguntas.php";
            break;
        default:
            echo "request for $identifier $page[0]";
            break;
    }
// return true to let Elgg know that a page was sent to browser
    return true;
}

/**
 * Add a menu item to the user ownerblock
 */
function faqs_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        $url = elgg_get_site_url() . 'faqs/crear';
        $item = new ElggMenuItem('faqs', elgg_echo('faqs'), $url);
        $return[] = $item;
    } else {
        if ($params['entity']->file_enable != "no") {
            $url = "file/group/{$params['entity']->guid}/all";
            $item = new ElggMenuItem('file', elgg_echo('file:group'), $url);
            $return[] = $item;
        }
    }

    return $return;
}


