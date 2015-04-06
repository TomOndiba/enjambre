<?php

/**
 * Class representing a container for other elgg entities.
 *
 * @package    Elgg.Core
 * @subpackage Groups
 * 
 * @property string $website   Dirección de Sitio web del institucion
 * @property string $email   Dirección email del institucion
 * @property string $direccion   Dirección actual del institucion
 * @property string $tipo   Tipó de grupo por default institucion
 * @property string $telefono   Telefono del institucion
 * 
 */
class ElggRevista extends ElggObject{

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->subtype = "revista";
        $this->attributes['url_html'] = "";
        $this->attributes['url_flash'] = "";
        $this->attributes['imagen'] = "";
        $this->access_id = ACCESS_PUBLIC;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {

        $guid = parent::save();
        $user = elgg_get_logged_in_user_entity();
        create_metadata($guid, 'url_flash', $this->url_html, 'text', $user->guid, ACCESS_PUBLIC, false);
        create_metadata($guid, 'url_html', $this->url_flash, 'text', $user->guid, ACCESS_PUBLIC, false);
        create_metadata($guid, 'imagen', $this->imagen, 'text', $user->guid, ACCESS_PUBLIC, false);
        return $guid;
    }

}
