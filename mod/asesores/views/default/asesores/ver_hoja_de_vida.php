<?php
elgg_load_js("hoja_de_vida");
$header = "<div class='titulo-coordinacion'>";
$header .="<h2>Hoja de Vida</h2>";
$header.="</div>";
echo $header;
?>

<ul class="tabs-coordinacion-2">
    <li id="estudiosterminados" class="selected"><a href="#estudiosterminados" class="item-hoja" name="estudiosterminados" rel="nofollow">Estudios Terminados</a></li>
    <li id="cursosterminados" ><a href="#cursosterminados" class="item-hoja" name="cursosterminados" rel="nofollow">Cursos y Diplomados</a></li>
    <li id="experiencia" ><a href="#experiencia" class="item-hoja" name="experiencia" rel="nofollow">Experiencia</a></li>
    <li id="investigacion" ><a href="#investigacion" class="item-hoja" name="investigacion" rel="nofollow">Investigacion</a></li>
    <li id="ponencias" ><a href="#ponencias" class="item-hoja" name="ponencias" rel="nofollow">Ponencias y Publicaciones</a></li>
</ul><br>
<div id="ajax-hoja-vida">
</div>