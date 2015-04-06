<?php

/**
 * Clase que representa la bitacora 5.1
 * @author DIEGOX_CORTEX
 */
 
class Elgg_Bitacora5_1 extends ElggObject {

    //put your code here

 

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "bitacora5_1";
        
        $this->attributes['institucion'] = "";      
        $this->attributes['municipio'] = "";
        $this->attributes['grupo_inv'] = "";
        
        $this->attributes['total'] = "";
     
        
        $this->attributes['access_id'] = ACCESS_PUBLIC;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        
        $guid = parent::save();
        $user = elgg_get_logged_in_user_entity();
        create_metadata($guid, 'institucion', $this->institucion, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'municipio', $this->municipio, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'grupo_inv', $this->grupo_inv, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'total', $this->total, 'text', $user->guid, ACCESS_PUBLIC);
       
        return $guid;
       
    }

}