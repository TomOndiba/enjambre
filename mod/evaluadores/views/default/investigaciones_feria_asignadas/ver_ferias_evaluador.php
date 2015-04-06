<?php

elgg_load_js('pagination/ferias_evaluador');
elgg_load_js("investigaciones-evaluador-feria");
//elgg_load_js("investigaciones-evaluador");

$offset = get_input('offset');

$ajax = get_input('ajax');
$limit = 10;
$user=  elgg_get_logged_in_user_entity();

?>
<div class='titulo-coordinacion'>
<h2>Ferias a las que está inscrito</h2>
</div>
<ul class="tabs-coordinacion">
    <li id="mun" class="selected">
        <a id="mun" href="#municipal-inicial" class="ver-lista-investigaciones-feria" name="municipal" rel="nofollow" onclick="get_ferias_mun_evaluador(<?php echo elgg_get_logged_in_user_guid()?>)">Ferias Municipales</a>
    </li>
    <li id="dptal"><a href="#departamental-inicial" id="dptal" class="ver-lista-investigaciones-feria" name="departamental" title="" rel="nofollow" onclick="get_ferias_dep_evaluador(<?php echo elgg_get_logged_in_user_guid()?>)">Ferias Departamentales</a></li>
</ul>
<div id="ajax-ferias0">
</div>
