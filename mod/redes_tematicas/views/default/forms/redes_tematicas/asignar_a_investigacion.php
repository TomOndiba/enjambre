<?php
$redes = elgg_get_all_redes();
$form_content = "";
foreach($redes as $red){
    $as = get_entity($red->guid);
    $form_content.= "<div><input type='radio' name='red' value='{$red->guid}' />"
    . "<a><div class='row'><img src='{$red->getIconURL()}' width='50' />"
    . "</div><div class='row' style='margin-left:10px;font-weight:700;'>"
            . "<span>{$red->name}</span><br>"
            . "<span style='color:black;font-weight:400;'>$lin2</span></div></a></div>";
}
echo $form_content;
echo "<input type='hidden' id='investigacion' value='' name='investigacion'/>";
echo "<div style='height:50px'><input type='submit' value='Asignar'/></div>";