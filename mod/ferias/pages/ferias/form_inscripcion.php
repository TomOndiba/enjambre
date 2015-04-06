<?php
elgg_load_css('logged');
$grupo = get_entity(get_input('id_group'));
$investigacion = get_entity(get_input('id_inv'));
$feria = get_entity(get_input('id_feria'));

$institucion = elgg_get_relationship($grupo, "pertenece_a");

elgg_load_library('elgg:file');
elgg_push_breadcrumb(elgg_echo('Ferias'), 'ferias/');

$content = elgg_view_title($title);



//Cargo los estudiantes asociados a la investigacion
$integrantes_inv = elgg_get_relationship_inversa($investigacion, "hace_parte_de");
$estudiantes = array();
if (sizeof($integrantes_inv) > 0) {
    foreach ($integrantes_inv as $integ) {
        //calcular la edad
        $fecha = $integ->fecha_nacimiento;
        list($Y, $m, $d) = explode("-", $fecha);
        $edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );

        $intX = array('guidE' => $integ->guid, 'nombreE' => $integ->name . ' ' . $integ->apellidos, 'cc' => $integ->numero_documento,
            'grado' => $integ->curso, 'edad' => $edad, 'fecha_nac' => $integ->fecha_nacimiento, 
            'email' => $integ->email, 'telefono' => $integ->telefono);
        
        array_push($estudiantes, $intX);
    }
}

//Cargo los maestros asociados a uan investigacion
$maestros_inv = $investigacion->getEntitiesFromRelationship('es_colaborador_de', true);
$maestros = array();
if(sizeof($maestros_inv)>0){
    foreach ($maestros_inv as $maes){
        $maX = array('guidM' => $maes->guid,'nombreM' => $maes->name.' '.$maes->apellidos, 'asignatura' => $maes->area_conocimiento, 
            'telefono' => $maes->telefono.'-'.$maes->celular, 'email' => $maes->email);
        
        array_push($maestros, $maX);
    }
}

//cargo las areas de feria
$areas_feria = elgg_get_areas_de_feria($feria->guid);
$areas = array();
if(sizeof($areas_feria)>0){
    foreach ($areas_feria as $aF){
        $areasX = array('guidA' => $aF->guid, 'nameA' => $aF->title);
        array_push($areas, $areasX);
    }
}

//cargo los niveles de feria
$niveles_feria = elgg_get_nivel_de_feria($feria->guid);
$niveles = array();
if(sizeof($niveles_feria)>0){
    foreach ($niveles_feria as $niv){
        $nX = array('guidN' => $niv->guid, 'nombreN' => $niv->title);
        array_push($niveles, $nX);
    }
}

//cargo las formas de participación de la feria
$formas_participacion = explode(',', $feria->formas_participacion);
$formas = array();
if(sizeof($formas_participacion) > 0){
    foreach ($formas_participacion as $f){
        $forX = array('nombre'=>$f);
        array_push($formas, $forX);
    }
}

$problema_investigacion = elgg_get_problema_investigacion($investigacion->guid);



//validamos que la investigación tenga linea temática... 
$lineas_preestructuradas = array();
$lines_abiertas = array();
$linea_inv = '';
if(empty($investigacion->linea_tematica)){
    $todas_lineas = listar_lineas();
    foreach ($todas_lineas as $li){
        if($li->tipo == 'Proyectos abiertos'){
            $lines_abiertas[$li->name] = $li->guid;
        }else{
            $lineas_preestructuradas[$li->name] = $li->guid;
        }
    }
}else{
    $linea_inv = get_entity($investigacion->linea_tematica)->name;
}

$subcategoriaGo = array();
if($investigacion->categoria == 'Innovación'){
    $subcategoria = listar_subcategorias_innovacion();
    foreach ($subcategoria as $s){
        $subcategoriaGo[$s->title] = $s->guid;
    }
}
    

$params = array(
    'guid_inv' => $investigacion->guid, 
    'categoria_inv' => $investigacion->categoria, 
    'guid_grupo' => $grupo->guid, 
    'name_institucion' => $institucion[0]->name, 
    'rector_institucion' => $institucion[0]->director, 
    'municipio_dpto' => $institucion[0]->departamento.' / '.$institucion[0]->municipio,
    'telefono_institucion' => $institucion[0]->telefono, 
    'direccion_institucion' => $institucion[0]->direccion, 
    'linea_inv' => $linea_inv,
    'email_institucion' => $institucion[0]->email, 
    'nombre_grupo' => $grupo->name, 
    'estudiantes' => $estudiantes, 
    'lineas_abiertas' => $lines_abiertas,
    'maestros' => $maestros, 
    'areasF' => $areas, 
    'titulo_inv' => $investigacion->name, 
    'feria_guid' => $feria->guid, 
    'feria_tipo' => $feria->tipo_feria,
    'nombre_feria' => $feria->name, 
    'nivelesF' => $niveles, 
    'formasFeria' => $formas, 
    'problema_inv' => $problema_investigacion, 
    'lineas_pres' => $lineas_preestructuradas,
    'subcategoriasIn' => $subcategoriaGo, 
    'guid_reglamento' => $feria->reglamento_feria);

$form_vars = array('enctype' => 'multipart/form-data');
$content .= elgg_view_form('ferias/form_inscripcion', $form_vars, $params);

$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());

