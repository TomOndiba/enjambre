<style type="text/css">

    #magazine-2, .book{
        width:1152px !important;
        height:702px !important;
        z-index: 9900;
    }
    .turn-page-wrapper{
        width: 50% !important;
    }

    #magazine .turn-page{
    }

    .row{
        display: inline-block;
        vertical-align: top;
    }
    .pestanas{
        margin-top: 10px;
        width: 50px;
        height: 700px;
        margin-left: -5px;
        z-index: 500;
    }
    .pestanas>ul>li{
        height: 100px;
        width: 100px;
        margin-left: -60px;
        padding-top: 10px;
        transform:rotate(90deg);
        -ms-transform:rotate(90deg); /* IE 9 */
        -webkit-transform:rotate(90deg); /* Opera, Chrome, and Safari */
        text-align: center;
        border-radius: 7px;
        font-weight: 700;
        color:white;
    }
    .pestanas>ul>li:hover{
        cursor: pointer;
        height: 120px!important;
        width: 120px!important;
    }
    .select{
        height: 120px!important;
        width: 120px!important;
        font-weight: 700!important;
    }
    .nota-cuaderno{
        font-family: "Sunsine";
        font-size: 32px;
        width: 80%;
        height: 80%;
        padding-top: 10%;
        padding-bottom: 10%;
        padding-left: 10%;
        padding-right: 10%;
        color:black;
    }

    .nota-diario>div{
        font-family: "Sunsine";
        font-size: 20px;
        display: inline-block;
        vertical-align: top;
        max-width: 350px;
        margin-left: 10px;
    }

    .nota-diario>div>a>img{
        width: 60px;
        border-radius: 5px;
        border-color: gray;
        border-width: 1px;
        border-style: solid;
        margin-left: 10px;
    }
    .nota-diario{
        font-family: "Sunsine";
        font-size: 18px;
        width: 100%;
        height: 80%;
        padding-top: 10%;
        padding-bottom: 10%;
        color:black;
    }

    .element-1{
        background-color: rgb(255,110,110);

    }
    .element-2{
        background-color: rgb(247,200,45);

    }
    .element-3{
        background-color: rgb(12,204,191);

    }
    .element-4{
        background-color: rgb(177,63,114);
    }
    .element-5{
        background-color: rgb(168,207,69);
    }

    .element-6{
        background-color:  rgb(145,216,247);
        margin-top: 20px;
    }



    .nota-cuaderno>b{
        font-family: "Sunsine";
        font-size: 32px;
        color:black;
    }

    div#notas-ajax::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    div#notas-ajax::-webkit-scrollbar
    {
        width: 7px;
        background-color: #F5F5F5;
    }

    div#notas-ajax::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #A6A6A6;
    }
    .titulo-cuaderno{
        width: 60%;
        margin-left: 25%;
        margin-right: 15%;
        margin-top: 300px;
        text-align: center;
        font-size: 40px;
        color:white;
        font-weight: 700;
    }
    .add-nota{
        width: 800px;
        margin:0 auto;
        display: none;
    }
</style>
<div id="etapa1" class="etapa" data-tooltip="Exploración">

</div>

<div id="etapa2" class="etapa" data-tooltip="Indagación">

</div>
<div id="etapa3" class="etapa" data-tooltip="Socialización y Reflexión">

</div>

<div class="pop-up-contenedor">

</div>



<?php
elgg_load_js("jquery-ui");
elgg_load_js("turn");
elgg_load_js("file");
elgg_load_js("raty");
elgg_load_js("timer");
elgg_load_js('vista_modal');
elgg_load_js("reveal2");
elgg_load_css('reveal');
elgg_load_js('acciones');
elgg_load_js('buscar_maestros');
elgg_load_js('buscar_integrantes');
elgg_load_js('acciones_investigacion');
elgg_load_js('fullcalendar');
elgg_load_css("fullcalendar_css");
elgg_load_js("ajax_comentarios");
elgg_load_js('imprimir');
elgg_load_js('validate');
elgg_load_js('tinymce');


$entidades = $vars['entities'];
$investigacion = $vars['investigacion'];
$guid = $vars['id_origen'];
$origen = $vars['origen'];
$user = elgg_get_logged_in_user_guid();
$site_url = elgg_get_site_url();
echo "<div class=' contet-grupo-investigacion'><div class='padding20'>";
echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar la Investigacion?</div>';
$title = "Investigacion" . " " . $investigacion->name;
$input_id_inv = elgg_view('input/hidden', array('value' => $investigacion->guid, 'id' => 'id_inv'));
$header = "<div class='header-list-group'>";

$calendario = '<div class="calendario-investigacion" data-tooltip="Ver Calendario de la Investigación" data-reveal-id="myModalCalendario"  onclick=\' getVerCalendario("' . $investigacion->guid . '")  \'></div>';
echo $calendario;

