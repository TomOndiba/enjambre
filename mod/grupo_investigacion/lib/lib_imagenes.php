<?php

function elgg_get_album_muro($guid){
    $albunes= elgg_get_albunes_owner($guid);
    for($i=0; $i<count($albunes); $i++){
        if(strnatcasecmp($albunes[$i]->title,"Fotos De Muro")==0){
            return $albunes[$i]->guid;
        }
    }
    return null;
}

function elgg_get_album_perfil($guid){
    $albunes= elgg_get_albunes_owner($guid);
    for($i=0; $i<count($albunes); $i++){
        if(strnatcasecmp($albunes[$i]->title,"Fotos De Perfil")==0){
            return $albunes[$i]->guid;
        }
    }
    return null;
}

