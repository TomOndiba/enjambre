<?php

/**
 * Clase que representa la bitacora 5
 * @author DIEGOX_CORTEX
 */
 
class Elgg_Bitacora5 extends ElggObject {

    //put your code here

 

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "bitacora5";
        
        $this->attributes['inv'] = "";      
        $this->attributes['grupo'] = "";
        $this->attributes['colegio'] = "";
        $this->attributes['municipio'] = "";
        $this->attributes['linea_inv'] = "";     
        
        $this->attributes['total_totalAp'] = ""; 
        $this->attributes['total_totalDs'] = ""; 
        $this->attributes['total_ejecutado'] = ""; 
        $this->attributes['total_saldo'] = ""; 
        
        $this->attributes['access_id'] = ACCESS_PUBLIC;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        
        $guid = parent::save();
        $user = elgg_get_logged_in_user_entity();
        create_metadata($guid, 'inv', $this->inv, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'grupo', $this->grupo, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'colegio', $this->colegio, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'municipio', $this->municipio, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'linea_inv', $this->linea_inv, 'text', $user->guid, ACCESS_PUBLIC);
        
        create_metadata($guid, 'total_totalAp', $this->total_totalAp, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'total_totalDs', $this->total_totalDs, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'total_ejecutado', $this->total_ejecutado, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'total_saldo', $this->total_saldo, 'text', $user->guid, ACCESS_PUBLIC);
        
        return $guid;
       
    }

}