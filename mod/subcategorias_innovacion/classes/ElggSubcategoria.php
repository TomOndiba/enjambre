<?php


/**
 * Clase que representa un área de feria
 * @author DIEGOX_CORTEX
 */
class ElggSubcategoria extends ElggObject{
    //put your code here
    
    
    
    function initializeAttributes() {
       parent::initializeAttributes();
       $this->attributes['subtype']="subcategoria_innovacion"; 
       $this->attributes['access_id'] = ACCESS_PUBLIC;
    }
    
    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }


    public function save() {
        $guid = parent::save();
        return $guid;
    }
}
