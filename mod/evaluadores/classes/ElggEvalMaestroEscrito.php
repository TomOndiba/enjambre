<?php

/**
 * Clase que modela una evaluacion de ponencia del Maestro(a)
 *
 *
 * @author CORTEX_DIEGOX
 */
class ElggEvalMaestroEscrito extends ElggObject {

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "evaluacion_maestro_escrito";
        //Datos varios
        $this->attributes['municipio_dpto'] = "";
        $this->attributes['institucion'] = "";
        $this->attributes['name_maestro'] = "";
        $this->attributes['name_grupo'] = "";
        $this->attributes['name_ponencia'] = "";
        $this->attributes['name_eval'] = "";
        $this->attributes['profesion_eval'] = "";
        $this->attributes['institucion_eval'] = "";

        //Aspectos valoracion y puntajes        
        $this->attributes['visible_reflexiones'] = "";
        $this->attributes['puntaje_visible_reflexiones'] = "";
        $this->attributes['practica_pedagogica'] = "";
        $this->attributes['puntaje_practica_pedagogica'] = "";
        $this->attributes['aprendizajes_propios'] = "";
        $this->attributes['puntaje_aprendizajes_propios'] = "";
        $this->attributes['reflexion_presentada'] = "";
        $this->attributes['puntaje_reflexion_presentada'] = "";
        $this->attributes['puntaje_total'] = "";
        $this->attributes['obs'] = "";
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    function save() {
        $user_guid = elgg_get_logged_in_user_guid();

        $guid = parent::save();
        if ($guid) {
            create_metadata($guid, 'municipio_dpto', $this->attributes['municipio_dpto'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'institucion', $this->attributes['institucion'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'name_maestro', $this->attributes['name_maestro'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'name_grupo', $this->attributes['name_grupo'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'name_ponencia', $this->attributes['name_ponencia'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'name_eval', $this->attributes['name_eval'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'profesion_eval', $this->attributes['profesion_eval'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'institucion_eval', $this->attributes['institucion_eval'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            
            create_metadata($guid, 'visible_reflexiones', $this->attributes['visible_reflexiones'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_visible_reflexiones', $this->attributes['puntaje_visible_reflexiones'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'practica_pedagogica', $this->attributes['practica_pedagogica'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_practica_pedagogica', $this->attributes['puntaje_practica_pedagogica'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'aprendizajes_propios', $this->attributes['aprendizajes_propios'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_aprendizajes_propios', $this->attributes['puntaje_aprendizajes_propios'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'reflexion_presentada', $this->attributes['reflexion_presentada'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_reflexion_presentada', $this->attributes['puntaje_reflexion_presentada'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'puntaje_total', $this->attributes['puntaje_total'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'obs', $this->attributes['obs'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
           
            return $guid;
        }
        return false;
    }

}
