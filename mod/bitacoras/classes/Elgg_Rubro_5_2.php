<?php

/**
 * Clase que representa un rubro de la bitacora 5.2
 * @author DIEGOX_CORTEX
 */
 
class Elgg_Rubro_5_2 extends ElggObject {

    //put your code here

 

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "rubro_bit5_2";
        
        $this->attributes['nombre'] = "";      
        $this->attributes['fecha_gasto'] = "";
        $this->attributes['proveedor'] = "";
        $this->attributes['valor_unitario'] = "";
        
        $this->attributes['valor_total'] = "";
     
        
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
        create_metadata($guid, 'fecha_gasto', $this->fecha_gasto, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'proveedor', $this->proveedor, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'valor_unitario', $this->valor_unitario, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'valor_total', $this->valor_total, 'text', $user->guid, ACCESS_PUBLIC);
               
        return $guid;
       
    }

}

