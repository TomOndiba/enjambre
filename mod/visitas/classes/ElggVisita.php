<?php

/**
 * Clase que modela una visita que realiza un coordinador a una institucion
 * Estas visitas son externas, no estan asociadas a una convocatoria
 *
 * @author Jorge Castaneda
 */
class ElggVisita extends ElggObject {

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "visita";
        $this->attributes['fecha_visita'] = "";
        $this->attributes['departamento'] = "";
        $this->attributes['municipio'] = "";
        $this->attributes['institucion'] = "";
        $this->attributes['interesado'] = "";
        $this->attributes['observaciones'] = "";
        $this->attributes['tipo_comunicacion'] = "";
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    function save() {
        $user_guid = elgg_get_logged_in_user_guid();
        $this->attributes['owner_guid'] = $user_guid;
        $this->attributes['container_guid'] = $user_guid;
        $this->attributes['access_id'] = ACCESS_LOGGED_IN;
        $this->attributes['title'] = "visita de " . $user_guid;
        $this->attributes['description'] = "visita realizada el " . $this->attributes['fecha_visita'];



        $guid = parent::save();
        if ($guid) {
            create_metadata($guid, 'fecha_visita', $this->attributes['fecha_visita'], 'date', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'departamento', $this->attributes['departamento'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'municipio', $this->attributes['municipio'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'interesado', $this->attributes['interesado'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'observaciones', $this->attributes['observaciones'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'tipo_comunicacion', $this->attributes['tipo_comunicacion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            return $guid;
        }
        return false;
    }

}
