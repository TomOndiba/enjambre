<?php

/**
 * Clase que modela una evaluacion de un informe de investigacion
 *
 *
 * @author CORTEX_DIEGOX
 */
class ElggEvalInformeInvDiariCcampoINN_inv extends ElggObject {

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "evaluacion_compInnovacion_invCuad_catInv";
        //Datos varios
        $this->attributes['municipio_dpto'] = "";
        $this->attributes['institucion'] = "";
        $this->attributes['name_grupo'] = "";
        $this->attributes['name_inv'] = "";
        $this->attributes['name_maestroAcomp'] = "";
        $this->attributes['name_eval'] = "";
        $this->attributes['profesion_eval'] = "";
        $this->attributes['institucion_eval'] = "";
        $this->attributes['categoria'] = "";
        $this->attributes['linea_tematica'] = "";
        
        //Aspectos valoracion y puntajes
        //COHERENCIA
        $this->attributes['puntaje_trabajo_colaborativo'] = "";
        $this->attributes['puntaje_relacion_pregunta'] = "";
        $this->attributes['subtotal_coherencia'] = "";
        //RUTA_INDAGACION
        $this->attributes['puntaje_diseño_metodologico'] = "";
        $this->attributes['puntaje_conocimientos_conceptos'] = "";
        $this->attributes['puntaje_resultados_claros'] = "";
        $this->attributes['subtotal_ruta'] = "";
        //FUENTES
        $this->attributes['puntaje_forma_adecuada'] = "";
        $this->attributes['subtotal_fuentes'] = "";
        //ANEXOS
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
            create_metadata($guid, 'categoria', $this->attributes['categoria'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'linea_tematica', $this->attributes['linea_tematica'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            //COHERENCIA
            create_metadata($guid, 'puntaje_trabajo_colaborativo', $this->attributes['puntaje_trabajo_colaborativo'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_relacion_pregunta', $this->attributes['puntaje_relacion_pregunta'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'subtotal_coherencia', $this->attributes['subtotal_coherencia'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            //RUTA_INDAGACION
            create_metadata($guid, 'puntaje_diseño_metodologico', $this->attributes['puntaje_diseño_metodologico'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_conocimientos_conceptos', $this->attributes['puntaje_conocimientos_conceptos'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_resultados_claros', $this->attributes['puntaje_resultados_claros'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'subtotal_ruta', $this->attributes['subtotal_ruta'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            //FUENTES
            create_metadata($guid, 'puntaje_forma_adecuada', $this->attributes['puntaje_forma_adecuada'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'subtotal_fuentes', $this->attributes['subtotal_fuentes'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            //ANEXOS
            create_metadata($guid, 'puntaje_total', $this->attributes['puntaje_total'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'observaciones', $this->attributes['observaciones'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
           
            return $guid;
        }
        return false;
    }

}