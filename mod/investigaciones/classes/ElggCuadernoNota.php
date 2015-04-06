<?php

/**
 * Class representing a container for other elgg entities.
 *
 * @package    Elgg.Core
 * @subpackage 
 * 
 */
class ElggCuadernoNota extends ElggObject {

    function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "cuaderno_nota";
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

}
