<?php

/**
 * Class representing a container for other elgg entities.
 *
 * @package    Elgg.Core
 * @subpackage Groups
 * 
 * @property string $nombre_rol   Nombre del rol
 * 
 */
class ElggRol extends ElggObject {

    public function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = 'rol';
        $this->attributes['title'] = '';
        $this->attributes['description'] = '';
        $this->access_id= ACCESS_PUBLIC;
    }

    public function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        $user = elgg_get_logged_in_user_entity();
        if (!elgg_existe_rol($this->title)) {
            $guid = parent::save();
            return $guid;
        } else {
            return false;
        }
    }

}
