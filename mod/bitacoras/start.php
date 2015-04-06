<?php

/**
 * Start que controla el plugin bitacoras
 * @author DIEGOX_CORTEX
 */
elgg_register_event_handler('init', 'system', 'bitacoras_init');

/**
 * Initialize the pages plugin.
 *
 */
function bitacoras_init() {

    // register a library of helper functions
    elgg_register_library('bitacoras', elgg_get_plugins_path() . 'bitacoras/lib/bitacoras.php');
    elgg_load_library('bitacoras');

    $item = new ElggMenuItem('bitacoras', elgg_echo('Bitacoras'), 'bitacoras/all');
    elgg_register_menu_item('site', $item);

    // Register a page handler, so we can have nice URLs
    elgg_register_page_handler('bitacoras', 'bitacoras_page_handler');

    // Register a url handler
    elgg_register_entity_url_handler('object', 'bitacora_top', 'bitacoras_url');
    elgg_register_entity_url_handler('object', 'bitacoras', 'bitacoras_url');
    elgg_register_annotation_url_handler('bitacoras', 'bitacoras_revision_url');

    // Register some actions
    $action_base = elgg_get_plugins_path() . 'bitacoras/actions';
    elgg_register_action("bitacoras/edit", "$action_base/bitacoras/edit.php", "logged_in");
    elgg_register_action("bitacoras/delete", "$action_base/bitacoras/delete.php", "logged_in");
    elgg_register_action("annotations/bitacora/delete", "$action_base/annotations/bitacora/delete.php", "logged_in");
    elgg_register_action("bitacoras/print", "$action_base/bitacoras/print.php", "logged_in");
    elgg_register_action("bitacoras/bitacora4/admin_cronograma", "$action_base/bitacoras/bitacora4/save_actividad.php", "logged_in");
    elgg_register_action("bitacoras/bitacora4/bitacora4", "$action_base/bitacoras/bitacora4/save_bitacora4.php", "logged_in");
    elgg_register_action("bitacoras/bitacora6/bitacora6", "$action_base/bitacoras/bitacora6/save_bitacora6.php", "logged_in");
    elgg_register_action("bitacoras/bitacora6/bitacora6_1", "$action_base/bitacoras/bitacora6/save_bitacora6_1.php", "logged_in");
    elgg_register_action("bitacoras/bitacora6/bitacora6_2", "$action_base/bitacoras/bitacora6/save_bitacora6_2.php", "logged_in");
    elgg_register_action("bitacoras/bitacora4/delete_actividad", "$action_base/bitacoras/bitacora4/delete_actividad.php", "logged_in");
    elgg_register_action("bitacoras/bitacora5/bitacora5", "$action_base/bitacoras/bitacora5/save_bitacora5.php", "logged_in");
    elgg_register_action("bitacoras/bitacora5_1/bitacora5_1", "$action_base/bitacoras/bitacora5_1/save_bitacora5_1.php", "logged_in");
    elgg_register_action("bitacoras/bitacora5_1/delete_rubro", "$action_base/bitacoras/bitacora5_1/delete_rubro.php", "logged_in");
    elgg_register_action("bitacoras/bitacora5_2/bitacora5_2", "$action_base/bitacoras/bitacora5_2/save_bitacora5_2.php", "logged_in");
    elgg_register_action("bitacoras/bitacora5_2/delete_rubro52", "$action_base/bitacoras/bitacora5_2/delete_rubro52.php", "logged_in");
    elgg_register_action("bitacoras/bitacora7/bitacora7", "$action_base/bitacoras/bitacora7/save_bitacora7.php", "logged_in");
    elgg_register_action("bitacoras/bitacora8/bitacora8", "$action_base/bitacoras/bitacora8/save_bitacora8.php", "logged_in");
    elgg_register_action("bitacoras/bitacora9/bitacora9", "$action_base/bitacoras/bitacora9/save_bitacora9.php", "logged_in");

    // Extend the main css view
    elgg_extend_view('css/elgg', 'bitacoras/css');
    $js_url_print = 'mod/bitacoras/vendors/print.js';
    elgg_register_js("imprimir", $js_url_print);
    // Register javascript needed for sidebar menu
    $js_url = 'mod/bitacoras/vendors/jquery-treeview/jquery.treeview.min.js';
    elgg_register_js('jquery-treeview', $js_url);

    // Register javascript needed for sidebar menu
    $js_url1 = 'mod/bitacoras/vendors/menu_bitacora.js';
    elgg_register_js('menu_bitacora', $js_url1, 'head');

    $css_url = 'mod/bitacoras/vendors/jquery-treeview/jquery.treeview.css';
    elgg_register_css('jquery-treeview', $css_url);
    
    elgg_register_ajax_view("bitacoras/bitacora5/bitacora5");

    elgg_register_ajax_view("bitacoras/bitacora5/crear_item_bit5");
    elgg_register_ajax_view("bitacoras/bitacora5/guardar_item_bit5");
    elgg_register_ajax_view("bitacoras/bitacora5/eliminar_item_bit5");

    elgg_register_ajax_view("bitacoras/bitacora5_1/bitacora5_1");
    elgg_register_ajax_view("bitacoras/bitacora5_1/crear_rubro");
    elgg_register_ajax_view("bitacoras/bitacora5_1/guardar_rubro");
    
    elgg_register_ajax_view("bitacoras/bitacora5_2/crear_rubro");    
    elgg_register_ajax_view("bitacoras/bitacora5_2/guardar_rubro");
    elgg_register_ajax_view("bitacoras/bitacora5_2/eliminar_rubro");
    elgg_register_ajax_view("bitacoras/bitacora4/crear_actividad");
    elgg_register_ajax_view("bitacoras/bitacora4/guardar_actividad");
    elgg_register_ajax_view("bitacoras/bitacora4/actividad_bit4");
    elgg_register_ajax_view("bitacoras/bitacora5_1/rubro_bit5_1");
    elgg_register_ajax_view("bitacoras/bitacora5_2/rubro_bit5_2");
    elgg_register_ajax_view("bitacoras/edit");
    elgg_register_ajax_view("bitacoras/history");
    elgg_register_ajax_view("bitacoras/ver_anotacion_historial");


//        elgg_register_ajax_view('bitacoras/buscar_integrantes');
//        elgg_register_ajax_view('bitacoras/listar_integrantes');
    // Register entity type for search
    elgg_register_entity_type('object', 'bitacora');
    elgg_register_entity_type('object', 'bitacora_top');

    // Register granular notification for this type
    register_notification_object('object', 'bitacora', elgg_echo('pages:new'));
    register_notification_object('object', 'bitacora_top', elgg_echo('pages:new'));
    elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'bitacora_notify_message');

    // add to groups
    add_group_tool_option('bitacoras', elgg_echo('groups:enablepages'), true);
    //elgg_extend_view('groups/tool_latest', 'bitacoras/group_module');
    //add a widget
    elgg_register_widget_type('bitacoras', elgg_echo('bitacoras'), elgg_echo('pages:widget:description'));

    // Language short codes must be of the form "pages:key"
    // where key is the array key below
    //Preparar la configuración de los datos para la bitacora No. 1
    elgg_set_config('bitacoras', array(
        'title0' => 'hidden',
        'institucion' => 'text',
        'departamento' => 'text',
        'municipio' => 'text',
        'direccion' => 'text',
        'telefono' => 'text',
        'email' => 'text',
        'nombre_grupo' => 'text',
        'descripcion' => 'longtext',
        'motivos' => 'longtext',
        'asesor_linea' => 'text',
        'informacion' => 'label',
    ));


    //Preparar la configuración de los datos para la bitacora No. 2
    elgg_set_config('bitacoras2', array(
        'title1' => 'hidden',
        'pregunta1' => 'text',
        'pregunta2' => 'text',
        'pregunta3' => 'text',
        'pregunta4' => 'text',
        'pregunta5' => 'text',
        'pregunta_seleccionada' => 'longtext',
        'pregunta_nueva' => 'longtext',
        'sintesis_informacion' => 'longtext',
        'resumen' => 'longtext',
    ));

    //Preparar la configuración de los datos para la bitacora No. 3
    elgg_set_config('bitacoras3', array(
        'title2' => 'hidden',
        'descripcion_problema' => 'longtext',
        'importancia_problema' => 'longtext',
        'elementos_significativos' => 'longtext',
    ));

    //Preparar la configuración de los datos para la bitacora No. 4
    elgg_set_config('bitacoras4', array(
//        'title3' => 'hidden',
//        'inicio' => '',
//        'indagacion' => '',
//        'paso' => '',
//        'dificultades' => 'longtext',
//        'fortalezas' => 'longtext',
//        'caracteristicas' => 'longtext',
//        'importancia' => 'longtext',
//        'preguntas' => 'longtext',
    ));

    //Preparar la configuración de los datos para la bitacora No. 4
    elgg_set_config('bitacoras5', array(
//        'title4' => 'hidden',
//        //Segmento 1
//        'segmento1' => 'hidden',
//        'total_insumo' => 'text',
//        'porcentaje_insumo' => 'text',
//        'total_papeleria' => 'text',
//        'porcentaje_papeleria' => 'text',
//        'total_transporte' => 'text',
//        'porcentaje_transporte' => 'text',
//        'total_internet' => 'text',
//        'porcentaje_internet' => 'text',
//        'total_materiales' => 'text',
//        'porcentaje_materiales' => 'text',
//        'total_refrigerios' => 'text',
//        'porcentaje_refrigerios' => 'text',
//        //'subtotal_semento1' => 'hidden',
//        //Segmento 2
//        'segmento2' => 'hidden',
//        'total_insumo_2' => 'text',
//        'porcentaje_insumo_2' => 'text',
//        'total_papeleria_2' => 'text',
//        'porcentaje_papeleria_2' => 'text',
//        'total_transporte_2' => 'text',
//        'porcentaje_transporte_2' => 'text',
//        'total_internet_2' => 'text',
//        'porcentaje_internet_2' => 'text',
//        'total_materiales_2' => 'text',
//        'porcentaje_materiales_2' => 'text',
//        'total_refrigerios_2' => 'text',
//        'porcentaje_refrigerios_2' => 'text',
//        //'subtotal_semento2' => 'hidden',
//        //Segmento 3
//        'segmento3' => 'hidden',
//        'total_insumo_3' => 'text',
//        'porcentaje_insumo_3' => 'text',
//        'total_papeleria_3' => 'text',
//        'porcentaje_papeleria_3' => 'text',
//        'total_transporte_3' => 'text',
//        'porcentaje_transporte_3' => 'text',
//        'total_internet_3' => 'text',
//        'porcentaje_internet_3' => 'text',
//        'total_materiales_3' => 'text',
//        'porcentaje_materiales_3' => 'text',
//        'total_refrigerios_3' => 'text',
//        'porcentaje_refrigerios_3' => 'text',
//            //'subtotal_semento3' => 'hidden',
    ));

    //Preparar la configuración de los datos para la bitacora No. 6
    elgg_set_config('bitacoras6', array(
        'title5' => 'hidden',
        'retomar_trayectoria' => '',
        'organizar_archivo' => '',
        'recoleccion_informacion' => '',
        'estado_del_arte' => '',
        'tecnicas_e_instrumentos' => '',
        'describir_dificultades' => 'longtext',
        'describir_fortalezas' => 'longtext',
        'despues_de_trayectoria' => 'longtext',
        'acciones_del_recorrido' => 'longtext',
        'luz_de_las_etapas' => 'longtext',
        'mencione_los_logros' => 'longtext',
    ));

    //Preparar la configuración de los datos para la bitacora No. 6.1
    elgg_set_config('bitacoras6.1', array(
        'title6' => 'hidden',
        'archivo_y_asignar' => 'longtext',
        'resultados_de_las_tecnicas' => 'longtext',
        'resultados_salida' => 'longtext',
        'organización_adecuada' => 'longtext',
        'actividades_no_propuestas' => 'longtext',
    ));

    //Preparar la configuración de los datos para la bitacora No. 6.2
    elgg_set_config('bitacoras6.2', array(
        'title7' => 'hidden',
        'describir_las_dificultades' => 'longtext',
        'describir_las_fortalezas' => 'longtext',
        'despues_de_desarrollar' => 'longtext',
        'etapas_de_investigación' => 'longtext',
        'mencione_logros' => 'longtext',
    ));



    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'bitacoras_owner_block_menu');

    // write permission plugin hooks
    elgg_register_plugin_hook_handler('permissions_check', 'object', 'bitacoras_write_permission_check');
    elgg_register_plugin_hook_handler('container_permissions_check', 'object', 'bitacoras_container_permission_check');

    // icon url override
    elgg_register_plugin_hook_handler('entity:icon:url', 'object', 'bitacoras_icon_url_override');

    // entity menu
    elgg_register_plugin_hook_handler('register', 'menu:entity', 'bitacoras_entity_menu_setup');

    // hook into annotation menu
    elgg_register_plugin_hook_handler('register', 'menu:annotation', 'bitacoras_annotation_menu_setup');

    // register ecml views to parse
    elgg_register_plugin_hook_handler('get_views', 'ecml', 'bitacoras_ecml_views_hook');

    elgg_register_event_handler('upgrade', 'system', 'bitacoras_run_upgrades');
}

