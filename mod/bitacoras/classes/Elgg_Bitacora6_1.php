<?php


/**
 * Clase que representa la bitacora 4
 * @author DIEGOX_CORTEX
 */
class Elgg_Bitacora6_1 extends ElggObject {

    //put your code here



    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "bitacora6_1";
        $this->attributtes['tecnicas'] = "";
        $this->atttibuttes['salida'] = '';
        $this->atttibuttes['organizacion'] = '';
        $this->atttibuttes['actividades'] = '';
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
