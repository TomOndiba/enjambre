<?php

/**
 * Class representing a container for other elgg entities.
 *
 * @package    Elgg.Core
 * @subpackage Groups
 * 
 */
class ElggCuadernoCampo extends ElggGroup implements Friendable {

    function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "cuaderno_campo";
        $this->access_id = ACCESS_PUBLIC;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        $guid = parent::save();
        return $guid;
    }

    public function getBitacoraUno() {
        return elgg_get_entities(array(
                    'type' => 'object',
                    'subtype' => 'bitacora1',
                    'owner_guid' => $this->guid))[0];
    }

    public function getBitacoraDos() {
        return elgg_get_entities(array(
                    'type' => 'object',
                    'subtype' => 'bitacora2',
                    'owner_guid' => $this->guid))[0];
    }

    public function getBitacoraTres() {
        return elgg_get_entities(array(
                    'type' => 'object',
                    'subtype' => 'bitacora3',
                    'owner_guid' => $this->guid))[0];
    }

}
