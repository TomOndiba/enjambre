<?php

/**
 * Clase que representa la bitacora 7
 * @author DIEGOX_CORTEX
 */
 
class Elgg_Bitacora7 extends ElggObject {

    //put your code here

 

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "bitacora7";   
        $this->attributes['aspectos'] = "";
        $this->attributes['capacidades'] = "";
        $this->attributes['cambios'] = "";
        $this->attributes['caracteristicas'] = "";
        $this->attributes['t11'] = "";
        $this->attributes['t12'] = "";
        $this->attributes['t13'] = "";
        $this->attributes['t21'] = "";
        $this->attributes['t22'] = "";
        $this->attributes['t23'] = "";
        $this->attributes['t31'] = "";
        $this->attributes['t32'] = "";
        $this->attributes['t33'] = "";
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

