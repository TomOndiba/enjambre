<?php
/**
 * Clase que representa una convocatoria.
 */
class ElggConvocatoria extends ElggGroup implements Friendable {

    function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "convocatoria";
        $this->attributes['tipo_convocatoria'] = "";
        $this->attributes['departamento'] = "";
        $this->attributes['convenio'] = "";
        $this->attributes['fecha_apertura'] = "";
        $this->attributes['fecha_cierre'] = "";
        $this->attributes['hora_cierre'] = "";
        $this->attributes['fecha_pub_resultados'] = "";
        $this->attributes['requisitos'] = "";
        $this->attributes['proceso_pedagogico'] = "";
        $this->attributes['objetivos'] = "";
        $this->attributes['publico'] = "";
        $this->attributes['no_aplica'] = "";
        $this->attributes['criterios_revision_seleccion'] = "";
        $this->attributes['presupuesto'] = "";
        $this->attributes['especial'] = false;
        $this->access_id=ACCESS_PUBLIC;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
            $guid = parent::save();
            $user = elgg_get_logged_in_user_entity();
            create_metadata($guid, 'nombre', $this->name, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'tipo_convocatoria', $this->tipo_convocatoria, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'departamento', $this->departamento, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'convenio', $this->convenio, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'fecha_apertura', $this->fecha_apertura, 'date', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'fecha_cierre', $this->fecha_cierre, 'date', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'hora_cierre', $this->hora_cierre, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'fecha_pub_resultados', $this->fecha_pub_resultados, 'date', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'requisitos', $this->requisitos, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'proceso_pedagogico', $this->proceso_pedagogico, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'objetivos', $this->objetivos, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'publico', $this->publico, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'no_aplica', $this->no_aplica, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'presupuesto', $this->presupuesto, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'especial', $this->especial, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'criterios_revision_seleccion', $this->criterios_revision_seleccion, 'text', $user->guid, ACCESS_PUBLIC);
            return $guid;
        }
}