$perfil_invest = '<a data-reveal-id="myModalPerfilInvestigacion" onclick=\' getMostrarPerfilInvestigacion("' . $investigacion->guid . '")  \' ><div class="perfil-investigacion" data-tooltip="Ver Información de investigacion"></div></a>';
echo $perfil_invest;


if ($origen == "grupo") {
    
    $inv = elgg_get_site_url() . "grupo_investigacion/ver_convocatorias_abiertas/" . $guid . "/" . $investigacion->guid;
    $insc_feria = elgg_get_site_url() . "grupo_investigacion/ver_ferias_abiertas/" . $guid . "/" . $investigacion->guid;
    $categ = elgg_get_site_url() . "grupo_investigacion/definir_categoria/" . $guid . "/" . $investigacion->guid;
    if ($user == $investigacion->owner_guid || elgg_is_rol_logged_user("SuperAdmin")) {
        $header.='<div id="boton-2" data-tooltip="Agregar Maestros" class="etapa" href="#" data-reveal-id="myModalMaestros" onclick=\' getBuscarMaestros("' . $guid . '","' . $investigacion->guid . '","true")  \'></div>';
        $header.='<div id="boton-1" data-tooltip="Agregar Integrantes" class="etapa" data-reveal-id="myModalIntegrantes" onclick=\' getBuscarIntegrantes("' . $guid . '","' . $investigacion->guid . '","true")  \'></div>';
    }
    $params = array('grupo' => $guid, 'investigacion' => $investigacion->guid, 'value' => $investigacion->categoria);
    $form = elgg_view_form('investigacion/definir_categoria', null, $params);
    if ($investigacion->owner_guid == $user || elgg_is_rol_logged_user("SuperAdmin")) {
        $convoc = elgg_get_relationship($investigacion, "seleccionada_en_convocatoria");
        if ($investigacion->categoria == '') {
            $atributos = '';
        } else {
            $atributos = "data-reveal-id='myModalConvocatorias' class='close-reveal-modal'";
        }
        $url_categ = 'ajax/view/investigaciones/definir_categoria';
        $botones = "<br><div align='center'><a data-reveal-id='myModalConvocatorias' class='close-reveal-modal' onclick=categoria('$investigacion->categoria','$guid','$investigacion->guid','$url_categ');>Definir categoría</a></div>";
        if (sizeof($convoc) == 0) {
            $url_conv = 'ajax/view/investigaciones/ver_convocatorias_abiertas';
            $botones.="<br><div align='center'><a $atributos onclick=validar('{$investigacion->categoria}','$guid','$investigacion->guid','$url_conv');>Inscribirse a Convocatoria</a></div>";
        }
        $url_feria = 'ajax/view/investigaciones/ver_ferias_abiertas';
        $botones.= "<div style='display:none;' id='dialog' title='Definir Categoría'><p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span></p>$form</div>";
        $botones.="<br><div align='center'><a $atributos onclick=validar('{$investigacion->categoria}','$guid','$investigacion->guid','$url_feria');>Inscribirse a Feria</a></div>";
        $botones.="<br><div style='display:none;' id='dialog1' title='Alerta'><p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span></p>Debe definir la categoría de la investigación antes de inscribirse a una convocatoria.</div>";
    }
} else if ($origen == "convocatoria" || $origen == "evaluador_convocatoria" || $origen == "asesor_convocatoria") {
    $header.="</div>";
    $listaBread = array(array('titulo' => 'Investigaciones', 'url' => "{$site_url}convocatorias/investigaciones/{$guid}"),
        array('titulo' => $investigacion->name, 'url' => "{$site_url}investigaciones/ver/$investigacion->guid")
    );

    $lista = array('bread' => $listaBread);
    $breadcrumbs = elgg_view('breadcrumbs_generar', $lista);
} else if ($origen == "feria" || $origen == "evaluador_feria") {

    $header.="</div>";
    $listaBread = array(array('titulo' => 'Investigaciones', 'url' => "{$site_url}ferias/investigaciones/{$guid}"),
        array('titulo' => $investigacion->name, 'url' => "{$site_url}investigaciones/ver/$investigacion->guid")
    );

    $lista = array('bread' => $listaBread);
    $breadcrumbs = elgg_view('breadcrumbs_generar', $lista);

    $inscripcion = elgg_get_relationship($investigacion, "inscrita_en_{$guid}_con");

    $url = elgg_get_site_url();

    $botones.="<a class='ohyes-buttons-set elgg-button-submit' href='" . $url . "file/download/{$inscripcion[0]->informe_investigacion}'>Informe de Investigación</a>";
    $botones.="<a class='ohyes-buttons-set elgg-button-submit' href='" . $url . "file/download/{$inscripcion[0]->escrito_profesor}'>Escrito del Profesor</a>";
    $botones.="<a class='ohyes-buttons-set elgg-button-submit' href='" . $url . "file/download/{$inscripcion[0]->presentacion}'>Presentación</a>";
}
if ($botones) {
    $perfil_invest = '<a data-reveal-id="myModalOpcionesInvestigacion"><div class="admin-investigacion" data-tooltip="Opciones de Investigación"></div></a>';
    echo $perfil_invest;
}
echo $input_id_inv;
echo $header;
?>

