<?php

/**
 * Clase que representa cada trayecto de la bitacora 5
 * @author DIEGOX_CORTEX
 */

class Elgg_Trayecto extends ElggObject {

    //put your code here

  

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "trayecto_bit5";
        
        $this->attributes['nombre'] = "";
        
 
        $this->attributes['access_id'] = ACCESS_PUBLIC;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        
        $guid = parent::save();
        $user = elgg_get_logged_in_user_entity();
        create_metadata($guid, 'nombre', $this->nombre, 'text', $user->guid, ACCESS_PUBLIC);
        
        
        
        return $guid;
       
    }
    
    

}