/**
 * Dispatcher for pages.
 * URLs take the form of
 *  All pages:        pages/all
 *  User's pages:     pages/owner/<username>
 *  Friends' pages:   pages/friends/<username>
 *  View page:        p ages/view/<guid>/<title>
 *  New page:         pages/add/<guid> (container: user, group, parent)
 *  Edit page:        pages/edit/<guid>
 *  History of page:  pages/history/<guid>
 *  Revision of page: pages/revision/<id>
 *  Group pages:      pages/group/<guid>/all
 *
 * Title is ignored
 *
 * @param array $page
 * @return bool
 */
function bitacoras_page_handler($page) {

    elgg_load_library('elgg:pages');

    if (!isset($page[0])) {
        $page[0] = 'all';
    }

    //elgg_push_breadcrumb(elgg_echo('bitacoras'), 'bitacoras/all');

    $base_dir = elgg_get_plugins_path() . 'bitacoras/pages/bitacoras';

    $page_type = $page[0];
    switch ($page_type) {
        case 'owner':
            include "$base_dir/owner.php";
            break;
        case 'friends':
            include "$base_dir/friends.php";
            break;
        case 'view':
            set_input('guid', $page[1]);
            set_input('guid_cuad', $page[3]);
            include "$base_dir/view.php";
            break;
        case 'add':
            set_input('guid', $page[1]);
            set_input('guid_grupo', $page[2]);
            set_input('guid_cuaderno', $page[3]);
            set_input('bitacora', $page[4]);
            include "$base_dir/new.php";
            break;
        case 'edit':
            set_input('guid', $page[1]);
            include "$base_dir/edit.php";
            break;
        case 'group':
            include "$base_dir/owner.php";
            break;
        case 'history':
            set_input('guid', $page[1]);
            include "$base_dir/history.php";
            break;
        case 'revision':
            set_input('id', $page[1]);
            include "$base_dir/revision.php";
            break;
        case 'all':
            include "$base_dir/world.php";
            break;
        case 'bitacora4':
            set_input('id_inv', $page[1]);
            set_input('id_group', $page[2]);
            set_input('bit', $page[3]);
            require "$base_dir/bitacora4/bitacora4.php";
            break;
        case 'admin_cronograma_bit4':
            set_input('id_inv', $page[1]);
            set_input('id_group', $page[2]);
            set_input('bit', $page[3]);
            require "$base_dir/bitacora4/admin_cronograma.php";
            break;
        case 'bitacora5':
            set_input('id_inv', $page[1]);
            set_input('id_group', $page[2]);
            set_input('bit', $page[3]);
            require "$base_dir/bitacora5/bitacora5.php";
            break;
        case 'bitacora5_1':
            set_input('id_inv', $page[1]);
            set_input('id_group', $page[2]);
            set_input('bit', $page[3]);
            require "$base_dir/bitacora5_1/bitacora5_1.php";
            break;
        case 'bitacora5_2':
            set_input('id_inv', $page[1]);
            set_input('id_group', $page[2]);
            set_input('bit', $page[3]);
            require "$base_dir/bitacora5_2/bitacora5_2.php";
            break;
        case 'bitacora7':
            set_input('id_inv', $page[1]);
            set_input('id_group', $page[2]);
            require "$base_dir/bitacora7/bitacora7.php";
            break;
        case 'bitacora8':
            set_input('id_inv', $page[1]);
            set_input('id_group', $page[2]);
            require "$base_dir/bitacora8/bitacora8.php";
            break;
        case 'bitacora9':
            set_input('id_inv', $page[1]);
            set_input('id_group', $page[2]);
            require "$base_dir/bitacora9/bitacora9.php";
            break;

        default:
            return false;
    }
    return true;
}

