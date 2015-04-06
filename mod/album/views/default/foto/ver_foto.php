<?php
elgg_load_js('confirmacion');
elgg_load_js('acciones_linea');
echo elgg_view("vistas/js");
$guid_foto = get_input("foto");
$vars = array("foto" => $guid_foto);
$contenido_foto = elgg_view("foto/contenido_foto", $vars);
$contenido_comentarios = elgg_view("foto/comentarios_foto", $vars);
$url = elgg_get_site_url() . "action/album/delete_foto?foto={$guid_foto}";
$eliminar = elgg_add_action_tokens_to_url($url);
$imagen = new TidypicsImage($guid_foto);
$owner = $imagen->getOwnerEntity();
$friendlytime = elgg_view_friendly_time($imagen->time_created);
//echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar la foto?</div>';
?>
<style>
    .boxcaption{ 
        float: left; 
        position: absolute; 
        background: #000; 
        height: 70px; 
        width: 72%; 
        opacity: .8; 
        /* For IE 5-7 */
        filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
        /* For IE 8 */
        -MS-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
    }
    .captionfull .boxcaption {
        top: 600px;
        left: 0;
    }
    .caption .boxcaption {
        top: 600px;
        left: 0;
    }
    
    .eliminar-foto{
        margin-top: 15px;
        padding: 10px;
        float:right;
        margin-right: 20px;
    }
    
    .eliminar-foto:hover{
        background-color: #000;
    }
    
    .eliminar-foto a{
        color:#E0E0DD !important;
    }
</style>
<div id='contenido-foto'>
    <div class='foto_en_visor boxgrid.slidedown'>
        <div >
            <div class="boxgrid caption"><?php echo $contenido_foto; ?>
                <div class="cov boxcaption">
                    <div class="row" style="float:left">
                        <div class="row" >
                            <img src="<?php echo $owner->getIconURL() ?>" style="width: 50px; margin-left: 5px; margin-top: 10px;" data-tooltip="<?php echo $owner->name . " " . $owner->apellidos ?>"/>
                        </div>
                        <div class="row" style="margin-top: 20px;margin-left: 10px;">
                            <p style="color:#E0E0DD; font-weight: 700"><?php echo $owner->name . " " . $owner->apellidos ?></p>
                            <p style="color:#E0E0DD;"><?php echo $friendlytime ?></p>
                        </div>
                    </div>
                    <?php if ($imagen->owner_guid == elgg_get_logged_in_user_guid()) { ?>
                        <div class="row eliminar-foto"><a href="<?php echo $eliminar; ?>" >Eliminar Foto</a></div>
                    <?php } ?></div>                    
            </div>
        </div>
    </div>
    <div class="comentarios">
        <?php echo $contenido_comentarios; ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".cov").hide();
        $('.boxgrid').hover(function() {
            $(".cov", this).stop().animate({top: '533px'}, {queue: false, duration: 160});
            $(".cov").show({duration: 160});

        }, function() {
            $(".cov", this).stop().animate({top: '600px'}, {queue: false, duration: 160});
            $(".cov").hide();
        });

    });
</script>