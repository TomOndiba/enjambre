<?php

class ElggComponente extends ElggObject {

    function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "componente";
        $this->attributes['url']="";
        $this->attributes['categoria']="";
        $this->attributes['etapa']="";
        $this->attributes['icono']="";
        $this->attributes['contenido']="";
        $this->attributes['archivo']="";
        $this->access_id = ACCESS_PUBLIC;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        $guid = parent::save();
        $user = elgg_get_logged_in_user_entity();
//        
        create_metadata($guid, 'url', $this->url, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'categoria', $this->categoria, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'etapa', $this->etapa, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'icono', $this->icono, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'contenido', $this->contenido, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'archivo', $this->archivo, 'text', $user->guid, ACCESS_PUBLIC);
        return $guid;
    }

}
