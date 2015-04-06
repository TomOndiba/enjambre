<?php


$categoria=$vars['categoria'];
$etapa=$vars['etapa'];

$nombre_input=  elgg_view('input/text', array('name'=>'nombre','required' => 'true',));
$url_input=elgg_view('input/text', array('name'=>'url','required' => 'true',));
$icono_input=  elgg_view('input/file', array('name'=>'images'));
$etapa_opcion_input=elgg_view('input/checkbox', array('name' => 'etapas_todas', 'align' => 'Vertical','value'=>'ON'));
$categoria_input=  elgg_view('input/hidden', array('name'=>'categoria', 'value'=>$categoria));
$etapa_input=elgg_view('input/hidden', array('name'=>'etapa', 'value'=>$etapa));
        
$button = elgg_view('input/submit', array('value' => elgg_echo('Agregar')));
?>



<div>
    <h2 class="title-legend">Agregar Nuevo Componente</h2>

    <form>
    <div>
        <label>Nombre:</label><?php echo $nombre_input;?>
    </div>
 
    <div>
        <label>Url:</label><?php echo $url_input;?>
    </div>
    
    <div>
        <label>Icono:</label> <label class='lbl-button'><span> Seleccione el Archivo</span><?php echo $icono_input;?></label>
    </div>
    
     <div>
        <label>Desea que aparezca en todas las etapas:</label><?php echo $etapa_opcion_input;?>
    </div>
    
    <div>
        <?php echo $categoria_input.$etapa_input; ?>
    </div>
    <div class="contenedor-button">
        <?php echo $button ?>
    </div>
    </form>
</div>


<?php

$componentes=elgg_get_componentes($etapa);


foreach ($componentes as $comp){
    
    $site_url = elgg_get_site_url();
    $url = $site_url . "photos/thumbnail/{$comp->icono}/small/";
    ?>
    <div>
      <img src='<?php echo $url; ?>'><a href="<?php echo $comp->url; ?>"></a>
    </div>
<div>
    <h4><?php echo $comp->title; ?></h4>
</div>
                        
<?php                        
}
