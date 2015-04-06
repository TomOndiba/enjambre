<?php
elgg_load_js('pagination/member');

$red = $vars['red'];
echo '<div class="list-grupos" style="margin-left: 20px; margin-top: 25px">
    <h2 class="title-legend">Investigaciones de la Red</h2>';

$investigaciones = elgg_get_entities_from_relationship(array(
        'relationship' => 'pertenece_a_red',
        'relationship_guid'=> $red,
        'inverse_relationship'=>true));
foreach($investigaciones as $investigacion){
    $grupo = elgg_get_entities_from_relationship(array(
        'relationship'=>'tiene_la_investigacion',
        'relationship_guid'=>$investigacion->guid,
        'inverse_relationship'=>true
    ))[0];
    $print= "<div style='width:90%; margin-left:3%; margin-top:20px; padding:2%; background-color:white'>"
            . "<a style='color:black; font-weight:700; font-size:16px;' href='#'>Investigacion: $investigacion->name</a><br>"
            . "<a href='#'>Grupo de Investigación: {$grupo->name}</a>"
            . "</div>";
    echo $print;
}
?>
</div>