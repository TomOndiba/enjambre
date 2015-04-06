<?php
$offset = get_input('offset');
$ajax = get_input('ajax');

$limit = 4;
$user=  elgg_get_logged_in_user_entity();

echo "<input type='hidden' id='tipo' value='mun'/>";

if (!$ajax) {
    
echo "<div id='paginable' class='elgg-image-block clearfix'>";
echo elgg_get_ferias_mun_evaluador($limit, 0, $user);
echo "</div>";

}else{ 
  
    echo elgg_get_ferias_mun_evaluador($limit, $offset, $user);
}