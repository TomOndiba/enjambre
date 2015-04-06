<?php

/**
 * Start que controla el plugin linea_tematica
 * @author DIEGOX_CORTEX
 */
elgg_register_event_handler('init', 'system', 'reportes_init');

function reportes_init() {
    //Agregar los action's
    $base = elgg_get_plugins_path() . 'reporte/actions/reportes';
    elgg_register_action("reportes/form_impresion", "$base/imprimir.php", "logged_in");
    elgg_register_action("reportes/form_impresion_excel", "$base/imprimir_excel.php", "logged_in");
    elgg_register_action('reportes/imprimir', "$base/imprimir.php", "logged_in");
    // elgg_register_action("reportes/hombres_dpto", "$base/hombres_dpto.php", "logged_in");
    // 
        $base_bitacora=  elgg_get_plugins_path().'bitacoras/actions';
        elgg_register_action("reportes/form_impresion_pdf", "$base_bitacora/bitacoras/print.php", "logged_in");
    //Agregar las librerias
    $lib = elgg_get_plugins_path() . 'reporte/lib/reportes.php';
    elgg_register_library('reporte', $lib);
    elgg_load_library('reporte');

    /**
     * vista ajax reportes de comuniad
     */
    //Por Departamento
    elgg_register_ajax_view('reporte/comunidad/departamento/init');
    elgg_register_ajax_view('reporte/comunidad/departamento/reporte_departamento');
    elgg_register_ajax_view('reporte/comunidad/departamento/instituciones/instituciones_departamento');
    elgg_register_ajax_view('reporte/comunidad/departamento/grupos/grupos_departamento');

    //Municipio
    elgg_register_ajax_view('reporte/comunidad/municipio/init_municipio');
    elgg_register_ajax_view('reporte/comunidad/municipio/reporte_municipio');
    elgg_register_ajax_view('reporte/comunidad/municipio/instituciones_municipio/instituciones_municipio');
    elgg_register_ajax_view('reporte/comunidad/municipio/grupos_municipio/grupos_municipio');

    //Investigaciones
    elgg_register_ajax_view('reporte/comunidad/investigaciones/init_investigaciones');
    elgg_register_ajax_view('reporte/comunidad/investigaciones/listar_grupos_reporteInv');
    elgg_register_ajax_view('reporte/comunidad/investigaciones/reporte_investigaciones');
    elgg_register_ajax_view('reporte/comunidad/investigaciones/listar_investigaciones_grupo');    
    elgg_register_ajax_view('reporte/comunidad/investigaciones/reporte_maestros_investigacion');
    /**
     * vista ajax reportes de Convocatorias
     */
    //Listado de Convocatorias por rango de fechas
    elgg_register_ajax_view('reporte/convocatoria/listado_convocatorias/init_listado');
    elgg_register_ajax_view('reporte/convocatoria/listado_convocatorias/reporte_listado_convocatorias');
    //Departamento
    elgg_register_ajax_view('reporte/convocatoria/departamento/init_departamento');
    elgg_register_ajax_view('reporte/convocatoria/departamento/reporte_convocatoria_dpto');
    //Estudiantes que participan en convocatoria
    elgg_register_ajax_view('reporte/convocatoria/participacion_estudiantes/init_estudiantes_conv');
    elgg_register_ajax_view('reporte/convocatoria/participacion_estudiantes/convocatorias_by_dpto');
    elgg_register_ajax_view('reporte/convocatoria/participacion_estudiantes/reporte_estudiantes_conv');
    //Maestros que Participan en una convocatoria
    elgg_register_ajax_view('reporte/convocatoria/participacion_maestros/init_maestros_conv');
    elgg_register_ajax_view('reporte/convocatoria/participacion_maestros/convocatorias_by_dpto3');
    elgg_register_ajax_view('reporte/convocatoria/participacion_maestros/reporte_maestros_conv');
    //Investigaciones que participan en convocatoria
    elgg_register_ajax_view('reporte/convocatoria/participacion_investigaciones/init_investigaciones_conv');
    elgg_register_ajax_view('reporte/convocatoria/participacion_investigaciones/convocatorias_by_dpto2');
    elgg_register_ajax_view('reporte/convocatoria/participacion_investigaciones/reporte_investigaciones_conv');
    //Grupos en Convocatorias
    elgg_register_ajax_view('reporte/convocatoria/participacion_grupos/init_grupos_conv');
    elgg_register_ajax_view('reporte/convocatoria/participacion_grupos/convocatorias_by_dpto4');
    elgg_register_ajax_view('reporte/convocatoria/participacion_grupos/reporte_grupos_conv');
     //Evaluadores
    elgg_register_ajax_view('reporte/convocatoria/evaluadores_conv/init_evaluadores_conv');
    elgg_register_ajax_view('reporte/convocatoria/evaluadores_conv/convocatorias_por_dpto');
    elgg_register_ajax_view('reporte/convocatoria/evaluadores_conv/reporte_evaluadores_conv');
    
         //Asesores
    elgg_register_ajax_view('reporte/convocatoria/asesores_conv/init_asesores_conv');
    elgg_register_ajax_view('reporte/convocatoria/asesores_conv/convocatorias_por_dpto');
    elgg_register_ajax_view('reporte/convocatoria/asesores_conv/reporte_asesores_conv');
    
    //Ferias en convocatorias
    elgg_register_ajax_view('reporte/convocatoria/ferias_en_convocatorias/convocatorias_by_dptoX');
    elgg_register_ajax_view('reporte/convocatoria/ferias_en_convocatorias/init_ferias_in_conv');
    elgg_register_ajax_view('reporte/convocatoria/ferias_en_convocatorias/reporte_ferias_in_conv');

    /**
     * Vista ajax de reportes de Asesores
     */
     elgg_register_ajax_view('print/imprimir_excel');
    //Reporte de proyectos por asesor en convocatoria
    elgg_register_ajax_view('reporte/asesor/proyectos_asesor_conv/convocatorias_by_dpto_as1');
    elgg_register_ajax_view('reporte/asesor/proyectos_asesor_conv/init_proyectos_asesor_conv');
    elgg_register_ajax_view('reporte/asesor/proyectos_asesor_conv/reporte_proyectos_asesor_conv');
    elgg_register_ajax_view('reporte/asesor/proyectos_asesor_conv/asesores_by_convocatoria');
    //Reporte de proyectos por asesor
    elgg_register_ajax_view('reporte/asesor/proyectos_asesor/busqueda_asesor');
    elgg_register_ajax_view('reporte/asesor/proyectos_asesor/reporte_proyectos_asesor');
    //Reporte de Calificacón de Asesor en Convocatoria
    elgg_register_ajax_view('reporte/asesor/calificacion_asesor_conv/convocatorias_by_dpto_as2');
    elgg_register_ajax_view('reporte/asesor/calificacion_asesor_conv/init_calificaion_asesor_conv');
    elgg_register_ajax_view('reporte/asesor/calificacion_asesor_conv/reporte_calificacion_asesor_conv');
    elgg_register_ajax_view('reporte/asesor/calificacion_asesor_conv/asesores_by_convocatoria1');
    //Asesorias
    elgg_register_ajax_view('reporte/asesor/asesorias_by_asesor/busqueda_asesorias_asesor');
    elgg_register_ajax_view('reporte/asesor/asesorias_by_asesor/reporte_asesorias_asesor');
    elgg_register_ajax_view('reporte/asesor/asesorias_by_asesor/investigaciones_asesoradas');

    //Por Etnia
    elgg_register_ajax_view('reporte/comunidad/departamento/etnia/departamento_etnia');
    elgg_register_ajax_view('reporte/comunidad/departamento/etnia/ver_etnia');
    elgg_register_ajax_view('reporte/comunidad/municipio/etnia/municipio_etnia');
    elgg_register_ajax_view('reporte/comunidad/municipio/etnia/ver_etnia');

    //Por Tipo de Usuario (Maestro-Estudiante)
    elgg_register_ajax_view('reporte/comunidad/departamento/tipo_usuario/departamento_tipo_usuario');
    elgg_register_ajax_view('reporte/comunidad/departamento/tipo_usuario/ver_tipo_usuario');
    elgg_register_ajax_view('reporte/comunidad/municipio/tipo_usuario/dpto_munic_tipo_usuario');
    elgg_register_ajax_view('reporte/comunidad/municipio/tipo_usuario/ver_tipo_usuarioMun');
    //Por Genero
    elgg_register_ajax_view('reporte/comunidad/departamento/genero/departamento_genero');
    elgg_register_ajax_view('reporte/comunidad/departamento/genero/ver_genero');
    elgg_register_ajax_view('reporte/comunidad/municipio/genero/municipio_genero');
    elgg_register_ajax_view('reporte/comunidad/municipio/genero/ver_genero');

    //Por Grado
    elgg_register_ajax_view('reporte/comunidad/departamento/grado/departamento_grado');
    elgg_register_ajax_view('reporte/comunidad/departamento/grado/ver_grado');
    elgg_register_ajax_view('reporte/comunidad/municipio/grado/municipio_grado');
    elgg_register_ajax_view('reporte/comunidad/municipio/grado/ver_grado');

    //Por Tipo de Institución
    elgg_register_ajax_view('reporte/comunidad/departamento/institucion/departamento_tipo_institucion');
    elgg_register_ajax_view('reporte/comunidad/departamento/institucion/ver_tipo_institucion');
    elgg_register_ajax_view('reporte/comunidad/municipio/institucion/municipio_tipo_institucion');
    elgg_register_ajax_view('reporte/comunidad/municipio/institucion/ver_tipo_institucion');


    //Institucion
    elgg_register_ajax_view('reporte/comunidad/institucion/init_institucion');
    elgg_register_ajax_view('reporte/comunidad/institucion/reporte_institucion');
    elgg_register_ajax_view('reporte/comunidad/institucion/listar_instituciones_reporte');
    elgg_register_ajax_view('reporte/comunidad/institucion/grupos/grupos_institucion');
    elgg_register_ajax_view('reporte/comunidad/institucion/investigaciones/investigaciones_institucion');


    //Grupos-comunidad
    elgg_register_ajax_view('reporte/comunidad/grupo/init_grupo');
    elgg_register_ajax_view('reporte/comunidad/grupo/reporte_grupo');
    elgg_register_ajax_view('reporte/comunidad/grupo/listar_grupos_reporte');
    elgg_register_ajax_view('reporte/comunidad/grupo/investigaciones/investigaciones_grupo');

    //Ferias
    elgg_register_ajax_view('reporte/feria/departamento/init_departamento');
    elgg_register_ajax_view('reporte/feria/departamento/reporte_feria_dpto');
    elgg_register_ajax_view('reporte/feria/municipio/init_municipio');
    elgg_register_ajax_view('reporte/feria/municipio/reporte_feria_municipio');
    elgg_register_ajax_view('reporte/feria/estudiantes/init_tipo_feria');
    elgg_register_ajax_view('reporte/feria/estudiantes/feria_tipo');
    elgg_register_ajax_view('reporte/feria/estudiantes/reporte_estudiantes_feria');
    elgg_register_ajax_view('reporte/feria/maestros/init_tipo_feria');
    elgg_register_ajax_view('reporte/feria/maestros/reporte_maestros_feria');
    elgg_register_ajax_view('reporte/feria/grupos/init_grupos_feria');
    elgg_register_ajax_view('reporte/feria/grupos/reporte_grupos_feria');
    elgg_register_ajax_view('reporte/feria/investigaciones/init_investigaciones_feria');
    elgg_register_ajax_view('reporte/feria/investigaciones/reporte_investigaciones_feria');
    elgg_register_ajax_view('reporte/feria/evaluadores/init_evaluadores_feria');
    elgg_register_ajax_view('reporte/feria/evaluadores/reporte_evaluadores_feria');


    //Grupos
    elgg_register_ajax_view('reporte/grupo/convocatoria/init_convocatoria_grupo');
    elgg_register_ajax_view('reporte/grupo/convocatoria/reporte_conv_grupo');
    elgg_register_ajax_view('reporte/grupo/feria/init_feria_grupo');
    elgg_register_ajax_view('reporte/grupo/feria/reporte_feria_grupo');


    //Evaluadores
    elgg_register_ajax_view('reporte/evaluador/proyectos_evaluados_convocatoria/init_proyectos_evaluados_conv');
    elgg_register_ajax_view('reporte/evaluador/proyectos_evaluados_convocatoria/convocatorias_por_dpto');
    elgg_register_ajax_view('reporte/evaluador/proyectos_evaluados_convocatoria/evaluadores_por_convocatoria');
    elgg_register_ajax_view('reporte/evaluador/proyectos_evaluados_convocatoria/reporte_proyectos_evaluador_conv');

    elgg_register_ajax_view('reporte/evaluador/proyectos_evaluados_feria/init_proyectos_evaluados_feria');
    elgg_register_ajax_view('reporte/evaluador/proyectos_evaluados_feria/evaluadores_por_feria');
    elgg_register_ajax_view('reporte/evaluador/proyectos_evaluados_feria/reporte_proyectos_evaluador_feria');

    elgg_register_ajax_view('reporte/evaluador/proyectos_evaluador/busqueda_evaluador');
    elgg_register_ajax_view('reporte/evaluador/proyectos_evaluador/reporte_proyectos_evaluador');

    elgg_register_ajax_view('reportes/impresion/imprimir');
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'reportes_owner_block_menu');

    //Redes Tematicas
    elgg_register_ajax_view('reporte/redes_tematicas/init');
    elgg_register_ajax_view('reporte/redes_tematicas/consultar_redes');
    elgg_register_ajax_view('reporte/redes_tematicas/reporte_usuarios_red');    
    
    //enrutador
    elgg_register_page_handler('reporte', 'reportes_page_handler');

    //Archivos Javascript
    $url = "mod/reporte/vendors/reportes-comunidad.js";
    elgg_register_js('reportes-comunidad', $url, 'head');

    $url = "mod/reporte/vendors/municipios_dep_reportes.js";
    elgg_register_js('mun-dep-reportes', $url, 'head');


    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'reportes_owner_block_menu');
}

