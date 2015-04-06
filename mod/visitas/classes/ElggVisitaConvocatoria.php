<?php

/* 
 * Visitas realizadas por los asesores y coordinadores de las convocatorias
 * a las instituciones que participan
 */

class ElggVisitaConvocatoria extends ElggObject{
    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "visitaConvocatoria";
        $this->attributes['fecha_visita'] = "";
        $this->attributes['departamento'] = "";
        $this->attributes['municipio'] = "";
        $this->attributes['asunto'] = "";
        $this->attributes['observaciones'] = "";
        $this->attributes['tipo_comunicacion'] = "";
        $this->attributes['container_guid']="";
    }
    
    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }
    
    
    function save() {
        $user_guid = elgg_get_logged_in_user_guid();
        $this->attributes['owner_guid'] = $user_guid;
        $this->attributes['access_id'] = ACCESS_LOGGED_IN;
        $this->attributes['title'] = "visita de " . $user_guid;
        $this->attributes['description'] = "visita realizada el " . $this->attributes['fecha_visita'];



        $guid = parent::save();
        if ($guid) {
            create_metadata($guid, 'fecha_visita', $this->attributes['fecha_visita'], 'date', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'departamento', $this->attributes['departamento'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'municipio', $this->attributes['municipio'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'asunto', $this->attributes['asunto'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'observaciones', $this->attributes['observaciones'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'tipo_comunicacion', $this->attributes['tipo_comunicacion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            return $guid;
        }
        return false;
    }
    
    

    
}