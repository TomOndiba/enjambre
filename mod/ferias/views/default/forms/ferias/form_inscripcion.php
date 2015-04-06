<?php

/**
 * Formulario donde se registran los datos necesarios para inscribirse a una feria
 */

//DATOS DE LA FERIA
$areasF = $vars['areasF'];
$nivelesF = $vars['nivelesF'];
$feria_guid = $vars['feria_guid'];
$feria_tipo = $vars['feria_tipo'];
$formasFeria = $vars['formasFeria'];
$guid_reglamento = $vars['guid_reglamento'];

//DATOS DEL GRUPO
$guid_grupo = $vars['guid_grupo'];
$nombre_grupo = $vars['nombre_grupo'];

//DATOS DE LA INSTITUCION
$institucion = $vars['name_institucion'];
$rector_institucion = $vars['rector_institucion'];
$municipio_dpto = $vars['municipio_dpto'];
$telefono_institucion = $vars['telefono_institucion'];
$direccion_institucion = $vars['direccion_institucion'];
$email_institucion = $vars['email_institucion'];

//DATOS DE LA INVESTIGACION
$guid_inv = $vars['guid_inv'];
$estudiantes = $vars['estudiantes'];
$maestros = $vars['maestros'];
$titulo_inv = $vars['titulo_inv'];
$categoria_inv = $vars['categoria_inv'];
$subcategoriasIn = $vars['subcategoriasIn'];
$problema_inv = $vars['problema_inv'];
$linea_tematica = $vars['linea_inv'];

//Variables para el contenido de los titulos del body del formulario
$datos_institucion = elgg_echo('feria:form:data:institucion');
$datos_grupo_inv = elgg_echo('feria:form:data:grupoInv');
$datos_maestros_inv = elgg_echo('fderia:form:data:maestros');
$datos_nivel_participacion = elgg_echo('feria:form:data:nivelparticipacion');
$datos_participacion_feria = elgg_echo('feria:form:data:formasParticipacion');
$datos_investigación = elgg_echo('feria:form:data:investigacion');

//Variables para el contenido de los label del body del formulario
$datos_categoria_inv = elgg_echo('feria:form:data:categoriainv');
$lbl_tipoferia = elgg_echo('feria:form:lbl:tipoferia');
$lbl_nombre_col = elgg_echo('feria:form:lbl:nombreColegio');
$lbl_name_rector = elgg_echo('feria:form:lbl:nombreRector');
$lbl_municipio = elgg_echo('feria:form:lbl:nombreMunicipio');
$lbl_direccion = elgg_echo('feria:form:lbl:direccioncol');
$lbl_telefono = elgg_echo('feria:form:lbl:telefono');
$lbl_email = elgg_echo('feria:form:lbl:email');
$lbl_name_grupoInv = elgg_echo('feria:form:lbl:nombreGrupoInv');
$lbl_name_Inv = elgg_echo('feria:form:lbl:nombreInv');
$lbl_pregunta_Inv = elgg_echo('feria:form:lbl:preguntaInv');
$lbl_metodologia_Inv = elgg_echo('feria:form:lbl:metodologiaInv');
$lbl_problema_Inv = elgg_echo('feria:form:lbl:problemaInv');
$lbl_resumen_Inv = elgg_echo('feria:form:lbl:resumenInv');
$lbl_linea_invInv = elgg_echo('feria:form:lbl:lineasinvestigacion');
$lbl_asesorlinea_inv = elgg_echo('feria:form:lbl:asesorlinInv'); 
$lbl_materiales = elgg_echo('feria:form:lbl:materiales');
$lbl_areasF_inv = elgg_echo('feria:form:lbl:areasF'); 
$lbl_informe_inv = elgg_echo('feria:form:lbl:informeInv');
$lbl_escrito_profesor = elgg_echo('feria:form:lbl:escritoProf');
$lbl_presentacion = elgg_echo('feria:form:lbl:presentacion');
$datos_lineas_investigación = elgg_echo('feria:form:lbl:lineasinvestigacion');

