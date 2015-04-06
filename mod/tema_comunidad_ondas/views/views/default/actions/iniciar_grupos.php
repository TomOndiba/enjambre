<?php

$asesores= new ElggGroup();
$evaluadores= new ElggGroup();
$evaluadores->subtype="RedEvaluadores";
$asesores->name="asesores";
$guid_1= $evaluadores->save();
$guid_2=$asesores->save();
echo "asesores:$guid_1, evaluadores:$guid_2";
