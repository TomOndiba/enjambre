<?php

/**
 * Class representing a container for other elgg entities.
 *
 * @package    Elgg.Core
 * @subpackage Groups
 * 
 */
class ElggInvestigacion extends ElggGroup implements Friendable {

    function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "investigacion";
        $this->attributes['categoria_inv'] = "";
        $this->attributes['linea_tematica'] = "";
        $this->attributes['presupuesto'] = "";
        $this->attributes['puntaje_feria_municipal'] = "";
        $this->attributes['puntaje_feria_departamental'] = "";
        $this->attributes['elegible'] = "";
        $this->access_id = ACCESS_PUBLIC;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        $guid = parent::save();
        $user = elgg_get_logged_in_user_entity();
        create_metadata($guid, 'categoria_inv', $this->categoria, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'linea_tematica', $this->linea_tematica, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'elegible', $this->elegible, 'text', $user->guid, ACCESS_PUBLIC);
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
