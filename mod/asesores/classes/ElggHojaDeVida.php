<?php

/**
 * Class representing a container for other elgg entities.
 *
 * @package    Elgg.Core
 * @subpackage Groups
 * 
 * 
 */
class ElggHojaDeVida extends ElggObject {

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->access_id=ACCESS_PUBLIC;
        $this->attributes['subtype'] = "hoja_de_vida";
        $this->attributes['estudios_terminados'] = "";
        $this->attributes['cursos_terminados'] = "";
        $this->attributes['experiencia']="";
        $this->attributes['experiencia_docente']="";
        $this->attributes['investigacion']="";
        $this->attributes['pertenencia']="";
        $this->attributes['ponencias']="";
        $this->attributes['publicaciones']="";
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        $guid = parent::save();
        $user = elgg_get_logged_in_user_entity();
        create_metadata($guid, 'estudios_terminados', $this->estudios_terminados, 'text', $user->guid, ACCESS_PUBLIC);
        return $guid;
    }
    
    
}