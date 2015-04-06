<?php

$intituciones=$vars['instituciones'];
foreach($intituciones as $institucion){
    echo $institucion."<br>";
}
$roles= $_SESSION['roles'];
foreach($roles as $rol){
    echo $rol['nombre'];
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

