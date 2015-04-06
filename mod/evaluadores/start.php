<?php

/**
 * Describe plugin here
 */
elgg_register_event_handler('init', 'system', 'evaluadores_init');

function evaluadores_init() {
    $base_dir = elgg_get_plugins_path();

    //registrar el menu
    //@todo falta validar que solo aparezca para el coordinador
    $item = new ElggMenuItem('Inscribirse evaluadores', elgg_echo("inscripcion:evaluador:menubar"), 'evaluadores1');
    elgg_register_menu_item('admin', $item);



    $lib = elgg_get_plugins_path() . 'evaluadores/lib/evaluadores.php';
    elgg_register_library("evaluadores", $lib);
    elgg_load_library('evaluadores');
    //registrar actions
    $base = $base_dir . 'evaluadores/actions/evaluadores';
    $base2 = $base_dir . 'evaluadores/actions/investigacion';
    $base3 = $base_dir . 'evaluadores/actions/formatos_evaluacion_feria';
    elgg_register_action("evaluadores/request", "$base/request.php", "logged_in");
    elgg_register_action('evaluadores/aceptar_evaluador_banco', "$base/aceptar_evaluador_banco.php", "logged_in");
    elgg_register_action('evaluadores/rechazar_evaluador_banco', "$base/rechazar_evaluador_banco.php", "logged_in");
    elgg_register_action('evaluadores/convocar_evaluadores', "$base/convocar_evaluadores.php", "logged_in");
    elgg_register_action('evaluadores/inscripcion_evaluador_convocatoria', "$base/inscripcion_evaluador_convocatoria.php", "logged_in");
    elgg_register_action('evaluadores/aceptar_evaluador', "$base/aceptar_evaluador.php", "logged_in");
    elgg_register_action('evaluadores/aceptar_evaluador_feria', "$base/aceptar_evaluador_feria.php", "logged_in");
    elgg_register_action('investigacion/evaluar_investigacion', "$base2/evaluar_investigacion.php", "logged_in");
    elgg_register_action('evaluadores/convocar_evaluadores_feria', "$base/convocar_evaluadores_feria.php", "logged_in");
    elgg_register_action('evaluadores/inscripcion_evaluador_feria', "$base/inscripcion_evaluador_feria.php", "logged_in");
    elgg_register_action('formatos_evaluacion_feria/formato_eval_informeinv_cuadcampoINN_inv', "$base3/evaluar_informeinv_cuadcampoINN_inv.php", "logged_in");
    elgg_register_action('formatos_evaluacion_feria/formato_eval_informeinv_diariocampoINN', "$base3/evaluar_informeinv_diariocampoINN.php", "logged_in");
    elgg_register_action('formatos_evaluacion_feria/formato_eval_informeinv_diariocampoINN_inv', "$base3/evaluar_informeinv_diariocampoINN_inv.php", "logged_in");
    elgg_register_action('formatos_evaluacion_feria/formato_valoracion_maestro_escrito', "$base3/evaluar_maestro_escrito.php", "logged_in");
    elgg_register_action('formatos_evaluacion_feria/formato_valoracion_maestro_oral', "$base3/evaluar_maestro_oral.php", "logged_in");
    elgg_register_action('formatos_evaluacion_feria/formato_eval_sustentacion_oral_INN', "$base3/evaluar_sustentacion_oral_INN.php", "logged_in");
    elgg_register_action('formatos_evaluacion_feria/formato_eval_sustentacion_oral_INV', "$base3/evaluar_sustentacion_oral_INV.php", "logged_in");
    elgg_register_action($base3, $base2);

    /* $url = elgg_get_site_url() . 'action/inscripcion_evaluador/request'; aceptar_evaluador
      $url_request = elgg_add_action_tokens_to_url($url);
      elgg_register_menu_item('page', array(
      'name' => 'inscripcion_evaluador',
      'text' => 'inscripcion a evaluadores',
      'href' => $url_request,
      //'context' => 'admin',
      )); */
    //borrar el item de grupos del menu
    $item = new ElggMenuItem('groups', elgg_echo('groups'), 'groups/all');
    elgg_unregister_menu_item('topbar', $item);


    elgg_register_ajax_view('investigaciones_feria_asignadas/investigaciones_inicial/ver_investigaciones_inicial');
    elgg_register_ajax_view('investigaciones_feria_asignadas/investigaciones_en_sitio/ver_investigaciones_en_sitio');
//    elgg_register_ajax_view('investigaciones_feria_asignadas/ver_investigaciones');
    elgg_register_ajax_view('investigaciones_feria_asignadas/lista_ferias_mun_evaluador');
    elgg_register_ajax_view('investigaciones_feria_asignadas/lista_ferias_dep_evaluador');

    $url = "mod/evaluadores/vendors/pagination-ajax.js";
    elgg_register_js('pagination/evaluadores', $url, 'head');

    $url = "mod/evaluadores/vendors/pagination-ajax-preinscritos.js";
    elgg_register_js('pagination/evaluadores_preinscritos', $url, 'head');

    $url = "mod/evaluadores/vendors/pag_investigaciones_asignadas.js";
    elgg_register_js('pag_investigaciones_asignadas', $url, 'head');

    $url = "mod/evaluadores/vendors/pag_investigaciones_feria_asignadas.js";
    elgg_register_js('pag_investigaciones_feria_asignadas', $url, 'head');

    $url = "mod/evaluadores/vendors/convocatorias_evaluador.js";
    elgg_register_js('pagination/conv_evaluador', $url, 'head');

    $url = "mod/evaluadores/vendors/sumar.js";
    elgg_register_js('sumar', $url, 'head');

    $url = "mod/evaluadores/vendors/suma_evaluacion_infcuadernocamp.js";
    elgg_register_js('sumar_evalinfcuad', $url, 'head');

    $url = "mod/evaluadores/vendors/sumar_4.1.js";
    elgg_register_js('sumar_4.1', $url, 'head');

    $url = "mod/evaluadores/vendors/sumar_4.2.js";
    elgg_register_js('sumar_4.2', $url, 'head');

    $url = "mod/evaluadores/vendors/sumar2.1.js";
    elgg_register_js('sumar2.1', $url, 'head');

    $url = "mod/evaluadores/vendors/sumar_3_INN.js";
    elgg_register_js('sumar_3_INN', $url, 'head');

    $url = "mod/evaluadores/vendors/sumar_3_INV.js";
    elgg_register_js('sumar_3_INV', $url, 'head');

    $url = "mod/evaluadores/vendors/investigaciones-evaluador-feria.js";
    elgg_register_js('investigaciones-evaluador-feria', $url, 'head');

    $url = "mod/evaluadores/vendors/investigaciones-evaluador.js";
    elgg_register_js('investigaciones-evaluador', $url, 'head');

    $url = "mod/evaluadores/vendors/pag_ferias_evaluador.js";
    elgg_register_js('pagination/ferias_evaluador', $url, 'head');

    elgg_register_ajax_view('investigaciones_asignadas/ver_investigaciones');
    elgg_register_ajax_view('evaluadores/ver_evaluadores_aceptados');
    elgg_register_ajax_view('evaluadores/ver_evaluadores_preinscritos');
    elgg_register_ajax_view('evaluadores/ver_ferias_evaluador');
    elgg_register_ajax_view('evaluadores/listar_convocatorias_evaluador');

    //Registro vistas ajax para los formatos
    //Evaluacion en Sistio
    elgg_register_ajax_view('formatos_evaluacion_feria/formato_eval_sustentacion_oral_INN');
    elgg_register_ajax_view('formatos_evaluacion_feria/formato_eval_sustentacion_oral_INV');
    elgg_register_ajax_view('formatos_evaluacion_feria/formato_valoracion_maestro_oral');

    //Evaluacion Inicial
    elgg_register_ajax_view('formatos_evaluacion_feria/formato_eval_informeinv_diariocampoINN_inv');
    elgg_register_ajax_view('formatos_evaluacion_feria/formato_eval_informeinv_diariocampoINN');
    elgg_register_ajax_view('formatos_evaluacion_feria/formato_valoracion_maestro_escrito');
    elgg_register_ajax_view('formatos_evaluacion_feria/formato_eval_informeinv_cuadcampoINN_inv');



    /* registrar el handler para verificar que existe la hoja de vida cuando se realiza una inscripcion
     * se ejecuta cada vez que alguien realiza una peticion de inscripcion al grupo
     */
    elgg_register_plugin_hook_handler('request', 'request_evaluador', 'request_join_evaluador_handler', 400);
    //elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'add_button_user_menu');
    elgg_register_event_handler('pagesetup', 'system', 'add_button_user_menu');

    //registrar el manejador
    elgg_register_page_handler('evaluadores', 'evaluadores_page_handler');
}

