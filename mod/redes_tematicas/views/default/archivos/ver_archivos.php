
   
<?php
elgg_load_js('pagination/archivos');
elgg_load_js("reveal2");
elgg_load_css('reveal');
elgg_load_js('validate');
$ajax = get_input('ajax');
$offset = get_input('offset');
$limit = 5;
$categoria = get_input('categoria');
$autoformacion = $vars['autoformacion'];
   



if (!$ajax) {
    $guid = $vars['guid'];
    $titulo = elgg_view_title("Archivos");
    $site_url = elgg_get_site_url();
    $entity = get_entity($guid);
    $subtype = "";

    $e=  get_entity($guid);
  
    $busqueda = elgg_view('input/text', array('name' => 'busqueda',
        'id' => 'busqueda',
        'class' => 'text-busqueda',
        'value' => "",
        'title' => $guid,
    ));
     if ($autoformacion == "true") {
            echo '<br><br><h2 class="title-legend">&nbsp; &nbsp;Mi biblioteca</h2>';
        } else {
            echo '<br><br><h2 class="title-legend">&nbsp; &nbsp; Archivos</h2>';
        }
        echo '<div id="contenedor-busqueda">' . $busqueda . ' </div>';
    $user= elgg_get_logged_in_user_guid();
    if((elgg_is_miembro_admin($guid, $user) && !check_entity_relationship($user, "usuario_desactivado_de", $guid))|| $entity->getSubtype()=="feria"){
    echo '<div class="botones-titulo"><div class="contenedor-button"> <a class="link-button" href="#" data-reveal-id="myModal" onclick=\' getCargarArchivos("' . $guid . '","'.$autoformacion.'")  \'>Subir Archivo</a></div></div>';
    }
    
    // Se crea la lista de tipos de archivos

    if ($autoformacion == "true") {
        $lista = "<ul class='tabs-archivos'>"
                . "<li><a href='#Caja_de_Herramientas' class='ver-lista-archivos' name='Caja de Herramientas' title='{$guid}' rel='nofollow'>Caja de Herramientas</a></li>"
                . "<li><a href='#Lineamientos_Pedagogicos' class='ver-lista-archivos' name='Lineamientos Pedagogicos' title='{$guid}' rel='nofollow'>Lineamientos Pedagógicos</a></li>"
                . "<li><a href='#Sistematizacion' class='ver-lista-archivos' name='Sistematizacion' title='{$guid}' rel='nofollow'>Sistematización</a></li>"
                . "<li><a href='#Otros' class='ver-lista-archivos' name='Otros' title='{$guid}' rel='nofollow'>Enjambre</a></li>"
                . "</ul>";


        echo $lista;
        $categoria = "Caja de Herramientas";
    }
    else{
        $categoria = "ninguna";
    }
    
    echo elgg_view('input/hidden', array('value'=>$autoformacion, 'id'=>"auto"));
    echo elgg_view('input/hidden', array('value'=>$guid, 'id'=>"falta"));
    
    echo "<div id='paginable' class=''>";
    echo elgg_get_archivos($limit, 0, $guid, $categoria);
    echo "</div>";
    
} else {
    
    $guid = get_input('guid');
    $query = get_input('busqueda');
    $autoformacion=  get_input('autoformacion');
    
    if($autoformacion!="true"){
      $categoria="ninguna";
    }
    
    if ($query) {// Si se necesita hacer una busqueda realiza la consulta por el nombre
        echo elgg_get_archivos_nombre($limit, $offset, $query, $guid, $categoria);
    } else {
        echo elgg_get_archivos($limit, $offset, $guid, $categoria);
    }
}
?>

<div id="myModal" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-archivos pop-up">
    </div>
</div>
<script>
    function getCargarArchivos(guid, autoformacion){
        var owner=guid;
        elgg.get('ajax/view/archivos/subir_archivo', {
            timeout: 30000,
            data: {
                owner:owner,
                autoformacion:autoformacion,
            },
            success: function(result, success, xhr) {
                $('.pop-up-archivos').html(result);
            },
        });
    }
</script>
