<?php


/**
 * Clase que representa un área de feria
 * @author DIEGOX_CORTEX
 */
class ElggAreaFeria extends ElggObject{
    //put your code here
    
    
    
    function initializeAttributes() {
       parent::initializeAttributes();
       $this->attributes['subtype']="area_feria"; 
       $this->attributes['tipo']= "";
       $this->attributes['access_id'] = ACCESS_PUBLIC;
    }
    
    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }


    public function save() {
        //if (elgg_existe_institucion($this->nombre)) {
            //return false;
        //} else {
            $guid = parent::save();
            $user = elgg_get_logged_in_user_entity();
            create_metadata($guid, 'title', $this->title, 'text', $user->guid, ACCESS_PUBLIC);
            return $guid;
        //}
    }
}
