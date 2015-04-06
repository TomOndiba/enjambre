<?php
elgg_load_js("investigaciones-feria");
elgg_load_js("lista-investigaciones");
elgg_load_js('vista_modal1');
elgg_load_js('buscar_lineas_tipo');
elgg_load_js('reveal2');
elgg_load_css("reveal");
elgg_load_js('sumar_4.2');
elgg_load_js('sumar_evalinfcuad');
elgg_load_js('sumar_4.1');
elgg_load_js('sumar_3_INN');
elgg_load_js('sumar_3_INV');
elgg_load_js('sumar2.1');

$id= $vars['guid_feria'];
$feria=get_entity($id);
$tipo_input=elgg_view('input/hidden', array('id'=>'tipo_feria', 'value'=>$feria->tipo_feria));
$feria_input=elgg_view('input/hidden', array('id'=>'feria', 'value'=>$id));
echo $feria_input.$tipo_input;
?>

<div class = "content-coordinacion">
    <div class = "titulo-coordinacion">
        <h2>Feria: <?php echo $feria->name;?></h2>
    </div>
    <div class="menu-coordinacion">
        <?php echo elgg_view("ferias/menu", array('guid' => $feria->guid)); ?>
    </div>
    <div class="contenido-coordinacion">
        <h2>
            Investigaciones:
        </h2>


<?php 
if($feria->tipo_feria=='Municipal'){
?>
<ul class="tabs-coordinacion-ferias">
    <li id="inscritas" class="selected"><a href="#inscritas" class="ver-lista-investigaciones" name="inscritas" rel="nofollow">Inscritas</a></li>
    <li id="acreditadas"><a href="#acreditadas" class="ver-lista-investigaciones" name="acreditadas" title="" rel="nofollow">Acreditadas como participantes</a></li>
    <li id="evaluadas_inicialmente" class="elgg-state-selected"><a href="#evaluadas_inicialmente" class="ver-lista-investigaciones" name="evaluadas_inicialmente" rel="nofollow">Inicialmente evaluadas</a></li>
    <li id="evaluadas_en_sitio"><a href="#evaluadas_en_sitio" class="ver-lista-investigaciones" name="evaluadas_en_sitio" title="" rel="nofollow">Evaluadas en sitio</a></li>
    <li id="finalistas"><a href="#finalistas" class="ver-lista-investigaciones" name="finalistas" title="" rel="nofollow">Finalistas</a></li>
</ul>
<?php
}else if($feria->tipo_feria=='Departamental'){
?>
<ul class="tabs-coordinacion-ferias">
    <li id="acreditadas"><a href="#acreditadas" class="ver-lista-investigaciones" name="acreditadas" title="" rel="nofollow">Acreditadas como participantes</a></li>
    <li id="evaluadas_inicialmente" class="elgg-state-selected"><a href="#evaluadas_inicialmente" class="ver-lista-investigaciones" name="evaluadas_inicialmente" rel="nofollow">Inicialmente evaluadas</a></li>
    <li id="evaluadas_en_sitio"><a href="#evaluadas_en_sitio" class="ver-lista-investigaciones" name="evaluadas_en_sitio" title="" rel="nofollow">Evaluadas en sitio</a></li>
    <li id="finalistas"><a href="#finalistas" class="ver-lista-investigaciones" name="finalistas" title="" rel="nofollow">Finalistas</a></li>
</ul>
<?php
}
?>
<div id="ajax-investigaciones1">
</div>
        
    </div>
</div>