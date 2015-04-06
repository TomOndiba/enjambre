<?php

/**
 * Class representing a container for other elgg entities.
 *
 * @package    Elgg.Core
 * @subpackage Groups
 * 
 * @property string $website   Dirección de Sitio web del institucion
 * @property string $email   Dirección email del institucion
 * @property string $direccion   Dirección actual del institucion
 * @property string $tipo   Tipó de grupo por default institucion
 * @property string $telefono   Telefono del institucion
 * 
 */
class ElggInstitucion extends ElggGroup implements Friendable {

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->subtype = "institucion";
        $this->attributes['direccion'] = "";
        $this->attributes['telefono'] = "";
        $this->attributes['director'] = "";
        $this->attributes['email'] = "";
        $this->attributes['website'] = "";
        $this->access_id= ACCESS_PUBLIC;
        $this->attributes['departamento']="";
        $this->attributes['municipio']="";
        $this->attributes['corregimiento']="";
        $this->attributes['tipo_institucion']="";
        
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
       
        if (elgg_existe_institucion($this->name)) {
            return false;
        } else {
            $guid = parent::save();
            $user = elgg_get_logged_in_user_entity();
            create_metadata($guid, 'direccion', $this->direccion, 'text', $user->guid, ACCESS_PUBLIC,false);
            create_metadata($guid, 'telefono', $this->telefono, 'text', $user->guid, ACCESS_PUBLIC,false);
            create_metadata($guid, 'director', $this->director, 'text', $user->guid, ACCESS_PUBLIC,false);
            create_metadata($guid, 'email', $this->email, 'text', $user->guid, ACCESS_PUBLIC,false);
            create_metadata($guid, 'website', $this->website, 'text', $user->guid, ACCESS_PUBLIC,false);
            create_metadata($guid, 'departamento', $this->departamento, 'text', $user->guid, ACCESS_PUBLIC,false);
            create_metadata($guid, 'municipio', $this->municipio, 'text', $user->guid, ACCESS_PUBLIC,false);
            create_metadata($guid, 'corregimiento', $this->corregimiento, 'text', $user->guid, ACCESS_PUBLIC, false);
            create_metadata($guid, 'tipo_institucion', $this->tipo_institucion, 'text', $user->guid, ACCESS_PUBLIC, false);
            return $guid;
        }
    }
    
    public function getUrl(){
        return elgg_get_site_url()."instituciones/ver/{$this->guid}";
    }

}
