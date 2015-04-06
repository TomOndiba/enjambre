<?php
$guid_conv= get_input("convocatoria");
$guid=  get_input("investigacion");
$params = array('guid_conv' => $guid_conv, 'investigacion' => $guid);
$form = elgg_view_form('convocatorias/evaluadores_aceptados', null, $params);
echo $form;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

