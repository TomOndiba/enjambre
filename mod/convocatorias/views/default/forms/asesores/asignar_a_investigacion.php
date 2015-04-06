<?php
$convocatoria = $vars['guid_convocatoria'];
$options = array('relationship'=> 'asesor_convocatoria',
        'relationship_guid'=>$convocatoria,
    'inverse_relationship' => true);
$asesores = elgg_get_entities_from_relationship($options);
$form_content = "";
foreach($asesores as $asesor){
    $as = get_entity($asesor->guid);
    $form_content.= "<div><input type='radio' name='asesor' value='{$asesor->guid}' />"
    . "<a href='{$site_url}profile/{$as->username}'><div class='row'><img src='{$as->getIconURL()}' width='50' />"
    . "</div><div class='row' style='margin-left:10px;font-weight:700;'>"
            . "<span>{$asesor->name} {$asesor->apellidos}</span><br>"
            . "<span style='color:black;font-weight:400;'>$lin2</span></div></a></div>";
}
echo $form_content;
echo "<input type='hidden' id='investigacion' value='' name='investigacion'/>";
echo "<div style='height:50px'><input type='submit' value='Asignar'/></div>";