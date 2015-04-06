<?php

class BitacoraDos extends ElggObject {

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->title = "Bitácora N° 2. La Pregunta";
        $this->attributes['subtype'] = "bitacora2";
        $this->attributes['sintesis'] = "";
        $this->attributes['p1'] = "";
        $this->attributes['p1s'] = "";
        $this->attributes['p1f'] = "";
        $this->attributes['p2'] = "";
        $this->attributes['p2s'] = "";
        $this->attributes['p2f'] = "";
        $this->attributes['p3'] = "";
        $this->attributes['p3s'] = "";
        $this->attributes['p3f'] = "";
        $this->attributes['p4'] = "";
        $this->attributes['p4s'] = "";
        $this->attributes['p4f'] = "";
        $this->attributes['p5'] = "";
        $this->attributes['p5s'] = "";
        $this->attributes['p5f'] = "";
        $this->attributes['discusion'] = "";
        $this->attributes['reflexion'] = "";
        $this->attributtes['status'] = "iniciativa";
        $this->attributes['pregunta'] = "";
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
