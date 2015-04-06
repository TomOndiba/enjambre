<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
elgg_load_css("grupos");
$title = $vars['title'];
$buttons = $vars['buttons'];
$botones='<ul class="elgg-menu elgg-menu-ohyes-profile elgg-menu-ohyes-profile-default">';
$guid=$vars['red']['guid'];
foreach ($buttons as $button) {
    $href = $button['href'];
    $value = $button['value'];
    $botones.=" <li class='elgg-menu-item-info'><a class='ohyes-buttons-set elgg-button-submit' href='$href'>$value</a></li>";
}
$botones.="</ul>";
$url_imagen= $vars['red']['imagen'];
$descripcion=$vars['red']['descripcion'];
$menu= elgg_view('redes_tematicas/profile/menu_red', array('guid'=>$vars["red"]["guid"]));
$red = get_entity($guid);
$image=elgg_view_entity_icon($red, 'large', array(
					'href' => '',
					'width' => '',
					'height' => '',
				)); 

echo <<<HTML
<div class= 'ohyes-profile-container header-completo box' style=''>
<span class="ohyes-profile-menu"> 
       $botones
       <span class="ohyes-profile-infos">
           <div class="" style="margin-top: 20px;margin-left: 20px;">
               <div class="elgg-avatar elgg-avatar-large">
               $image
            </div></div>
        </span>

<span class="ohyes-profile-infos" style="margin-left: 300px;margin-top: -200px;width: 610px;">
	<h2 class="ohyes-profile-info-name" style="margin-top:20px;"> $title </h2>
        <p>$descripcion</p>
</span></span>
$menu    
</div>
HTML;


// <a href="$guid" class=""><img title="" class="ohyes-profile-picture" style="background:url($url_imagen); "></a></div>


                        
                       