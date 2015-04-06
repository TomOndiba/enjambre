<ul>
    <?php
    $button = elgg_view('input/submit', array('value' => elgg_echo('Eliminar'), 'id' => 'boton-eliminar-mensajes', 'style' => 'display:none'));
    echo $button;
    $mensajes = $vars['mensajes'];
    if (sizeof($mensajes) > 0) {
        foreach ($mensajes as $mensaje) {
            $leido = $mensaje->readYet;
            $emisor = get_entity($mensaje->toId);
            $url = elgg_get_site_url() . "profile/{$emisor->username}";
            $url_emisor = "<a href='{$url}'>{$emisor->name} {$emisor->apellidos}</a>";
            $url_msj = elgg_get_site_url() . "mensajes/ver/" . $mensaje->guid;
            $time = $mensaje->time_created;
            $fecha = date("Y-m-d H:i:s", $time);
            $asunto = '';
            if(empty($mensaje->title)){
                $asunto = 'Sin asunto';
            }else{
                $asunto = $mensaje->title;
            }
            
            ?>
            <li>
                <div class="checkbox-mensaje">
                    <input type="checkbox" name="mensajes[]" value="<?php echo $mensaje->guid; ?>"/>
                </div>
                <div class="emisor-mensaje">
                    <img src="<?php echo $emisor->getIconURL(); ?>"/>
                    <span><?php echo $url_emisor; ?></span>
                </div>
                <div class="asunto">
                    <span><a href="<?php echo $url_msj ?>"><?php echo $asunto; ?></a></span>
                </div>
                <div class="tiempo-mensaje">
                    <span><?php echo $fecha; ?></span>
                </div>
            </li>
            <?php
        }
    }else{
        echo "<div style='padding:20px'>No has enviado ningún mensaje.</div>";
    }
    ?>
</ul> 