/**
 * Override the page url
 * 
 * @param ElggObject $entity Page object
 * @return string
 */
function bitacoras_url($entity) {
    $title = elgg_get_friendly_title($entity->title);
    $cuad = elgg_get_relationship_inversa($entity, 'tiene_la_bitacora');
    $guid_cuaderno = $cuad[0]->guid;
    return "bitacoras/view/$entity->guid/$title/$guid_cuaderno";
}

/**
 * Override the page annotation url
 *
 * @param ElggAnnotation $annotation
 * @return string
 */
function bitacoras_revision_url($annotation) {
    return "bitacoras/revision/$annotation->id";
}

/**
 * Override the default entity icon for pages
 *
 * @return string Relative URL
 */
function bitacoras_icon_url_override($hook, $type, $returnvalue, $params) {
    $entity = $params['entity'];
    if (elgg_instanceof($entity, 'object', 'bitacora_top') ||
            elgg_instanceof($entity, 'object', 'bitacora')) {
        switch ($params['size']) {
            case 'topbar':
            case 'tiny':
            case 'small':
                return 'mod/bitacoras/images/pages.gif';
                break;
            default:
                return 'mod/bitacoras/images/pages_lrg.gif';
                break;
        }
    }
}

/**
 * Add a menu item to the user ownerblock
 */