//variables para los contenidos de los label de las tablas del body del formulario
$tlbl_nombreEstudiantes = elgg_echo('feria:form:tlbl:nombreEstudiante');
$tlbl_docEstudiantes = elgg_echo('feria:form:tlbl:docEstudiante');
$tlbl_gradoEstudiantes = elgg_echo('feria:form:tlbl:gradoEstudainte');
$tlbl_edadEstudiantes = elgg_echo('feria:form:tlbl:edadEstudiante');
$tlbl_fecha_nacEstudiantes = elgg_echo('feria:form:tlbl:fechaNacEstudiante');
$tlbl_email_telEstudiantes = elgg_echo('feria:form:tlbl:emailTelEstudiante');
$tlbl_asistirEstudiantes = elgg_echo('feria:form:tlbl:asisitirEstudiante');
$tlbl_nombreMaestro = elgg_echo('feria:form:tlbl:nombreMaestro');
$tlbl_asignaturaMaestro = elgg_echo('feria:form:tlbl:asignaturaMaestro');
$tlbl_telefonoMaestro = elgg_echo('feria:form:tlbl:telefonoMaestro');
$tlbl_emailMaestro = elgg_echo('feria:from:tlbl:emailMaestro');
$tlbl_asistirMaestro = elgg_echo('feria:form:tlbl:asisitirMaestro');

//Variables para los contenidos de los mensajes de erros del body del formulario
$error_estudiantes = elgg_echo('feria:form:error:estudiantes:empy');
$error_maestros = elgg_echo('feria:form:error:maestros:empy');
$error_niveles = elgg_echo('feria:form:error:niveles:empy');
$formas_feria = elgg_echo('feria:form:error:formasFeria:empy');
$linea_investigacion = elgg_echo('feria:form:error:linea:empy');
$aceptar_terminos = elgg_echo('feria:form:info:aceptarterminos');
$mensaje_nota = elgg_echo('feria:form:info:nota');

//Junto la información de los estudiantes para mostrar en la tabla 
$estudiantes_tabla = '';
if (sizeof($estudiantes) > 0) {
    foreach ($estudiantes as $est) {
        $guid_estudiante = $est['guidE'];
        $estudiantes_tabla .= "<tr><td>" . $est['nombreE'] . "</td>"
                . "<td>" . $est['cc'] . "</td>"
                . "<td>" . $est['grado'] . "</td>"
                . "<td>" . $est['edad'] . "</td>"
                . "<td>" . $est['fecha_nac'] . "</td>"
                . "<td>" . $est['email'] . "</td>"
                . "<td>" . "<input type='checkbox' name='estudiantes' value='$guid_estudiante'>" . "</td></tr>";
    }
}else {
    $estudiantes_tabla = $error_estudiantes;
}

//Junto la informaicón de los maestros para mostrar en la tabla
$maestros_inv = '';
if (sizeof($maestros) > 0) {
    foreach ($maestros as $mas) {
        $guid_maestro = $mas['guidM'];
        $maestros_inv .= "<tr><td>" . $mas['nombreM'] . "</td>"
                . "<td>" . $mas['asignatura'] . "</td>"
                . "<td>" . $mas['telefono'] . "</td>"
                . "<td>" . $mas['email'] . "</td>"
                . "<td>" . "<input type='checkbox' name='maestros' value='$guid_maestro'>" . "</td></tr>";
    }
}else{
    $maestros_inv = $error_maestros;
}
 
//Junto los valores de los niveles para listarlos
$nivelesX = array();
$niveles_X = '';
if (sizeof($nivelesF) > 0){
    foreach ($nivelesF as $niv){
        $nivelesX[$niv['nombreN']] = $niv['guidN'];
    }
$niveles_X = elgg_view('input/radio', array('name' => 'niveles', 'align' => 'Vertical', 'options' => $nivelesX));
}else{
    $niveles_X = $error_niveles;
}

//Junto los datos de los tipos de participación en una feria
$valoresFeriaX = array();
$formas_part_feria = '';
if (sizeof($formasFeria) > 0){
    foreach ($formasFeria as $f){
        if(!empty($f['nombre'])){
            $valoresFeriaX[$f['nombre']] = $f['nombre'];
        }
    }
$formas_part_feria = elgg_view('input/checkboxes', array('name' => 'participacionF', 'align' => 'Vertical', 'options' => $valoresFeriaX));
}else{
    $formas_part_feria = $formas_feria;
}

