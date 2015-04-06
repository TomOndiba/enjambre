<?php
$lista = elgg_get_ferias_abiertas();



if(sizeof($lista)!=0){
echo "<ul class='list-inicio'>";
foreach($lista as $feria){
    $url=  elgg_get_site_url();
    echo "<li>";
    echo "<div><span class='titulo-list-inicio'><a href='".$url."feria/ver/".$feria->guid."'>".$feria->name."</a></span>"
            . "</div>";
    echo "</li>";
}
echo "</ul>";
}
else{
    echo "<br><span class='titulo-list-inicio'>No Hay Ferias Abiertas</span><br><br>";
}