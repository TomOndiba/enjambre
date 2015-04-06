<?php

/**
 * Clase que representa la bitacora 8
 * @author DIEGOX_CORTEX
 */
 
class Elgg_Bitacora8 extends ElggObject {

    //put your code here

 

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "bitacora8";  
        $this->attributes['ensayo '] = "";
        $this->attributes['t11'] = "";
        $this->attributes['t12'] = "";
        $this->attributes['t13'] = "";
        $this->attributes['t14'] = "";
        $this->attributes['t15'] = "";
        $this->attributes['t21'] = "";
        $this->attributes['t22'] = "";
        $this->attributes['t23'] = "";
        $this->attributes['t24'] = "";
        $this->attributes['t25'] = "";
        $this->attributes['t31'] = "";
        $this->attributes['t32'] = "";
        $this->attributes['t33'] = "";
        $this->attributes['t34'] = "";
        $this->attributes['t35'] = "";
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
    
    
    public function getGrupoInvestigacion() {
        return elgg_get_entities_from_relationship(array(
                    'relationship' => 'tiene_cuaderno_campo',
                    'relationship_guid' => $this->owner_guid,
                    'inverse_relationship' => true))[0];
    }

    public function getInstitucion($grupo) {
        return elgg_get_entities_from_relationship(array(
                    'relationship' => 'pertenece_a',
                    'relationship_guid' => $grupo->guid,
                    'inverse_relationship' => false))[0];
    }


}