//Junto los datos para las lineas tematicas dependiendo si hay una existente o no
$lineas_de_investigación = '';
if (!empty($linea_tematica)){
    $lineas_de_investigación = "<label>$lbl_linea_invInv</label> <input type=text name='linea_tematica' value='$linea_tematica' readonly><br>";
}else{
     $lineas_de_investigación = "$linea_investigacion<br>";
     $lineas_de_investigación .= "<h5>Lineas Preestructuradas<hr></h5>";
     $lineas_de_investigación .= elgg_view('input/radio', array('name' => 'lineas_pre', 'align' => 'Vertical', 'options' => $vars['lineas_pres']));
     $lineas_de_investigación .= "<br>";
     $lineas_de_investigación .= "<h5>Lineas Abiertas<hr></h5>";
     $lineas_de_investigación .= elgg_view('input/radio', array('name' => 'lineas_open', 'align' => 'Vertical', 'options' => $vars['lineas_abiertas']));
     $lineas_de_investigación .= "<br>";
}

//Junto los datos de las áreas de la feria para listarlos
$areasChk = '';
if(sizeof($areasF) > 0){
    $areasfF = array();
    foreach ($areasF as $Af){
        $areasfF[$Af['nameA']] = $Af['guidA'];
    }
$areasChk = elgg_view('input/radio', array('name' => 'areasF', 'align' => 'Vertical', 'options' => $areasfF));
}

$terminos_condiciones = elgg_view('input/checkbox', array('name' => 'terminos', 'align' => 'Vertical', 'required' => 'true'));

$guid_F = elgg_view('input/hidden', array('name' => 'guid_feria', 'value' => $feria_guid));
$guid_G = elgg_view('input/hidden', array('name' => 'guid_grupo', 'value' => $guid_grupo));
$guid_I = elgg_view('input/hidden', array('name' => 'guid_inv', 'value' => $guid_inv));
        
$button = elgg_view('input/submit', array('value' => elgg_echo('Inscripción')));

//Junto los datos de la categoria si ella es Innovacion
$categorias_innovacion = '';
if(sizeof($subcategoriasIn) >0 ){
    $categorias_innovacion .= "<input type='text' name='categoria' value ='$categoria_inv' readonly><br>";
    $categorias_innovacion .= elgg_view('input/radio', array('name' => 'subcategorias', 'align' => 'Vertical', 'options' => $subcategoriasIn));
}else{
    $categorias_innovacion = "<input type='text' name='categoria' value ='$categoria_inv' readonly>";
}
$informe_invferia_input=  elgg_view('input/file', array('name'=>'informe_investigacion', 'required' => 'true'));
$escrito_profesor = elgg_view('input/file', array('name'=>'escrito_profesor', 'required' => 'true'));
$presentacion_realizar = elgg_view('input/file', array('name'=>'presentacion'));

$url_descrgar_reglamento = elgg_get_site_url()."file/download/{$guid_reglamento}";
  

/**
 * INICIO DEL BODY PARA EL FORMULARIO
 */
