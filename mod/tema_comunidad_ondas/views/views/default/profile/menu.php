<?php
elgg_load_js("reveal2");
elgg_load_css('reveal');
elgg_load_js('confirmacion');

$user = $vars['user'];
$inscrito_evaluador = elgg_verificar_inscripcion_maestro_evaluador();
$inscrito_asesor = elgg_verificar_inscripcion_maestro_asesor();
$url = elgg_get_site_url() . "action/evaluadores/request";
$url_inscribirme_evaluador = elgg_add_action_tokens_to_url($url);
$site_url = elgg_get_site_url();
echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar su amigo?</div>';
?>
<div class="menu">
    <div class="informacion">
        <img src="<?php echo $user->getIconUrl('medium'); ?>" class="imagen-perfil"/>
        <fieldset>
            <legend><?php echo $user->name . " " . $user->apellidos; ?></legend>
        </fieldset>
    </div>
    <div class="opciones-grupo">
        <?php echo elgg_view("profile/opciones", array("user" => $user->guid)); ?>
    </div>
    <nav class="menu-perfil">
        <ul>
            <li><a href="<?php echo $site_url; ?>profile/<?php echo $user->username; ?>">Muro</a></li>
            <li><a href="<?php echo $site_url; ?>profile/<?php echo $user->username; ?>/informacion">Información</a></li>
            <li><a href="<?php echo $site_url; ?>profile/<?php echo $user->username; ?>/fotos">Fotos</a></li>
            <li><a href="<?php echo $site_url; ?>profile/<?php echo $user->username; ?>/grupos">Mis Grupos de Investigación</a></li>
            <li><a href="<?php echo $site_url; ?>profile/<?php echo $user->username; ?>/redes">Mis Redes Temáticas</a></li>
            <li><a href="<?php echo $site_url; ?>profile/<?php echo $user->username; ?>/amigos">Mis Amigos (<?php echo sizeof(elgg_get_relationship($user, 'friend')) ?>)</a></li>
            <?php if (elgg_get_logged_in_user_guid() == $user->guid) { ?>
                <li><a href="<?php echo $site_url; ?>profile/<?php echo $user->username; ?>/solicitudes">Ver Solicitudes</a></li>
                <?php
            }
            ?>
        </ul>
        <?php if (!$inscrito_evaluador && elgg_get_logged_in_user_guid() == $user->guid) { ?>
            <div class="inscripcion-evaluador"><a href="<?php echo $url_inscribirme_evaluador; ?>"><div style='color:white;'><div class="icon-inscripcion-evaluador"></div>Inscribirme como evaluador</div> </a></div>

            <?php
        }
        if (!$inscrito_asesor && elgg_get_logged_in_user_guid() == $user->guid) {

            echo '<div class="inscripcion-asesor"><a class="" href="#" data-reveal-id="myModal" onclick=\' getInscribirse("' . $user->guid . '")\'><div style="color:white;"><div class="icon-inscripcion-asesor"></div>Inscribirme como Asesor</div></a></div>';
        }
        ?>
    </nav>
</div>


<div id="myModal" class="reveal-modal">
    <div class="pop-up-archivos pop-up">
    </div>
</div>
<script>
    function getInscribirse(guid) {
        var owner = guid;
        elgg.get('ajax/view/asesores/inscribir_asesor', {
            timeout: 30000,
            data: {
                owner: owner,
            },
            success: function(result, success, xhr) {
                $('.pop-up-archivos').html(result);
            },
        });
    }
</script>
