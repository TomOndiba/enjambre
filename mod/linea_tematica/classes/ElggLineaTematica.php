<?php


/**
 * Clase que representa una Línea Temática
 * @author DIEGOX_CORTEX
 */
class ElggLineaTematica extends ElggGroup implements Friendable{
    //put your code here
    
    
    
    function initializeAttributes() {
       parent::initializeAttributes();
       $this->attributes['subtype']="lineaTematica"; 
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
            create_metadata($guid, 'nombre', $this->name, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'descripcion', $this->description, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'tipo', $this->tipo, 'text', $user->guid, ACCESS_PUBLIC);
            return $guid;
        //}
    }
}
