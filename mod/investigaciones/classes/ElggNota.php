<?php

/**
 * Class representing a container for other elgg entities.
 *
 * @package    Elgg.Core
 * @subpackage 
 * 
 */
class ElggNota extends ElggObject {

    function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "nota";
        $this->access_id = ACCESS_PUBLIC;
        $this->attributes['tipo'] = "";
        $this->attributes['etapa'] = "";
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        $guid = parent::save();
        $user = elgg_get_logged_in_user_entity();
//        create_metadata($guid, 'autor', $this->autor, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'tipo', $this->tipo, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'etapa', $this->etapa, 'text', $user->guid, ACCESS_PUBLIC);
        return $guid;
    }

}
