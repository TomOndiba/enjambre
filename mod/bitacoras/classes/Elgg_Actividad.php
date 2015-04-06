<?php

/**
 * Clase que representa una actividad del cronograma de actividades para la bitacora 4
 * @author DIEGOX_CORTEX
 */
class Elgg_Actividad extends ElggObject {

    //put your code here



    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "actividad_bitacora4";
        $this->attributes['nombre'] = "";
        $this->attributes['responsable'] = "";
        $this->attributes['fecha_desde'] = "";
        $this->attributes['fecha_hasta'] = "";
        $this->attributes['access_id'] = ACCESS_PUBLIC;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        
        $guid = parent::save();
        $user = elgg_get_logged_in_user_entity();
        create_metadata($guid, 'nombre', $this->nombre, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'responsable', $this->responsable, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'fecha_desde', $this->fecha_desde, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'fecha_hasta', $this->fecha_hasta, 'text', $user->guid, ACCESS_PUBLIC);
        return $guid;
       
    }

}
