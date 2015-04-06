<?php

/**
 * Clase que modela una evaluacion de un informe de investigacion
 *
 *
 * @author CORTEX_DIEGOX
 */
class ElggEvaluacionCompInnovacionInvCuad extends ElggObject {

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "evaluacion_compInnovacion_invCuad";
        //Datos varios
        $this->attributes['municipio_dpto'] = "";
        $this->attributes['institucion'] = "";
        $this->attributes['name_grupo'] = "";
        $this->attributes['name_inv'] = "";
        $this->attributes['name_maestroAcomp'] = "";
        $this->attributes['name_eval'] = "";
        $this->attributes['profesion_eval'] = "";
        $this->attributes['institucion_eval'] = "";
        $this->attributes['tipo_innovacion'] = "";
        $this->attributes['linea_tematica'] = "";
        
        //Aspectos valoracion y puntajes
        //Fundamentación
        $this->attributes['fundamentos_conocimiento'] = "";
        $this->attributes['puntaje_fundamentos_conocimiento'] = "";
        
        $this->attributes['propuesta_metodologica'] = "";
        $this->attributes['puntaje_propuesta_metodologica'] = "";
        
        $this->attributes['existe_coherencia'] = "";
        $this->attributes['puntaje_existe_coherencia'] = "";
        
        $this->attributes['subtotal_fundamentacion'] = "";
        
        //Tipos y proceso de
        $this->attributes['forma_original'] = "";
        $this->attributes['puntaje_forma_original'] = "";
        
        $this->attributes['argumenta_transformacion'] = "";
        $this->attributes['puntaje_argumenta_transformacion'] = "";
        
        $this->attributes['proceso_investigativo'] = "";
        $this->attributes['puntaje_proceso_investigativo'] = "";
        
        $this->attributes['subtotal_tipos'] = "";
        
        //Pertinencia e impacto
        $this->attributes['grado_elaboracion'] = "";
        $this->attributes['puntaje_grado_elaboracion'] = "";
        
        $this->attributes['resultados_investigacion'] = "";
        $this->attributes['puntaje_resultados_investigacion'] = "";
        
        $this->attributes['evolucion_desarrollo'] = "";
        $this->attributes['puntaje_evolucion_desarrollo'] = "";
        
        $this->attributes['subtotal_impacto'] = "";
        
        //Apropiación
        $this->attributes['dinamica_vivida'] = "";
        $this->attributes['puntaje_dinamica_vivida'] = "";
        
        $this->attributes['social_logrado'] = "";
        $this->attributes['puntaje_social_logrado'] = "";
        
        $this->attributes['importancia_social'] = "";
        $this->attributes['puntaje_importancia_social'] = "";
        
        $this->attributes['subtotal_apropiacion'] = "";
        
        //Anexo
        $this->attributes['puntaje_total'] = "";
        $this->attributes['observaciones'] = "";
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    function save() {
        $user_guid = elgg_get_logged_in_user_guid();

        $guid = parent::save();
        if ($guid) {
            create_metadata($guid, 'municipio_dpto', $this->attributes['municipio_dpto'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'institucion', $this->attributes['institucion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'name_grupo', $this->attributes['name_grupo'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'name_inv', $this->attributes['name_inv'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'name_maestroAcomp', $this->attributes['name_maestroAcomp'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'name_eval', $this->attributes['name_eval'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'profesion_eval', $this->attributes['profesion_eval'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'institucion_eval', $this->attributes['institucion_eval'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'tipo_innovacion', $this->attributes['tipo_innovacion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'linea_tematica', $this->attributes['linea_tematica'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            
            //Fundamentación
            create_metadata($guid, 'fundamentos_conocimiento', $this->attributes['fundamentos_conocimiento'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_fundamentos_conocimiento', $this->attributes['puntaje_fundamentos_conocimiento'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'propuesta_metodologica', $this->attributes['propuesta_metodologica'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_propuesta_metodologica', $this->attributes['puntaje_propuesta_metodologica'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'existe_coherencia', $this->attributes['existe_coherencia'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_existe_coherencia', $this->attributes['puntaje_existe_coherencia'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'subtotal_fundamentacion', $this->attributes['subtotal_fundamentacion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            //Tipos y proceso de
            create_metadata($guid, 'forma_original', $this->attributes['forma_original'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_forma_original', $this->attributes['puntaje_forma_original'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'argumenta_transformacion', $this->attributes['argumenta_transformacion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_argumenta_transformacion', $this->attributes['puntaje_argumenta_transformacion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'proceso_investigativo', $this->attributes['proceso_investigativo'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_proceso_investigativo', $this->attributes['puntaje_proceso_investigativo'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'subtotal_tipos', $this->attributes['subtotal_tipos'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            //Pertinencia e impacto
            create_metadata($guid, 'grado_elaboracion', $this->attributes['grado_elaboracion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_grado_elaboracion', $this->attributes['puntaje_grado_elaboracion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'resultados_investigacion', $this->attributes['resultados_investigacion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_resultados_investigacion', $this->attributes['puntaje_resultados_investigacion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'evolucion_desarrollo', $this->attributes['evolucion_desarrollo'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_evolucion_desarrollo', $this->attributes['puntaje_evolucion_desarrollo'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'subtotal_impacto', $this->attributes['subtotal_impacto'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            //Apropiacion
            create_metadata($guid, 'dinamica_vivida', $this->attributes['dinamica_vivida'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_dinamica_vivida', $this->attributes['puntaje_dinamica_vivida'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'social_logrado', $this->attributes['social_logrado'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_social_logrado', $this->attributes['puntaje_social_logrado'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'importancia_social', $this->attributes['importancia_social'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_importancia_social', $this->attributes['puntaje_importancia_social'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'subtotal_apropiacion', $this->attributes['subtotal_apropiacion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            //Anexo
            create_metadata($guid, 'puntaje_total', $this->attributes['puntaje_total'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'observaciones', $this->attributes['observaciones'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
                        
            return $guid;
        }
        return false;
    }

}

