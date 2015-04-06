<?php

class ElggFormInscripcionFeria extends ElggObject {

    function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "inscripcion_feria";
        $this->attributes['tipo_feria'] = "";
        $this->attributes['nombre_institucion'] = "";
        $this->attributes['rector_institucion'] = "";
        $this->attributes['municipio_dpto'] = "";
        $this->attributes['direccion_institucion'] = "";
        $this->attributes['telefono_institucion'] = "";
        $this->attributes['email_institucion'] = "";
        $this->attributes['nombre_grupo'] = "";
        $this->attributes['estudiantes_grupo'] = "";
        $this->attributes['maestros_grupo'] = "";
        $this->attributes['nivel_feria'] = "";
        $this->attributes['categorias_feria'] = "";
        $this->attributes['formas_participacion'] = "";
        $this->attributes['titulo_investigacion'] = "";
        $this->attributes['perturbacion_onda'] = "";
        $this->attributes['superposicion_onda'] = "";
        $this->attributes['trayectoria_indagacion'] = "";
        $this->attributes['resumen_conclusiones'] = "";
        $this->attributes['linea_tematica'] = "";
        $this->attributes['nombre_asesor'] = "";
        $this->attributes['area_feria'] = "";
        $this->attributes['materiales'] = "";
        $this->attributes['subcategorias_innovacion'] = "";
        $this->attributes['numero_inscripcion'] = "";
        $this->attributes['informe_investigacion'] = "";
        $this->attributes['escrito_profesor'] = "";
        $this->attributes['presentacion'] = "";
        
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        $guid = parent::save();
        $user = elgg_get_logged_in_user_entity();
        create_metadata($guid, 'nombre', $this->title, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'tipo_feria', $this->tipo_feria, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'nombre_institucion', $this->nombre_institucion, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'rector_institucion', $this->rector_institucion, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'municipio_dpto', $this->municipio_dpto, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'direccion_institucion', $this->direccion_institucion, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'telefono_institucion', $this->telefono_institucion, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'email_institucion', $this->email_institucion, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'nombre_grupo', $this->nombre_grupo, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'estudiantes_grupo', $this->estudiantes_grupo, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'maestros_grupo', $this->maestros_grupo, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'nivel_feria', $this->nivel_feria, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'categorias_feria', $this->categorias_feria, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'formas_participacion', $this->formas_participacion, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'titulo_investigacion', $this->titulo_investigacion, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'perturbacion_onda', $this->perturbacion_onda, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'superposicion_onda', $this->superposicion_onda, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'trayectoria_indagacion', $this->trayectoria_indagacion, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'resumen_conclusiones', $this->resumen_conclusiones, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'linea_tematica', $this->linea_tematica, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'nombre_asesor', $this->nombre_asesor, 'text', $user->guid, ACCESS_PUBLIC);        
        create_metadata($guid, 'area_feria', $this->area_feria, 'text', $user->guid, ACCESS_PUBLIC);                
        create_metadata($guid, 'materiales', $this->materiales, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'subcategorias_innovacion', $this->subcategorias_innovacion, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'numero_inscripcion', $this->numero_inscripcion, 'text', $user->guid, ACCESS_PUBLIC);
        
        
        return $guid;
    }

}