function evaluadores_page_handler($page) {
    $plugin_dir = elgg_get_plugins_path();
    $base_dir = $plugin_dir . "evaluadores/pages/evaluadores";
    $base_dir2 = $plugin_dir . "evaluadores/pages/investigacion";
    $base_dir3 = $plugin_dir . "evaluadores/pages/formatos_evaluacion_feria";
    if (count($page) == 0) { // rutas como pagina.com/inscripcion_evaluador
        $page[0] = 'evaluadores_aceptados';
    }
    switch ($page[0]) {
        case 'registrar':
            require "$base_dir/forms/create.php";
            break;

        case 'convocar':
            set_input('id_conv', $page[1]);
            require "$base_dir/convocar.php";
            break;

        case 'hojadevida':
            require "$base_dir/hoja_de_vida/hoja_de_vida.php";
            break;

        case 'ver_hojadevida':
            set_input("id_user", $page[1]);
            require "$base_dir/hoja_de_vida/vista_hoja_vida.php";
            break;

        case 'evaluadores_preinscritos':
            require "$base_dir/ver_evaluadores_preinscritos.php";
            break;

        case 'evaluadores_aceptados':
            require "$base_dir/ver_evaluadores_aceptados.php";
            break;

        case '':
            require "$base_dir/ver_evaluadores_aceptados.php";
            break;

        case 'listar_convocatorias_evaluador':
            require "$base_dir/listar_convocatorias_evaluador.php";
            break;

        case 'listar_investigaciones_convocatorias':
            set_input('id_conv', $page[1]);
            require "$base_dir/listar_investigaciones_asignadas.php";
            break;

        case 'listar_ferias_asignadas':
            require "$base_dir/listar_ferias_asignadas.php";
            break;


        case 'listar_investigaciones_feria':
            set_input("guid_feria", $page[1]);
            require "$base_dir/listar_investigaciones_feria.php";
            break;

        case 'index':
            require "$base_dir/index.php";
            break;

        case 'evaluar_investigacion':
            set_input('guid', $page[1]);
            require "$base_dir2/evaluar_investigacion.php";
            break;

        case 'convocar_feria':
            set_input('id_feria', $page[1]);
            require "$base_dir/convocar_feria.php";
            break;

        case 'evaluar_informeinv_diariocampoINN'://93 - OK
            set_input('guid_f', $page[1]);
            set_input('guid_inv', $page[2]);
            set_input('guid_eval', $page[3]);
            require "$base_dir3/formato_eval_informeinv_diariocampoINN.php";
            break;

        case 'evaluar_informeinv_diariocampoINN_inv'://94 - OK
            set_input('guid_f', $page[1]);
            set_input('guid_inv', $page[2]);
            set_input('guid_eval', $page[3]);
            require "$base_dir3/formato_eval_informeinv_diariocampoINN_inv.php";
            break;

        case 'evaluar_maestro_escrito'://95 - OK
            set_input('guid_f', $page[1]);
            set_input('guid_inv', $page[2]);
            set_input('guid_eval', $page[3]);
            require "$base_dir3/formato_valoracion_maestro_escrito.php";
            break;

        case 'evaluar_maestro_oral'://96 - OK
            set_input('guid_f', $page[1]);
            set_input('guid_inv', $page[2]);
            set_input('guid_eval', $page[3]);
            require "$base_dir3/formato_valoracion_maestro_oral.php";
            break;

        case 'evaluar_informeinv_cuadcampoINN_inv'://97 - OK
            set_input('guid_f', $page[1]);
            set_input('guid_inv', $page[2]);
            set_input('guid_eval', $page[3]);
            require "$base_dir3/formato_eval_informeinv_cuadcampoINN_inv.php";
            break;

        case 'evaluar_sustentacion_oral_INN'://98 - OK
            set_input('guid_f', $page[1]);
            set_input('guid_inv', $page[2]);
            set_input('guid_eval', $page[3]);
            require "$base_dir3/formato_eval_sustentacion_oral_INN.php";
            break;

        case 'evaluar_sustentacion_oral_INV'://99 - ok
            set_input('guid_f', $page[1]);
            set_input('guid_inv', $page[2]);
            set_input('guid_eval', $page[3]);
            require "$base_dir3/formato_eval_sustentacion_oral_INV.php";
            break;

        default:
            break;
    }

    return true;
}

