<?php
$lista = elgg_get_convocatorias_abiertas();


if(sizeof($lista)!=0){

echo "<ul class='list-inicio'>";
foreach($lista as $convocatoria){
    $url=  elgg_get_site_url();
    echo "<li>";
    echo "<div><span class='titulo-list-inicio'><a href='".$url."convocatorias/ver/".$convocatoria->guid."'>".$convocatoria->name."</a></span>"
            . "</div>";
    echo "</li>";
}
echo "</ul>";

}
else{
   echo "<br><span class='titulo-list-inicio'>No Hay Convocatorias Abiertas</span><br><br>";
}