function reportes_page_handler($page, $identifier) {
    $plugin_path = elgg_get_plugins_path();
    $base_path = $plugin_path . 'reporte/pages/reportes';
// select page based on first URL segment after /hello/
    switch ($page[0]) {
        case '':
            require "$base_path/reporte.php";
            break;
        case 'departamento':
            reportes_departamento_page_handler($page[1], $base_path);
            break;
        case 'comunidad':
            require "$base_path/comunidad.php";
            break;
        case 'grupo':
            reportes_grupo_page_handler($page[1], $base_path);
            break;
        case 'municipio':
            reportes_municipio_page_handler($page[1], $base_path);
            break;
        case 'instituciones':
            reportes_instituciones_page_handler($page[1], $base_path);
            break;
        case 'imprimir':
            require "$base_path/imprimir_reporte.php";
            break;
        default:
            forward(elgg_get_site_url());
            break;
    }
// return true to let Elgg know that a page was sent to browser
    return true;
}

function reportes_municipio_page_handler($tipo, $base_path) {
    switch ($tipo) {
        case 'estudiantes':
            require "$base_path/estudiantes/ninos_municipio.php";
            break;
    }

    return;
}

function reportes_departamento_page_handler($tipo, $base_path) {
    switch ($tipo) {
        case 'mujeres':
            require "$base_path/mujeres_dpto.php";
            break;
        case 'hombres':
            require "$base_path/hombres_dpto.php";
            break;
        case 'estudiantes':
            require "$base_path/estudiantes/ninos_departamento.php";
            break;
    }

    return;
}

function reportes_grupo_page_handler($tipo, $base_path) {
    switch ($tipo) {
        case 'hombresYmujeres':
            require "$base_path/mujeres_grupo.php";
            break;
    }

    return;
}

function reportes_instituciones_page_handler($tipo, $base_path) {
    switch ($tipo) {
        case 'rurales

     ':
            require "$base_path/instituciones_rurales.php";
            break;
        case 'urbanas':
            require "$base_path/instituciones_urbanas.php";
            break;
    }

    return;
}

/**
 * Add a menu item to the user ownerblock
 */
function reportes_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity

        '], 'user')) {
        $url = elgg_get_site_url() . 'reportes/crear';
        $item = new ElggMenuItem('reportes ', elgg_echo('reportes '), $url);
        $return[] = $item;
    } else {
        if ($params['entity']->file_enable != "no") {
            $url = "file/group/{$params['entity']->guid}/all";
            $item = new ElggMenuItem('file ', elgg_echo('file:group '), $url);
            $return[] = $item;
        }
    }

    return $return;
}
