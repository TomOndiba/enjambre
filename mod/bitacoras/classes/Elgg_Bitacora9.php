<?php

/**
 * Clase que representa la bitacora 9
 * @author DIEGOX_CORTEX
 */
 
class Elgg_Bitacora9 extends ElggObject {

    //put your code here

 

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "bitacora9";          
        $this->attributes['comunidades'] = "";    
        $this->attributes['caracteristicas'] = "";    
        $this->attributes['organizacion'] = "";    
            
        
        
        $this->attributes['access_id'] = ACCESS_PUBLIC;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        
        $guid = parent::save();
        $user = elgg_get_logged_in_user_entity();
        return $guid;
       
    }

}


