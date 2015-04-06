<?php
/**
 * Clase que representa una convocatoria.
 */
class ElggFeria extends ElggGroup implements Friendable {

    function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "feria";
        $this->attributes['descripcion'] = "";
        $this->attributes['objetivos'] = "";
        $this->attributes['correos_contacto'] = "";
        $this->attributes['fecha_inicio_feria'] = "";
        $this->attributes['fecha_fin_feria'] = "";
        $this->attributes['fecha_inicio_inscripciones'] = "";
        $this->attributes['fecha_fin_inscripciones'] = "";
        $this->attributes['valor_inscripcion'] = "";
        $this->attributes['fecha_montaje_puestos'] = "";
        $this->attributes['hora_montaje_puestos'] = "";
        $this->attributes['fecha_desmontaje_puestos'] = "";
        $this->attributes['hora_desmontaje_puestos'] = "";
        $this->attributes['tipo_feria'] = "";
        $this->attributes['departamento'] = "";
        $this->attributes['municipios'] = "";
        $this->attributes['institucion'] = "";
        $this->attributes['tipo_feria'] = "";
        $this->attributes['formas_participacion'] = "";
        $this->attributes['max_inscritos'] = "";
        $this->attributes['premios_distinciones'] = "";
        $this->attributes['actividades'] = "";
        $this->attributes['requisitos_participacion'] = "";
        $this->attributes['publico_invitado'] = "";
        $this->attributes['costos_organizadores'] = "";
        $this->attributes['parametros_puestos'] = "";
        $this->attributes['herramientas_presentaciones'] = "";
        $this->attributes['proceso_valoracion'] = "";
        $this->attributes['agenda_feria'] = "";
        $this->attributes['reglamento_feria'] = "";
        $this->attributes['consecutivo_inscripcion'] = "";
        $this->attributes['participo_en_departamental'] = "";
        $this->attributes['estado'] = "";
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
            create_metadata($guid, 'descripcion', $this->descripcion, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'objetivos', $this->objetivos, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'correos_contacto', $this->correos_contacto, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'fecha_inicio_feria', $this->fecha_inicio_feria, 'date', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'fecha_fin_feria', $this->fecha_fin_feria, 'date', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'fecha_inicio_inscripciones', $this->fecha_inicio_inscripciones, 'date', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'fecha_fin_inscripciones', $this->fecha_fin_inscripciones, 'date', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'valor_inscripcion', $this->valor_inscripcion, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'fecha_montaje_puestos', $this->fecha_montaje_puestos, 'date', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'hora_montaje_puestos', $this->hora_montaje_puestos, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'fecha_desmontaje_puestos', $this->fecha_desmontaje_puestos, 'date', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'hora_desmontaje_puestos', $this->hora_desmontaje_puestos, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'tipo_feria', $this->tipo_feria, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'departamento', $this->departamento, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'municipios', $this->municipios, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'institucion', $this->institucion, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'formas_participacion', $this->formas_participacion, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'max_inscritos', $this->max_inscritos, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'consecutivo_inscripcion', $this->consecutivo_inscripcion, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'participo_en_departamental', $this->participo_en_departamental, 'text', $user->guid, ACCESS_PUBLIC);
            create_metadata($guid, 'estado', $this->estado, 'text', $user->guid, ACCESS_PUBLIC);
            return $guid;
        }
}
