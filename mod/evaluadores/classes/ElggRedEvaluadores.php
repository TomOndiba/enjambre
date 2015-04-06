<?php
/**
 * Grupo de evaluadores de proyectos presentados a convocatorias
 */
class ElggRedEvaluadores extends ElggGroup implements Friendable{
    
    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['name']= "evaluadores";
        $this->attributes['subtype']="RedEvaluadores";
        $this->attributes['access_id']=ACCESS_LOGGED_IN;
    }
    
    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }
    
    function save(){
        $user_guid = elgg_get_logged_in_user_guid();
        $this->attributes['owner_guid'] = $user_guid;
        $this->attributes['container_guid'] = $user_guid;
        $guid = parent::save();
        if($guid){
            return $guid;
        }
        return false;
        
    }
    
}