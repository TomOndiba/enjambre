<?php

/**
 * Clase que modela una fac
 * @author DIEGOX_CORTEX
 */
class Elgg_Faq extends ElggObject {

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "faqs";
        
        $this->attributes['category'] = "";
        $this->attributes['question'] = "";
        $this->attributes['answer'] = "";
        
        $this->attributes['access_id'] = ACCESS_LOGGED_IN;
        
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    function save() {
        $user_guid = elgg_get_logged_in_user_guid();

        $guid = parent::save();
        if ($guid) {
            create_metadata($guid, 'category', $this->attributes['category'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'question', $this->attributes['question'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            create_metadata($guid, 'answer', $this->attributes['answer'], 'text', $user_guid, ACCESS_LOGGED_IN, false);
            
            return $guid;
        }
        return false;
    }

}