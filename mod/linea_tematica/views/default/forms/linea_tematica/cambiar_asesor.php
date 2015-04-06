<?php

$red = get_input('red');
$rol_asesor = elgg_get_rol_by_name("Asesor");
$options = array('relationship' => 'tiene_el_rol_de',
    'relationship_guid' => $rol_asesor->guid,
    'inverse_relationship' => true);
$asesores = elgg_get_entities_from_relationship($options);
$asesores_red = elgg_get_entities_from_relationship(array(
    'relationship' => 'administrador_red',
    'relationship_guid' => $red,
    'inverse_relationship' => true
));
$form_content = "";
$form_asignados = "<div>";
$site = elgg_get_site_url();
foreach ($asesores as $asesor) {
    $bandera = true;
    foreach ($asesores_red as $asesor_red) {
        if ($asesor_red->guid == $asesor->guid) {
            $bandera = false;
        }
    }
    if ($bandera) {
        $as = get_entity($asesor->guid);
        $form_content.= "<div style='width:48%; display:inline-block;'><input type='radio' name='asesor' value='{$asesor->guid}' />"
                . "<a href='{$site_url}profile/{$as->username}'><div class='row'><img src='{$as->getIconURL()}' width='50' />"
                . "</div><div class='row' style='margin-left:10px;font-weight:700;'>"
                . "<span>{$asesor->name} {$asesor->apellidos}</span><br>"
                . "<span style='color:black;font-weight:400;'>$lin2</span></div></a></div>";
    }else{        
        $as = get_entity($asesor->guid);
        $url = $site."action/linea_tematica/quitar_asesor?red={$red}&asesor={$asesor->guid}";
        $url_action = elgg_add_action_tokens_to_url($url);
        $form_asignados.= "<div style='width:48%; display:inline-block;'>"
                . "<a href='{$site_url}profile/{$asesor->username}'><div class='row'><img src='{$as->getIconURL()}' width='50'/>"
                . "</div><div class='row' style='margin-left:10px;font-weight:700;'>"
                . "<span>{$asesor->name} {$asesor->apellidos}</span><br>"
                . "<span><a style='font-weight:normal;' href='{$url_action}'>Quitar<a></span>"
                . "<span style='color:black;font-weight:400;'>$lin2</span></div></a></div>";
    }
}
echo "<p>Asesores asignados a red</p><br>";
echo $form_asignados . "</div><br><hr>";
echo "<p>Asesores: </p>";
echo $form_content;
echo "<input type='hidden' id='red' value='{$red}' name='red'/>";
echo "<div style='height:50px'><input type='submit' value='Asignar'/></div>";
