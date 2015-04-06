<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ElggUsuario extends ElggUser implements Friendable {

    function initializeAttributes() {
        parent::initializeAttributes();


        $this->attributes['apellidos'] = "";
        $this->attributes['sexo'] = "";
        $this->attributes['tipo_documento'] = "";
        $this->attributes['numero_documento'] = "";
        $this->attributes['pais_nacimiento'] = "";
        $this->attributes['departamento_nacimiento'] = "";
        $this->attributes['municipio_nacimiento'] = "";
        $this->attributes['fecha_nacimiento'] = "";
        $this->attributes['barrio'] = "";
        $this->attributes['direccion'] = "";
        $this->attributes['telefono'] = "";
        $this->attributes['celular'] = "";
        $this->attributes['grupo_etnico'] = "";
        $this->attributes['curso'] = "";
        $this->attributes['admin'] = 'yes';
    }

    public function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save_estudiante() {

        $this->attributes['subtype'] = "estudiante";
        $this->attributes['vive'] = "";
        $this->attributes['zona'] = "";
        $this->attributes['tiempo_libre'] = "";
        $guid = parent::save();

        $entidad = elgg_get_site_entity();
        
        create_metadata($guid, 'apellidos', $this->apellidos, 'text', $entidad->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'sexo', $this->sexo, 'text', $entidad->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'tipo_documento', $this->tipo_documento, 'text', $entidad->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'numero_documento', $this->numero_documento, 'text', $entidad->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'fecha_nacimiento', $this->fecha_nacimiento, 'text', $entidad->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'grupo_etnico', $this->grupo_etnico, 'text', $entidad->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'curso', $this->curso, 'text', $entidad->guid, ACCESS_PUBLIC);


        return $guid;
    }

    public function save_maestro() {

        $this->attributes['subtype'] = "maestro";
        $this->attributes['titulo'] = "";
        $this->attributes['especialidad'] = "";
        $this->attributes['universidad'] = "";
        $this->attributes['anio'] = "";
        $guid = parent::save();
        $entidad = elgg_get_site_entity();

        create_metadata($guid, 'apellidos', $this->apellidos, 'text', $entidad->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'sexo', $this->sexo, 'text', $entidad->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'tipo_documento', $this->tipo_documento, 'text', $entidad->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'numero_documento', $this->numero_documento, 'text', $entidad->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'fecha_nacimiento', $this->fecha_nacimiento, 'text', $entidad->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'grupo_etnico', $this->grupo_etnico, 'text', $entidad->guid, ACCESS_PUBLIC);


        return $guid;
    }

}
