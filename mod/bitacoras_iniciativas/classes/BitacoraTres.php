<?php

class BitacoraTres extends ElggObject {

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->title = "Bitácora N° 3. El Problema de Investigación";
        $this->attributes['subtype'] = "bitacora3";
        $this->attributes['campo1'] = "";
        $this->attributes['campo2'] = "";
        $this->attributes['campo3'] = "";
        $this->attributtes['status'] = "iniciativa";
        $this->access_id = ACCESS_PUBLIC;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        $guid = parent::save();
        return $guid;
    }
    
    
    public function getInvestigacion() {
        if ($this->status == 'iniciativa') {
            return new ElggCuadernoCampo($this->investigacion);
        } else {
            return new ElggInvestigacion($this->investigacion);
        }
    }

    public function getIntegrantes() {
        return $this->filtarIntegrantes(
                        elgg_get_entities_from_relationship(array(
                    'relationship' => 'hace_parte_de',
                    'relationship_guid' => $this->owner_guid,
                    'inverse_relationship' => true,
                    'limit' => 0)));
    }

    public function getGrupoInvestigacion() {
        return elgg_get_entities_from_relationship(array(
                    'relationship' => 'tiene_cuaderno_campo',
                    'relationship_guid' => $this->owner_guid,
                    'inverse_relationship' => true))[0];
    }

    public function getInstitucion($grupo) {
        return elgg_get_entities_from_relationship(array(
                    'relationship' => 'pertenece_a',
                    'relationship_guid' => $grupo->guid,
                    'inverse_relationship' => false))[0];
    }

    public function getIntegrantesGrupo($grupo, $integrantes_investigacion) {
        $integrantes_grupo = elgg_get_entities_from_relationship(array(
            'relationship' => 'es_miembro_de',
            'relationship_guid' => $grupo->guid,
            'inverse_relationship' => true,
            'limit' => 0));
        return $this->filtarIntegrantesGrupo($integrantes_grupo, $integrantes_investigacion);
    }

    private function filtarIntegrantes($integrantes) {
        $estudiantes = array();
        $maestros = array();
        foreach ($integrantes as $integrante) {
            if ($integrante->subtype == '13') {
                array_push($maestros, $integrante);
            } else {
                array_push($estudiantes, $integrante);
            }
        }
        return array('estudiantes' => $estudiantes,
            'maestros' => $maestros);
    }

    private function filtarIntegrantesGrupo($integrantes_grupo, $integrantes_investigacion) {
        $estudiantes = array();
        $maestros = array();
        foreach ($integrantes_grupo as $integrante) {
            if (!$this->esIntegrante($integrante, $integrantes_investigacion)) {
                if ($integrante->subtype == '13') {
                    array_push($maestros, $integrante);
                } else {
                    array_push($estudiantes, $integrante);
                }
            }
        }
        return array('estudiantes' => $estudiantes,
            'maestros' => $maestros);
    }

    private function esIntegrante($integrante, $integrantes_investigacion) {
        foreach ($integrantes_investigacion as $i) {
            if ($integrante->guid == $i->guid) {
                return true;
            }
        }
        return false;
    }
}

