<?php

class ElggAsesoria extends ElggObject {

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "asesoria";
        $this->attributes['tipo']= "";
        $this->attributes['modo']= "";
        $this->attributes['fecha']= "";
        $this->attributes['hora']= "";
        $this->attributes['observaciones']= "";
        $this->attributes['resumen']= "";
        $this->attributes['access_id'] = ACCESS_LOGGED_IN;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        $user_guid = elgg_get_logged_in_user_guid();
        $guid = parent::save();
        if($guid){
            create_metadata($guid, 'fecha', $this->attributes['fecha'], 'date', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'hora', $this->attributes['hora'], 'date', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'tipo', $this->attributes['tipo'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'modo', $this->attributes['modo'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'observaciones', $this->attributes['observaciones'], '', $user_guid, ACCESS_LOGGED_IN, false);
            return $guid;
        }
        return false;       
    }
}
