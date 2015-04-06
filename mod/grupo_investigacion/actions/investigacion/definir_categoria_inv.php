<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$grupo=  get_input('grupo');
$investigacion= get_input('investigacion');
$categoria= get_input('categoria');

if(!empty($categoria)){
    $inv=new ElggInvestigacion($investigacion);
    $inv->categoria=$categoria;
    $guid=$inv->save();
    if($guid){
        system_message(elgg_echo("investigacion:categoria:ok"));
        forward('/investigaciones/ver/'.$guid."/grupo/".$grupo);
    }else{
        register_error(elgg_echo("investigacion:categoria:error"));
        forward(REFERER);
    }

}else{
    forward(REFERER);
}

