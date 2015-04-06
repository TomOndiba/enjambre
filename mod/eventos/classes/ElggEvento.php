<?php

/**
 * Class representing a container for other elgg entities.
 *
 * @package    Elgg.Core
 * @subpackage Groups
 * 
 * 
 */
class ElggEvento extends ElggObject {

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "evento";
        $this->attributes['tipo_evento'] = "";
        $this->attributes['nombre_evento'] = "";
        $this->attributes['fecha_inicio'] = "";
        $this->attributes['fecha_terminacion'] = "";
        $this->attributes['fecha_limite_confirmacion'] = "";
        $this->attributes['lugar'] = "";
        $this->attributes['max_asistentes'] = "";
        $this->attributes['objetivo'] = "";
        $this->attributes['dirigido_a'] = "";
        $this->attributes['requisitos_evento'] = "";
        $this->attributes['hora']="";
        $this->attributes['horaFin']="";
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        $guid = parent::save();
        $user = elgg_get_logged_in_user_entity();
        create_metadata($guid, 'tipo_evento', $this->tipo_evento, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'nombre_evento', $this->nombre_evento, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'fecha_inicio', $this->fecha_inicio, 'date', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'fecha_terminacion', $this->fecha_terminacion, 'date', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'fecha_limite_confirmacion', $this->fecha_limite_confirmacion, 'date', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'lugar', $this->lugar, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'max_asistentes', $this->max_asistentes, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'objetivo', $this->objetivo, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'dirigido_a', $this->dirigido_a, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'requisitos_evento', $this->requisitos_evento, 'text', $user->guid, ACCESS_PUBLIC);
        return $guid;
    }
    
    public function saveEventoGrupo(){
        $guid=  parent::save();
        $user=  elgg_get_logged_in_user_entity();
        create_metadata($guid, 'hora', $this->hora, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'horaFin', $this->horaFin, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'nombre_evento', $this->nombre_evento, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'fecha_inicio', $this->fecha_inicio, 'date', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'fecha_terminacion', $this->fecha_terminacion, 'date', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'lugar', $this->lugar, 'text', $user->guid, ACCESS_PUBLIC);
    }
    public function registrarInscripcion($guid_user){
        return add_entity_relationship($guid_user, "inscrito_al_evento", $this->guid);
    }
    
    public function eliminarInscripcion($guid_user){
        return remove_entity_relationship($guid_user, "inscrito_al_evento", $this->guid);
    }
    
    public function verificarInscripcionUsuario($guid_user){
      
        return check_entity_relationship($guid_user, "inscrito_al_evento", $this->guid);
    }
    
    public function verificarAsistenciaUsuario($guid_user){
        return check_entity_relationship($guid_user, "asistió_al_evento", $this->guid);
    }
    
}
