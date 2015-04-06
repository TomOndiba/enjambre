<?php

$options = array(
    'type' => 'group',
    'subtype' => 'grupo_investigacion',
    'limit' => 15,
);
$entities = elgg_get_entities($options);
$resultado = "";
$i = 0;
foreach ($entities as $entity) {
    if ($i < 15) {
        $grupo = new ElggGrupoInvestigacion($entity->guid);
        $resultado.="<li class='item-galeria-imagenes'><img src='{$grupo->getIconURL()}' title='$grupo->name' style='height:94%; margin:3%; border-radius:5px;'></img></li>";
    }
    $i++;
}
echo $resultado;