function bitacoras_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        $url = "bitacoras/owner/{$params['entity']->username}";
        $item = new ElggMenuItem('bitacoras', elgg_echo('pages'), $url);
        $return[] = $item;
    } else {
        if ($params['entity']->pages_enable != "no") {
            $url = "bitacoras/group/{$params['entity']->guid}/all";
            $item = new ElggMenuItem('bitacoras', elgg_echo('pages:group'), $url);
            $return[] = $item;
        }
    }

    return $return;
}

/**
 * Add links/info to entity menu particular to pages plugin
 */
function bitacoras_entity_menu_setup($hook, $type, $return, $params) {
    if (elgg_in_context('widgets')) {
        return $return;
    }

    $entity = $params['entity'];
    $handler = elgg_extract('handler', $params, false);
    if ($handler != 'bitacoras') {
        return $return;
    }

    //remove delete if not owner or admin
    //if (!elgg_is_admin_logged_in() && elgg_get_logged_in_user_guid() != $entity->getOwnerGuid()) {
    foreach ($return as $index => $item) {
        if ($item->getName() == 'delete') {
            unset($return[$index]);
        }
    }
    // }

    $options = array(
        'name' => 'history',
        'text' => elgg_echo('pages:history'),
        'href' => "bitacoras/history/$entity->guid",
        'priority' => 150,
    );
    $return[] = ElggMenuItem::factory($options);

    return $return;
}

