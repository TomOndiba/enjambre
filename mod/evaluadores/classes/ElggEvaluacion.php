<?php

/**
 * Clase que modela una evaluacion de una investigacion
 *
 *
 * @author Erika Parra
 */
class ElggEvaluacion extends ElggObject {

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "evaluacion";
        $this->attributes['puntaje_bitacora1'] = "";
        $this->attributes['puntaje_bitacora2'] = "";
        $this->attributes['puntaje_bitacora3'] = "";
        $this->attributes['puntaje_total'] = "";
        $this->attributes['concepto'] = "";
        $this->attributes['observacion']="";
        
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    function save() {
        $user_guid = elgg_get_logged_in_user_guid();

        $guid = parent::save();
        if ($guid) {
            create_metadata($guid, 'puntaje_bitacora1', $this->attributes['puntaje_bitacora1'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_bitacora2', $this->attributes['puntaje_bitacora2'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_bitacora3', $this->attributes['puntaje_bitacora3'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_total', $this->attributes['puntaje_total'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'concepto', $this->attributes['concepto'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'observacion', $this->attributes['observacion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            
            return $guid;
        }
        return false;
    }

}


