<?php

/**
 * Clase que modela una evaluacion de una investigacion
 *
 *
 * @author Erika Parra
 */
class ElggEvaluacionAsesor extends ElggObject {

    protected function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "evaluacion_asesor";
        $this->attributes['estudios'] = "";
        $this->attributes['experiencia'] = "";
        $this->attributes['total'] = "";
        
    }

    function __construct($guid = null) {
       
        $this->initializeAttributes();
        parent::__construct($guid);
        
    }

    function save() {
        $user_guid = elgg_get_logged_in_user_guid();
        
        $guid = parent::save();
        if ($guid) {
            create_metadata($guid, 'experiencia', $this->experiencia, 'integer', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'estudios', $this->estudios, 'integer', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'total', $this->total, 'integer', $user_guid, ACCESS_LOGGED_IN, false);
            return $guid;
        }
        return false;
    }

    function update($experiencia, $estudios, $total) {
        $user = elgg_get_logged_in_user_entity();
        if ($this->experiencia != $experiencia) {
            $options = array(
                'guid' => $this->guid,
                'metadata_name' => '$experiencia',
                'limit' => false
            );
            $g = elgg_delete_metadata($options);
            if (!is_null($experiencia) && ($experiencia !== '')) {
                create_metadata($this->guid, 'experiencia', $experiencia, 'integer', $user->guid, ACCESS_PUBLIC);
            }
        }if ($this->estudios != $estudios) {
            $options = array(
                'guid' => $this->guid,
                'metadata_name' => '$estudios',
                'limit' => false
            );
            $g = elgg_delete_metadata($options);
            if (!is_null($estudios) && ($estudios !== '')) {
                create_metadata($this->guid, 'estudios', $estudios, 'integer', $user->guid, ACCESS_PUBLIC);
            }
        }if ($this->total != $total) {
            $options = array(
                'guid' => $this->guid,
                'metadata_name' => '$total',
                'limit' => false
            );
            $g = elgg_delete_metadata($options);
            if (!is_null($total) && ($total !== '')) {
                create_metadata($this->guid, 'total', $total, 'integer', $user->guid, ACCESS_PUBLIC);
            }
        }
    }

}
