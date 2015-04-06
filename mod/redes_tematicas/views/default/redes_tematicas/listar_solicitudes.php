<?php
elgg_load_js('acciones');


$miembros = $vars['miembros'];
$contenido = "";
$id_grupo = $vars['id'];

if (sizeof($miembros) == 0) {
  echo "<div class='mensaje-vacio'><h2>No Hay Solicitudes para la Red</h2></div>";
} else {
    ?>
    <ul class='list-usuarios'><?php
        foreach ($miembros as $miembro) {
            ?>
            <li class="item-usuario">
                <a href="<?php echo $miembro['profile'];?>"><img src="<?php echo $miembro['imagen'];?>"/></a>
                <div>
                    <a href="<?php echo $miembro['profile'];?>"><span class='name-usuario'><?php echo $miembro['nombre']." ".$miembro['apellidos']; ?></span></a><br><br>
                    <ul>
                        <li><span><a href="<?php echo $miembro['href_a']; ?>">Aceptar</a></span></li>
                        <li><span><a href="<?php echo $miembro['href_r']; ?>">Rechazar</a></span></li>
                    </ul>
                </div>
            </li>
            <?php
        }
        ?>
    </ul>
        <?php
    }
    