<a href="<?php echo elgg_get_site_url()?>"><div class="volver-inicio" data-tooltip="Volver a la Comunidad"></div></a>
<div id="boton-3" class="etapa" data-tooltip="Ver Diario de Campo de la Iniciativa" onclick="verDiarioInvestigacion(<?php echo $investigacion->guid; ?>, 'cero')" data-reveal-id="myModal-diario">

</div>
<div class="titulo-investigacion-banner">
    <h2><?php echo $investigacion->name ?></h2>
</div>

<div id="myModalMaestros" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-maestros pop-up">
    </div>
</div>

<div id="myModalIntegrantes" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-integrantes pop-up">
    </div>
</div>

<div id="myModalConvocatorias" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-convocatorias pop-up">
    </div>
</div>

<div id="myModalCalendario" class="reveal-modal xlarge">
    <div class="close-reveal-modal" style="right:0"></div>
    <div class="contenedor-calendario">
    </div>
</div>

<div id="myModalPerfilInvestigacion" class="reveal-modal xlarge">
    <div class="close-reveal-modal cambio" style="margin-right:-120px"></div>
    <div class="pop-up-perfil-investigacion">
    </div>
</div>

<div id="myModalOpcionesInvestigacion" class="reveal-modal" style='width: 600px;top:100px;'>
    <div class="close-reveal-modal cambio-2"></div>
    <div class='titulo-investigacion'>
        Opciones de la Investigación
    </div>
    <div class="pop-up-opciones" style="width:100%; background: white;">
        <?php echo $botones; ?>
    </div>
</div>


<div id="myModal-diario" class="reveal-modal xslarge" style="top:10px !important;">
    <div class="close-reveal-modal cambio-2"></div>
</div>
<script>

    function cerrarOpciones(categoria, guid, investigacion, url) {
        validar(categoria, guid, investigacion, url);
        $(".contenedor-admin").hide();
    }
    function getBuscarMaestros(guid, guid_inv, tipo) {
        var guid = guid;
        var guid_inv = guid_inv;
        var tipo = tipo;

        elgg.get('ajax/view/investigaciones/agregar_maestros', {
            timeout: 30000,
            data: {
                id_grupo: guid,
                id_inv: guid_inv,
                tipo: tipo,
            },
            success: function(result, success, xhr) {
                $('.pop-up-maestros').html(result);
            },
        });
    }

    function getBuscarIntegrantes(guid, guid_inv, tipo) {
        var guid = guid;
        var guid_inv = guid_inv;
        var tipo = tipo;

        elgg.get('ajax/view/investigaciones/agregar_integrantes', {
            timeout: 30000,
            data: {
                id_grupo: guid,
                id_inv: guid_inv,
                tipo: tipo,
            },
            success: function(result, success, xhr) {
                $('.pop-up-integrantes').html(result);
            },
        });
    }




    function getVerCalendario(guid) {
        var inv = guid;

        elgg.get('ajax/view/investigaciones/ver_calendario', {
            timeout: 30000,
            data: {
                guid_inv: inv,
            },
            success: function(result, success, xhr) {
                $('.contenedor-calendario').html(result);
            },
        });
    }

    function getMostrarPerfilInvestigacion(guid) {
        var inv = guid;
        elgg.get('ajax/view/investigaciones/profile/informacion', {
            timeout: 30000,
            data: {
                guid_inv: inv,
            },
            success: function(result, success, xhr) {
                $('.pop-up-perfil-investigacion').html(result);
                $("#datos-basicos").show();
                $("#integrantes-info-grupo").hide();
            },
        });
    }

    function mostrarDatosBasicos(element) {
        $("#datos-basicos").show();
        $("#integrantes-info-grupo").hide();
        $(".info-selected").removeClass("info-selected");
        $(element).addClass("info-selected");
    }

    function mostrarIntegrantesInfo(element) {
        $("#datos-basicos").hide();
        $("#integrantes-info-grupo").show();
        $(".info-selected").removeClass("info-selected");
        $(element).addClass("info-selected");
    }


    function verDiarioInvestigacion(investigacion, etapa) {
        elgg.get('ajax/view/investigaciones/diario/ver_diario', {
            timeout: 30000,
            data: {
                investigacion: investigacion,
                etapa: etapa
            },
            success: function(result, success, xhr) {
                $('#myModal-diario').html(result);
            },
        });
    }
</script>
