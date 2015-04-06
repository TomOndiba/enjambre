<?php

class ElggAsesoriaRed extends ElggObject {

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "asesoria_red";
        $this->attributes['fecha'] = "";
        $this->attributes['hora_inicio'] = "";
        $this->attributes['hora_fin'] = "";
        $this->attributes['turno'] = "";
        $this->attributes['access_id'] = ACCESS_PUBLIC;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        $guid = parent::save();
        if ($guid) {
            $user = elgg_get_logged_in_user_guid();
            create_metadata($guid, 'fecha', $this->fecha, 'text', $user->guid, ACCESS_PUBLIC, false);
            create_metadata($guid, 'hora_inicio', $this->hora_inicio, 'text', $user->guid, ACCESS_PUBLIC, false);
            create_metadata($guid, 'hora_fin', $this->hora_fin, 'text', $user->guid, ACCESS_PUBLIC, false);
            create_metadata($guid, 'turno', $this->turno, 'text', $user->guid, ACCESS_PUBLIC, false);
            return $guid;
        }
        return false;
    }

}