$body = "<div class='form-nuevo-album'>"
            . "<br><br><br>"
            ."<h2 class='title-legend'>Formulario de Inscripción a Ferias</h2><br>"
                . "<h2>$datos_institucion</h2>"
                    . "<div><label>$lbl_tipoferia</label> <input type=text name='tipo_feria' value='$feria_tipo' size='40' readonly><br></div>"
                    . "<div><label>$lbl_nombre_col</label> <input type=text name='nobre_col' value='$institucion' size='60' readonly><br></div>"
                    . "<div><label>$lbl_name_rector</label> <input type=text name='rector_col' value='$rector_institucion' size='40' readonly><br></div>"
                    . "<div><label>$lbl_municipio</label> <input type=text name='municipio_col' value='$municipio_dpto' size='40' readonly><br></div>"
                    . "<div><label>$lbl_direccion</label> <input type=text name='direccion_col' value='$direccion_institucion' size='40' readonly><br></div>"
                    . "<div><label>$lbl_telefono</label> <input type=text name='telefono_col' value='$telefono_institucion' size='40' readonly><br></div>"
                    . "<div><label>$lbl_email</label> <input type=text name='email_col' value='$email_institucion' size='40' readonly><br></div>"
                    . "<br><br>"
            . "<h2>$datos_grupo_inv</h2>"
                . "<div><label>$lbl_name_grupoInv</label> <input type=text name='name_grupo' value='$nombre_grupo' readonly><br></div>"
                . "<div><table class='tabla-integrantes'>"
                    . "<tr>"
                    . "<th>$tlbl_nombreEstudiantes</th>"
                    . "<th>$tlbl_docEstudiantes</th>"
                    . "<th>$tlbl_gradoEstudiantes</th>"
                    . "<th>$tlbl_edadEstudiantes</th>"
                    . "<th>$tlbl_fecha_nacEstudiantes</th>"
                    . "<th>$tlbl_email_telEstudiantes</th>"
                    . "<th>$tlbl_asistirEstudiantes</th>"
                    . "</tr>"
                  
                    . "$estudiantes_tabla"
                   
                . "</table></div>"
            . "<br><br>"
            . "<h2>$datos_maestros_inv</h2>"
                . "<div><table class='tabla-integrantes'>"
                    . "<tr>"
                    . "<th>$tlbl_nombreMaestro</th>"
                    . "<th>$tlbl_asignaturaMaestro</th>"
                    . "<th>$tlbl_telefonoMaestro</th>"
                    . "<th>$tlbl_emailMaestro</th>"
                    . "<th>$tlbl_asistirMaestro</th>"
                    . "</tr>"
                 
                    . "$maestros_inv"
                
                . "</table></div>"
            . "<br>"
            . "<h2>$datos_nivel_participacion</h2>"
                . "<div><p>$niveles_X</p>"
                . "</div><br><br>"
            . "<h2>$datos_categoria_inv</h2>"
                . "<div>$categorias_innovacion"
                . "</div><br><br>"
            . "<h2>$datos_participacion_feria</h2>"
                . "<div><p>$formas_part_feria</p>"
                . "</div><br>"
            . "<h2>$datos_investigación</h2>"
                . "<div><label>$lbl_name_Inv</label> <input type=text name='titulo_inv' value='$titulo_inv' readonly><br></div>"
                . "<div><label>$lbl_pregunta_Inv</label> <input type=text name='pregunta_inv' value='$titulo_inv' readonly><br></div>"
                . "<div><label>$lbl_problema_Inv</label> <input type=text name='problema_inv' value='$problema_inv' readonly><br></div>"
                . "<div><label>$lbl_metodologia_Inv</label> <textarea name='metodologiaInv' required></textarea><br></div>"
                . "<div><label>$lbl_resumen_Inv</label> <textarea name='resumenInv' required></textarea><br></div>"
            . "<br>"
            . "<h2>$datos_lineas_investigación</h2>"
                . "<div>$lineas_de_investigación</div>"
                . "<div><label>$lbl_asesorlinea_inv</label> <input type=text name='asesor_inv' value='No seleccionado' readonly></div><br>"
                . "<div><label>$lbl_areasF_inv</label> $areasChk</div><br>"
                . "<div><label>$lbl_materiales</label></div>"
                . "<div><textarea name='materiales' required></textarea></div>"
                . "<div><p>$terminos_condiciones $aceptar_terminos Vea los terminos <a href='$url_descrgar_reglamento'>aqui</a></p></div>"
            . "<h2>NOTA: </h2>"
                . "<div><label>$lbl_informe_inv</label><label class='lbl-button'><span> Seleccione el Archivo</span>$informe_invferia_input</label></div>"
                . "<div><label>$lbl_escrito_profesor</label><label class='lbl-button'><span> Seleccione el Archivo</span>$escrito_profesor</label></div>"
                . "<div><label>$lbl_presentacion</label><label class='lbl-button'><span> Seleccione el Archivo</span>$presentacion_realizar</label></div>"
                . "<div><p>$mensaje_nota</p></div><br>"
            . "</div>"
            . ""
            . "<div id='' align='center'>"
                . "$guid_F $guid_G $guid_I"
                . "$button"
            . "</div>"
        . "";

echo $body;
?>

