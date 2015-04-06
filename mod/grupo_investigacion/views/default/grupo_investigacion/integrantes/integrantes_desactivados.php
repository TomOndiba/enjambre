
<div class="list-grupos" style="margin-left: 20px; margin-top: 25px">
    <h2 class="title-legend">Integrantes Desactivados</h2>
<?php
/**
 * Vista que muestra el litado de los integrantes que se encuentran desactivados 
 * en el grupo de investigacion
 */
$grupo = $vars['grupo'];
$miembros = elgg_get_miembros_desactivados_grupo_investigacion($grupo);
$site_url = elgg_get_site_url();
$user = elgg_get_logged_in_user_guid();

if (!empty($miembros)) {
    ?>

    <ul class='list-usuarios'><?php
        foreach ($miembros as $miembro) {

            $usuario= new ElggUsuario($miembro->guid);
      
            $url2 = $site_url . "action/grupo_investigacion/activar_integrante?id=" . $miembro['guid'] . "&grupo=" . $grupo->guid;
            $url_desactivar = elgg_add_action_tokens_to_url($url2);
            ?>
            <li class="item-usuario">
                
                    <a href="<?php echo $site_url . "profile/" . $miembro['username']; ?>"><img src="<?php echo $miembro['icono']; ?>"/></a>
                
                <div>
                    <div>
                        <a href="<?php echo $site_url . "profile/" . $miembro['username']; ?>"><span class='name-usuario'><?php echo $miembro['nombre']; ?></span></a>
                    </div>
                   
                    <br><br>
                    <ul>
                    <?php
                    if ($user == $grupo->owner_guid) {
                        ?>
                        <li><a href="<?php echo $url_desactivar ?>">Activar</a></li>
                        <?php
                    }
                    ?>
                    </ul>
                </div>
            </li>
        <?php }
        ?>
    </ul>
<?php } else {
    ?>
    <div class="mensaje-vacio">
        <h2>No existen usuarios deshabilitados.</h2>
    </div>
    <?php
}
?>

</div>