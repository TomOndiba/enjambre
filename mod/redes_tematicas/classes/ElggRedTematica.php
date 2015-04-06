<?php

class ElggRedTematica extends ElggGroup implements Friendable {

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "red_tematica";
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {

        $guid = parent::save();

        return $guid;
    }

    public function getMembers($limit = 10, $offset = 0, $count = false) {
        return elgg_get_entities_from_relationship(array(
            'relationship' => 'es_miembro_de',
            'relationship_guid' => $this->guid,
            'inverse_relationship' => TRUE,
            'type' => 'user',
            'limit' => $limit,
            'offset' => $offset,
            'count' => $count,
            'site_guid' => $site_guid
        ));
    }
    
    public function getUrl(){
        $url= elgg_get_site_url();
        return "{$url}redes_tematicas/ver/{$this->guid}/";
    }
            

}
