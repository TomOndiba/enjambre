<?php
/**
 * Formulario que administra la informacio de una faq
 * @author DIEGOX_CORTEX
 */

$id = $vars['id'];
$title = "";
$catg =  "";
if(!empty($id)){
    $faq = get_entity($id);    
    $title = "Editar Informacion";
    $catg = "Actualmente con categoria {$faq->category}";
}else{
    $title = "Añadir Nueva Pregunta";
}

$count = elgg_get_entities(array('type' => "object", 'subtype' => "faqs", 'limit' => 0, 'offset' => 0, 'count' => true));
$metadatas = elgg_get_metadata(array('annotation_name' => "category", 'type' => "object", 'subtype' => "faqs", 'limit' => $count));

//obtengo las categorias registradas en las faqs
$cats = array();
foreach ($metadatas as $metadata) {
    $cat = $metadata['value'];
    if (!in_array($cat, $cats)) {
        $cats[] = $cat;
    }
}

$select = "<select name='oldCat' id='oldCat' onChange='checkCat();'>";
$select .= "<option value=''> Seleccione una categoria";


foreach ($cats as $cat) {
    $select .= "<option>" . $cat;
}

$select .= "<option value='newCat'>Ingresar nueva categoria";
$select .= "</select>";

$categoria = elgg_view("input/text", array("name" => "newCat", "disabled" => true, "placeholder" => "Nueva categoria..."));
$respuesta = $addBody .= elgg_view("input/longtext", array("name" => "answer", 'value' => $faq->answer));

$archivo = elgg_view('input/file', array('name' => 'archivo2', 'id' => "files"));
?> 

<div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2>Administración</h2>
        </div>
        <div class="menu-coordinacion">
            <?php echo elgg_view("convocatorias/menu_admin", array()); ?>
        </div>

        <div class="contenido-coordinacion">


    <input type="hidden" value="<?php echo $id;?>" name="id"> 
    <h2 class="title-legend">
        <center><?php echo $title;?></center>
    </h2>
    <div>
        <label>Pregunta:</label>
        <input type="text" name="pregunta"  required="" placeholder="" value="<?php echo $faq->question;?>">
    </div>
    <div>
        <label>Categoria: <?php echo $catg;?></label>
        <?php echo $select; ?>
        <?php echo $categoria; ?>
        <div id="categoria">            
            <label>Respuesta:</label>
            <?php echo $respuesta; ?>
        </div>

        <div id="subir">
        Seleccione un archivo para subir (Opcional)...
        <?php echo $archivo; ?>
        </div>
    </div>
        
    <input type="submit" value="Guardar">
   

</div>

 

<script type="text/javascript">

    function checkCat() {
        var cat = $('#oldCat').val();

        
        	if (cat == "newCat") {
            	$('input[name="newCat"]').removeAttr("disabled").removeAttr("readonly");
        	} else {
           		$('input[name="newCat"]').attr("disabled", "disabled");
        	}
    	
    }
</script>