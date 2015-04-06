<?php

/**
 * Class representing a container for other elgg entities.
 *
 * @package    Elgg.Core
 * @subpackage 
 * 
 */
class ElggLibretaAcompanante extends ElggObject {

    function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "libreta_acompanante";
        $this->access_id=ACCESS_PUBLIC;
        
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