function request_join_evaluador_handler($hook, $type, $params, $return) {
    //verificar si el usuario que realizo la peticion tiene disponible su hoja de vida

   
    $return = true;
    return $return;
}

function add_button_user_menu() {
    if (elgg_is_logged_in() && isset($_SESSION['roles'])) {
        global $_SESSION;
        $roles = $_SESSION['roles'];
        if (in_array('Profesor', $roles)) {
            $url = elgg_get_site_url() . 'action/evaluadores/request';
            $url_request = elgg_add_action_tokens_to_url($url);
            $item = new ElggMenuItem('evaluadores', elgg_echo('inscripcion:evaluador'), $url_request);
            //$item->setSection('action');
            //elgg_register_menu_item('page', $item);
            elgg_register_menu_item('site', array(
                'name' => 'evaluadores',
                'text' => 'inscripcion a evaluadores',
                'href' => $url_request,
                    //'context' => 'admin',
            ));

            if (elgg_is_active_plugin('OhYesTheme')) {
                $OhyesTheme = new OhYesTheme;
                $OhyesTheme->register_menu_item('header', array(
                    'url' => $url_request,
                    'title' => elgg_echo('inscripcion_evaluador'),
                    'text' => elgg_echo('evaluadores'),
                    'image_class' => 'ohyes-theme-link-blog',
                ));
            }
        }
    }
}
