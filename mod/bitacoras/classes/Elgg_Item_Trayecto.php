<?php
/**
 * Clase que representa cada item de c/trayecto de la bitacora 5
 * @author DIEGOX_CORTEX
 */

class Elgg_Item_Trayecto extends ElggObject {

    //put your code here

  

    function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = "item_trayecto_bit5";
        
        /**
         * Para Bitacora 5
         */
        $this->attributes['totalAp'] = "";
        $this->attributes['totalDs'] = "";
        $this->attributes['ejecutado'] = "";
        $this->attributes['saldo'] = "";
        
        /**
         * Para Bitacora 5.1
         */
        $this->attributes['desc_gasto'] = "";
        $this->attributes['valr_unit'] = "";
        $this->attributes['vlr_tot_rub'] = "";
        $this->attributes['total'] = "";
        
        $this->attributes['access_id'] = ACCESS_PUBLIC;
    }

    function __construct($guid = null) {
        $this->initializeAttributes();
        parent::__construct($guid);
    }

    public function save() {
        
            
        $guid = parent::save();
        $user = elgg_get_logged_in_user_entity();
        
        /**
         * Para Bitacora 5
         */
        create_metadata($guid, 'totalAp', $this->totalAp, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'totalDs', $this->totalDs, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'ejecutado', $this->ejecutado, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'saldo', $this->saldo, 'text', $user->guid, ACCESS_PUBLIC);
        
        /**
         * Para Bitacora 5.1
         */
        create_metadata($guid, 'desc_gasto', $this->desc_gasto, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'valr_unit', $this->valr_unit, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'vlr_tot_rub', $this->vlr_tot_rub, 'text', $user->guid, ACCESS_PUBLIC);
        create_metadata($guid, 'total', $this->total, 'text', $user->guid, ACCESS_PUBLIC);
        
        
        return $guid;
       
    }
    
    

}