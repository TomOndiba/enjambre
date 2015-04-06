<?php
    $guid_grupo=$vars['guid'];
    $url= elgg_get_site_url();
    $items="<li>"
            ."<div class='tittle-menu-list-grupo'><a id='muro' href='{$url}grupo_investigacion/ver/{$guid_grupo}'/>Muro</a></div> "
            . "<div class='bottom-bar'></div>"
            ."</li>"
            ."<li>"
            ."<div class='tittle-menu-list-grupo'><a id='archivos'>Archivos</a></div> "
            . "<div class='bottom-bar'></div>"
            ."</li>"
            ."<li>"
            ."<div class='tittle-menu-list-grupo'><a id='fotos'>Fotos</a></div>"
            . "<div class='bottom-bar'></div>"
            ."</li>"
            ."<li>"
            ."<div class='tittle-menu-list-grupo'><a id='videos'>Videos</a></div>"
            . "<div class='bottom-bar'></div>"
            . "</li>"
            ."<li>"
            ."<div class='tittle-menu-list-grupo'><a id='foros'>Foros</a></div>"
            . "<div class='bottom-bar'></div>"
            . "</li>"
            ."<li>"
            ."<div class='tittle-menu-list-grupo'><a href='{$url}grupo_investigacion/ver/{$guid_grupo}/calendario' id='calendario'>Calendario</a></div>"
            . "<div class='bottom-bar'></div>"
            . "</li>"
            
?>

<div class="menu-header-grupo-investigacion">
    <ul>
    <?php
        echo $items;
    ?>
    </ul>
</div>