/**
 * Returns a more meaningful message
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function bitacora_notify_message($hook, $entity_type, $returnvalue, $params) {
    $entity = $params['entity'];
    $to_entity = $params['to_entity'];
    $method = $params['method'];

    if (elgg_instanceof($entity, 'object', 'bitacora') || elgg_instanceof($entity, 'object', 'bitacora_top')) {
        $descr = $entity->description;
        $title = $entity->title;
        $owner = $entity->getOwnerEntity();

        return elgg_echo('pages:notification', array(
            $owner->name,
            $title,
            $descr,
            $entity->getURL()
        ));
    }
    return null;
}

/**
 * Extend permissions checking to extend can-edit for write users.
 *
 * @param string $hook
 * @param string $entity_type
 * @param bool   $returnvalue
 * @param array  $params
 */
function bitacoras_write_permission_check($hook, $entity_type, $returnvalue, $params) {
    if ($params['entity']->getSubtype() == 'bitacora' || $params['entity']->getSubtype() == 'bitacora_top') {

        $write_permission = $params['entity']->write_access_id;
        $user = $params['user'];

        if ($write_permission && $user) {
            switch ($write_permission) {
                case ACCESS_PRIVATE:
                    // Elgg's default decision is what we want
                    return;
                    break;
                case ACCESS_FRIENDS:
                    $owner = $params['entity']->getOwnerEntity();
                    if ($owner && $owner->isFriendsWith($user->guid)) {
                        return true;
                    }
                    break;
                default:
                    $list = get_access_array($user->guid);
                    if (in_array($write_permission, $list)) {
                        // user in the access collection
                        return true;
                    }
                    break;
            }
        }
    }
}

/**
 * Extend container permissions checking to extend can_write_to_container for write users.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function bitacoras_container_permission_check($hook, $entity_type, $returnvalue, $params) {

    if (elgg_get_context() == "bitacoras") {
        if (elgg_get_page_owner_guid()) {
            if (can_write_to_container(elgg_get_logged_in_user_guid(), elgg_get_page_owner_guid()))
                return true;
        }
        if ($page_guid = get_input('page_guid', 0)) {
            $entity = get_entity($page_guid);
        } else if ($parent_guid = get_input('parent_guid', 0)) {
            $entity = get_entity($parent_guid);
        }
        if ($entity instanceof ElggObject) {
            if (
                    can_write_to_container(elgg_get_logged_in_user_guid(), $entity->container_guid) || in_array($entity->write_access_id, get_access_list())
            ) {
                return true;
            }
        }
    }
}

/**
 * Return views to parse for pages.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $return_value
 * @param unknown_type $params
 */
function bitacoras_ecml_views_hook($hook, $entity_type, $return_value, $params) {
    $return_value['object/bitacora'] = elgg_echo('item:object:page');
    $return_value['object/bitacora_top'] = elgg_echo('item:object:page_top');

    return $return_value;
}
