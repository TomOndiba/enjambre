<?php

/**
 * Clase que modela una evaluacion de la exposicion oral de la investigación en sitio
 * categoria innovacion
 *
 *
 * @author CORTEX_DIEGOX
 */
class ElggEvalSustentacionOral_inv extends ElggObject {

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "evaluacion_puesto_investigacion";
        //Datos varios
        $this->attributes['municipio_dpto'] = "";
        $this->attributes['name_grupo'] = "";
        $this->attributes['name_inv'] = "";
        $this->attributes['name_eval'] = "";
        $this->attributes['profesion_eval'] = "";
        $this->attributes['institucion_eval'] = "";
        $this->attributes['categoria'] = "";
        $this->attributes['linea_tematica'] = "";
        
        //Aspectos valoracion y puntajes       
        //APROPIACION
        $this->attributes['puntaje_presenta_claridad'] = "";
        $this->attributes['puntaje_explica_fundamentos'] = "";
        $this->attributes['puntaje_proceso_metodologico'] = "";
        $this->attributes['puntaje_innovacion_lograda'] = "";
        $this->attributes['subtotal_apropiacion'] = "";
        //Capacidades
        $this->attributes['puntaje_evidentes_capacidades'] = "";
        $this->attributes['subtotal_capacidades'] = "";
        //Puesto
        $this->attributes['puntaje_diseño_investigativo'] = "";
        $this->attributes['subtotal_puesto'] = "";
        //Anexos
        $this->attributes['puntaje_total'] = "";
        $this->attributes['obs'] = "";
               
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
            create_metadata($guid, 'name_grupo', $this->attributes['name_grupo'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'name_inv', $this->attributes['name_inv'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'name_maestro', $this->attributes['name_maestro'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'name_eval', $this->attributes['name_eval'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'profesion_eval', $this->attributes['profesion_eval'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'institucion_eval', $this->attributes['institucion_eval'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'categoria', $this->attributes['categoria'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'linea_tematica', $this->attributes['linea_tematica'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            //Apropiacion
            create_metadata($guid, 'puntaje_presenta_claridad', $this->attributes['puntaje_presenta_claridad'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_explica_fundamentos', $this->attributes['puntaje_explica_fundamentos'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_proceso_metodologico', $this->attributes['puntaje_proceso_metodologico'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_innovacion_lograda', $this->attributes['puntaje_innovacion_lograda'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'subtotal_apropiacion', $this->attributes['subtotal_apropiacion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            //Capacidades
            create_metadata($guid, 'puntaje_evidentes_capacidades', $this->attributes['puntaje_evidentes_capacidades'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'subtotal_capacidades', $this->attributes['subtotal_capacidades'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            //Puesto
            create_metadata($guid, 'puntaje_diseño_investigativo', $this->attributes['puntaje_diseño_investigativo'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'subtotal_puesto', $this->attributes['subtotal_puesto'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_total', $this->attributes['puntaje_total'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'obs', $this->attributes['obs'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            
            return $guid;
        }
        return false;
    }

}

