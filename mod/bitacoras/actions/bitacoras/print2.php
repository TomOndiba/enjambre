<?php

/**
 * Action que dependiendo de el número de la bitácora, imprime en pdf el contenido de está
 * @author DIEGOX_CORTEX
 */
$guid = get_input('id');
$guid_cuad = get_input('cuad');
$pagina = get_entity($guid);
$bitacora = (int) get_input('bit');
$cuaderno = get_entity($guid_cuad);
$grupo = get_input('grupo');
$institu = get_input('inst');
$invest = get_input('inv');
$valorador = get_input('valorador');
$area = get_input('area');


$url = $_SERVER['DOCUMENT_ROOT'];

$fl = array('<p>', '</p>');

// Creación del objeto de la clase heredada
switch ($bitacora) {
    // SE IMPRIME LA BITACORA No. 1
    case 1:
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/bitacora1.php');
        //require_once($url . '/elgg2/print_pdf/bitacora1.php');
        $pdf = new imprimirPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(4);
        $pdf->MultiCell(185, 5, utf8_decode('PARA REALIZAR EN LA LIBRETA DE APUNTES Y REGISTRAR EN EL SIGEON'), 0, 'J');

        $pdf->Ln(4);
        $pdf->MultiCell(185, 5, utf8_decode('Nombre de la institución a la que pertenece el grupo de investigación : ' . $pagina->institucion), 0, 'J');

        $pdf->Ln(-2);
        $pdf->Cell(0, 10, utf8_decode('Departamento : ' . $pagina->departamento . '                 Municipio : ' . $pagina->municipio), 0, 1);
        $pdf->Cell(0, 10, utf8_decode('Teléfono : ' . $pagina->telefono . '                                  E-mail de la instritucion   : ' . $pagina->email), 0, 1);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'INTEGRANTES DEL GRUPO', 0, 1);
        // Títulos para la tabla de los estudiantes del grupo
        $header = array('Nombre', 'Edad', 'Grado', 'Rol', 'Sexo', 'E-mail');
        //tabla de los estudiantes del grupo
        $pdf->estudianteTable($header, elgg_get_estudiantes_cuaderno($cuaderno));
        $pdf->Ln(8);
        // Títulos para la tabla de maestros
        $headerM = array(utf8_decode('Nombre del maestro, maestra o adulto(s), acompañante(s) '), utf8_decode('Area(s) del conocimiento en la cual se desempeña'));
        //tabla de maestros
        $pdf->MaestroTable($headerM, elgg_get_maestro_cuaderno($cuaderno));
        $pdf->Ln(8);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(4);
        $pdf->MultiCell(185, 5, utf8_decode('Le sugerimos representar, mediante un emblema, una foto, un dibujo o una caricatura, a su grupo de investigación.'), 0, 'J');

        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Ln(4);
        $pdf->MultiCell(185, 5, utf8_decode('Para el maestro acompañante/coinvestigador:'), 0, 'J');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(4);
        $pdf->MultiCell(185, 5, utf8_decode('1. Describa cóm se enteró de la pertura de la convocatoria del Proyecto Enjambre en su departamento.'), 0, 'J');

        $pdf->Cell(40, 10, utf8_decode('HAGA UN RELATO EN EL QUE:'), 4, 4);
        $pdf->Cell(40, 10, utf8_decode('    -Dé cuenta del proceso que hubo en su institución para conformar el grupo de investigación.'), 4, 4);
        $pdf->Cell(40, 10, utf8_decode('    -Realice una caracterización del grupo de investigación desde sus motivaciones, expectativas'), 4, 4);
        $pdf->Cell(40, 0, utf8_decode('    sentimientos e intereses de sus integrantes.'), 4, 4);
//
        $pdf->Ln(3);
        // $r = utf8_decode(str_replace($fl, '', $pagina->descripcion));
        $pdf->MultiCell(185, 5, utf8_decode('R/: ' . $pagina->descripcion), 0, 'J');

        $pdf->Ln(4);
        $pdf->MultiCell(185, 5, utf8_decode('2. Explique cuáles fueron los motivos que lo llevaron a participar en el Proyecto Enjambre y exprese las '
                        . 'sensaciones personales que le generaron el acompañamiento que realizó para conformar su grupo de investigación.'), 0, 'J');

        $pdf->Ln(3);

        //$re = str_replace($fl, '', $pagina->motivos);
        $pdf->MultiCell(185, 5, html_entity_decode('R/: ' . $pagina->motivos), 0, 'J');

        $pdf->Ln(4);
        $pdf->Cell(40, 10, utf8_decode('Nombre del asesor de línea temática (para llenar cuando le sea asignado):'), 4, 4);
        $pdf->Ln(3);
        $pdf->Cell(40, 10, utf8_decode('R/: ' . $pagina->asesor_linea), 4, 4);

        $pdf->Ln(4);
        $pdf->MultiCell(185, 5, utf8_decode('Bueno, ya vieron la importancia de organizar su grupo de investigación; ahora compartan con otros niños, niñas, '
                        . 'jovenes y adultos acompañantes de Colombia alguna información sobre la experiencia vivida. Por ejemplo,  pdrían escribir una carta a un '
                        . 'amigo, organizar un relato en el que cuenten el proceso, con las anécdotas que les parezcan más interesantes.'), 0, 'J');

        $pdf->Output("Bitacora_1.pdf", "D");
        break;
    // SE IMPRIME LA BITACORA No. 2
    case 2:
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/bitacora2.php');
        //require_once($url . '/elgg2/print_pdf/bitacora2.php');
        $pdf2 = new Bitacora2();
        $pdf2->AliasNbPages();
        $pdf2->AddPage();
        $pdf2->SetFont('Arial', '', 12);
        $pdf2->SetTextColor(0, 0, 0);
        $pdf2->SetAutoPageBreak(true, 30);

        $pdf2->Ln(4);
        $pdf2->MultiCell(185, 5, utf8_decode('A). Escriba cinco de las preguntas que formularon inicalmente los integrantes del grupo de inestigación:'), 0, 'J');

        $pdf2->Ln(4);
        $pdf2->MultiCell(185, 5, utf8_decode('1). ' . $pagina->pregunta1), 0, 'J');
        $pdf2->Ln(2);
        $pdf2->MultiCell(185, 5, utf8_decode('2). ' . $pagina->pregunta2), 0, 'J');
        $pdf2->Ln(2);
        $pdf2->MultiCell(185, 5, utf8_decode('3). ' . $pagina->pregunta3), 0, 'J');
        $pdf2->Ln(2);
        $pdf2->MultiCell(185, 5, utf8_decode('4). ' . $pagina->pregunta4), 0, 'J');
        $pdf2->Ln(2);
        $pdf2->MultiCell(185, 5, utf8_decode('5). ' . $pagina->pregunta5), 0, 'J');

        $pdf2->Ln(4);
        $pdf2->MultiCell(185, 5, utf8_decode('B). Escriba la(s) pregunta(s) de investigación seleccionadas despues de realizar la consulta: '), 0, 'J');

        $pdf2->Ln(3);
        $pdf2->MultiCell(185, 5, utf8_decode('R/: ' . $pagina->pregunta_seleccionada), 0, 'J');

        $pdf2->Ln(4);
        $pdf2->MultiCell(185, 5, utf8_decode('C). En el desarrollo de este proceso, se encopntraron nuevas preguntas. Es muy importante que dejen un registro'
                        . ' escrito de ellas en su bitácora:'), 0, 'J');

        $pdf2->Ln(3);
        $pdf2->MultiCell(185, 5, utf8_decode('R/:' . $pagina->pregunta_nueva), 0, 'J');

        $pdf2->SetFont('Arial', 'I', 12);
        $pdf2->Ln(4);
        $pdf2->MultiCell(185, 5, utf8_decode('Para el maestro acompañante/coinvestigador: Complementar la Bitácora No. 2 de su grupo de investigación:'), 0, 'J');

        $pdf2->SetFont('Arial', '', 12);
        $pdf2->Ln(4);
        $pdf2->MultiCell(185, 5, utf8_decode('Hicieron una consulta (Internet, libros y miembros de la comunidad) a partir de las preguntas de minvestigacón planteadas '
                        . 'inicialmente por su grupo. Con ello se busca reconocer cuáles se habían respondido.'), 0, 'J');

        $pdf2->Ln(4);
        $pdf2->MultiCell(185, 5, utf8_decode('¿Qué información consultada les permitió cambiar, apmliar o reformular las preguntas iniciales? Ejemplo:'), 0, 'J');

        $pdf2->Ln(4);
        $pdf2->MultiCell(185, 5, utf8_decode('En la investigación que Teo hizo sobre la palma real, eencontró que existen 700 especies con ese nombre, entre ellas la '
                        . 'Roystonea regia o palma real cubana.   Así reconoció que la planta que la planta que él quería investigar, no era de esa familia que es oramental. Esto lo llevó a'
                        . 'a precisar que la especie que emplean los campesinos en Colombia tiene usos más interesantes sobre ella. Parte de esta información la encontraron en:'), 0, 'J');

        $pdf2->Ln(3);
        $pdf2->SetFont('Arial', 'I', 12);
        $pdf2->Cell(0, 0, utf8_decode('http://es.wikipedia.org/wiki/Arecaceae'), 0, 0, 'C');

        $pdf2->Ln(4);
        $pdf2->SetFont('Arial', '', 12);
        $pdf2->MultiCell(185, 5, utf8_decode('A). Siguendo este ejemplo, hagan una síntesis de la información que hallaron y describan cómo cambiaron las preguntas iniciales de investigación; '
                        . 'citen la fuente en donde la encontraron (libros, profesores, especialistas, miembros de la comunidad, videotecas, internet y otras fuentes).'), 0, 'J');

        $pdf2->Ln(3);
        $pdf2->MultiCell(185, 5, utf8_decode('R/:' . $pagina->sintesis_informacion), 0, 'J');

        $pdf2->Ln(4);
        $pdf2->MultiCell(185, 5, utf8_decode('B).  Hagan un resumen de la discusion que se dio en el grupo del Proyecto Enjambre para solucionar la o las preguntas de investigación y enuncien los argumentos'
                        . ' que se expusieron para ello.'), 0, 'J');

        $pdf2->Ln(3);
        $pdf2->MultiCell(185, 5, utf8_decode('R/:' . $pagina->resumen), 0, 'J');

        $pdf2->Output("Bitacora_2.pdf", "D");
        break;
    // SE IMPRIME LA BITACORA No. 3
    case 3:
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/bitacora3.php');
        //require_once($url . '/elgg2/print_pdf/bitacora3.php');

        $pdf3 = new Bitacora3();
        $pdf3->AliasNbPages();
        $pdf3->AddPage();
        $pdf3->SetFont('Arial', '', 12);
        $pdf3->SetTextColor(0, 0, 0);
        $pdf3->SetAutoPageBreak(true, 30);

        $pdf3->Ln(4);
        $pdf3->MultiCell(185, 5, utf8_decode('Han pasado de las preguntas iniciales a preguntas de investigación y a plantear el problema de investigación. '
                        . 'Ahora registremóslo en la bitácora No. 3 del Sigeon.'), 0, 'J');

        $pdf3->Ln(4);
        $pdf3->MultiCell(185, 5, utf8_decode('Esto es muy importante, porque la selección del problema de investigación por parte del Comité '
                        . 'Departamental del Proyecto Enjambre depende en gran medida de la claridad con la cual el grupo registre en ella los siguientes aspectos:'), 0, 'J');

        $pdf3->Ln(4);
        $pdf3->MultiCell(185, 5, utf8_decode('A).  Descripción del problema que se quiere investigar. Recuperando lo desarrollado en esta'
                        . 'etapa  de de investigación:  Superposición de ondas, expliquen cuál es el  problema  que  se '
                        . 'han  planeado,  así  como  su  importancia  para los diferentes grupos humanos y ecológicos '
                        . 'afectados.  De igual  manera,  a partir  de los recursos  humanos, físicos y económicos y del '
                        . 'tiempo disponible, argumenten hasta dónde se pretende llegar con la investigación iniciada.'), 0, 'J');
        $pdf3->Ln(3);

        $pdf3->MultiCell(185, 5, utf8_decode('R/:' . $pagina->descripcion_problema), 0, 'J');
        $pdf3->Ln(4);

        $pdf3->MultiCell(185, 5, utf8_decode('B).  Con base en los puntos anteriores, justifiquen la importancia de resolver el problema o avanzar en la solución.'), 0, 'J');
        $pdf3->Ln(3);
        $pdf3->MultiCell(185, 5, utf8_decode('R/:' . $pagina->importancia_problema), 0, 'J');

        $pdf3->Ln(4);
        $pdf3->MultiCell(185, 5, utf8_decode('Escriba esta explicacion en su libreta de apuntes para que posteriormente lo hagan en el Sigeon.'), 0, 'J');

        $pdf3->SetFont('Arial', 'I', 12);
        $pdf3->Ln(4);
        $pdf3->MultiCell(185, 5, utf8_decode('Para el maestro acompañante/coinvestigador: Complementar la Bitácora No. 3 de su grupo de investigación:'), 0, 'J');

        $pdf3->SetFont('Arial', '', 12);
        $pdf3->Ln(4);
        $pdf3->MultiCell(185, 5, utf8_decode('En un escrito relate cuáles elementos le parecieron significativos para el proceso de conformación de grupo de investigación, '
                        . 'formulación de preguntas y planteamiento del problema, en relación con:'), 0, 'J');

        $pdf3->Ln(4);
        $pdf3->MultiCell(185, 5, utf8_decode('    - Las semejanzas y diferencias entre nuestra manera adulta de  hacer  preguntas  y  la  de niños, niñas y jóvenes.'), 0, 'J');

        $pdf3->Ln(4);
        $pdf3->MultiCell(185, 5, utf8_decode('    - Los aspectos a resaltar que observó en el trabajo de niñas, niños y jóvenes en su tránsito de formulación de las preguntas '
                        . 'iniciales a las de investigación y de ahí,  a la elaboración del planteamiento del problema.'), 0, 'J');

        $pdf3->Ln(4);
        $pdf3->Cell(40, 10, utf8_decode('    - Las vivencias de los niños niñas y jóvenes al asumirse como grupo de investigacón.'), 0, 1);

        $pdf3->Ln(3);
        $pdf3->MultiCell(185, 5, utf8_decode('R/:' . $pagina->elementos_significativos), 0, 'J');

        $pdf3->Output("Bitacora_3.pdf", "D");
        break;
    // SE IMPRIME LA BITACORA No. 4
    case 4:
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/bitacora4.php');
        //require_once($url . '/elgg2/print_pdf/bitacora4.php');

        $pdf4 = new Bitacora4();
        $pdf4->AliasNbPages();
        $pdf4->AddPage();
        $pdf4->SetFont('Arial', '', 12);
        $pdf4->SetTextColor(0, 0, 0);
        $pdf4->SetAutoPageBreak(true, 30);

        $pdf4->Ln(4);
        $pdf4->MultiCell(185, 5, utf8_decode('En el Sigeon encontramos un diagrama similar al recorrido de un río, en el que podemos transcribir nuestra trayectoria de indagación, segmento a segmento.'), 0, 'J');

        $pdf4->Ln(4);
        $pdf4->SetFont('Arial', 'I', 12);
        $pdf4->MultiCell(185, 5, utf8_decode('Para el(la) maestro(a)'), 0, 'J');

        $pdf4->SetFont('Arial', '', 12);
        $pdf4->Ln(4);
        $pdf4->MultiCell(185, 5, utf8_decode('Describir las dificultades que se presentaron en el grupo para diseñar la trayectoria de indagacón:'), 0, 'J');
        $pdf4->Ln(3);
        $pdf4->MultiCell(185, 5, utf8_decode('R/:' . $pagina->dificultades), 0, 'J');

        $pdf4->Ln(4);
        $pdf4->MultiCell(185, 5, utf8_decode('Describir la fortalezas del grupo de investigación para tomar decisiones sobre el diseño de las trayectorias y para argumentarlas:'), 0, 'J');
        $pdf4->Ln(3);
        $pdf4->MultiCell(185, 5, utf8_decode('R/:' . $pagina->fortalezas), 0, 'J');

        $pdf4->Ln(4);
        $pdf4->MultiCell(185, 5, utf8_decode('A la luz de las estapas de investigación trabajadas hasta ahora, enuncie lo que para usted serían las principales características de un proceso de formación en el cual la investigación es la estrategia pedagógica:'), 0, 'J');
        $pdf4->Ln(3);
        $pdf4->MultiCell(185, 5, utf8_decode('R/:' . $pagina->caracteristicas), 0, 'J');

        $pdf4->Ln(4);
        $pdf4->MultiCell(185, 5, utf8_decode('Argumente la importancia y viabilidad de colocar a la investigación como estrategia pedagógica en la cultura escolar:'), 0, 'J');
        $pdf4->Ln(3);
        $pdf4->MultiCell(185, 5, utf8_decode('R/:' . $pagina->importancia), 0, 'J');

        $pdf4->Ln(4);
        $pdf4->MultiCell(185, 5, utf8_decode('A partir de su acompañamiento a los grupos de investigación en el Proyecto Enjambre, enuncie las preguntas que le han surgido de este proceso y los aspectos que podrian dar elementos para la transformación de su práctica pedagógica:'), 0, 'J');
        $pdf4->Ln(3);
        $pdf4->MultiCell(185, 5, utf8_decode('R/:' . $pagina->preguntas), 0, 'J');

        $pdf4->Output("Bitacora_4.pdf", "D");
        break;
    case 90:
        //Acta de valoracion de proyectos abiertos...
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/valoracion_abiertos.php');
        //require_once($url . '/elgg2/print_pdf/valoracion_abiertos.php');
        $pdf90 = new valoracion_abiertos();
        $investigacion = new ElggInvestigacion($invest);
        $group = new ElggGroup($grupo);
        $institucion = new ElggInstitucion($institu);
        $evaluaciones = new ElggEvaluacion($guid);
        $pregunta = elgg_get_pregunta_investigacion($invest);

        $valores_primarios = array($institucion->departamento . ', ' . $institucion->municipio, $institucion->name, $group->name, $pregunta, $valorador, $area);
        $valores_puntajes = array($evaluaciones->puntaje_bitacora1, $evaluaciones->puntaje_bitacora2, $evaluaciones->puntaje_bitacora3, $evaluaciones->observacion);

        $pdf90->AliasNbPages();
        $pdf90->AddPage();
        $pdf90->SetFont('Arial', '', 12);
        $pdf90->SetTextColor(0, 0, 0);

        $pdf90->TablaDeDatos($valores_primarios);
        $pdf90->Ln(10);

        $pdf90->TablaDePuntajes($valores_puntajes);

        //$pdf90->Output("Valoración_proyectos_". ".pdf", "D");
        $pdf90->Output();
        break;
    case 91:
        //acta de seleccion...


        $convocatoria = get_entity(get_input('guid_conv'));
        $investigacion = get_entity(get_input('guid_inv'));
        $asunto = get_input('asunto');
        $mensaje = get_input('mensaje');
        //Busca informacion del maestro administrador del grupo para enviarle notificacion y correo informando la selección de la investigacion
        $grupo = elgg_get_relationship_inversa($investigacion, 'tiene_la_investigacion'); // consulta el grupo relacionado con la investigacion para saber el Guid del Maestro que lo creó
        $user = elgg_get_usuario_byId($grupo[0]->owner_guid);

        // Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
        date_default_timezone_set('UTC');
        if (!empty($user->email)) {
            elgg_send_email('comunidadenjambre@gmail.com', $user->email, $asunto, $mensaje);
        }
        messages_send($asunto, $mensaje, $user->guid, 0, false);
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/acta_seleccion.php');
        //require_once($url . '/elgg2/print_pdf/acta_seleccion.php');

        $pdf91 = new acta_seleccion();
        $pdf91->AliasNbPages();
        $pdf91->AddPage();

        $pdf91->SetFont('Arial', '', 12);
        $pdf91->SetTextColor(0, 0, 0);

        $pdf91->Cell(70, 7, utf8_decode("Señores Grupo de Investigación:  "), 0);
        $pdf91->Ln();
        $pdf91->Cell(70, 7, utf8_decode($grupo[0]->name), 0);
        $pdf91->Ln();
        $pdf91->SetFont('Arial', 'i', 12);
        $pdf91->Cell(70, 7, utf8_decode(date("d-m-Y")), 0);
        $pdf91->Ln(18);
        $pdf91->SetFont('Arial', '', 12);
        $pdf91->MultiCell(185, 5, utf8_decode($mensaje), 0, 'J');
        $pdf91->Ln(20);
        $pdf91->MultiCell(185, 5, utf8_decode('Coordinador Departamental'), 0, 'J');
        $pdf91->Output();
        //$pdf91->Output("Acta_selección.pdf", "D");
        break;
    case 92:
        $inscripcion = get_entity($guid);
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/formato_inscripcion_feria_1.php');
        //require_once($url . '/elgg2/print_pdf/formato_inscripcion_feria_1.php');
        $pdf92 = new formato_inscripcion_feria_1();
        $pdf92->AliasNbPages();
        $pdf92->AddPage();

        $pdf92->SetFont('Arial', '', 12);
        $pdf92->SetTextColor(0, 0, 0);


        $valores_institucion = array();

        $pdf92->TablaDeDatosInstitucion($guid);
        $pdf92->Ln(10);
        //$pdf92->Output("Inscripción_de_feria_" . $guid . ".pdf", "D");
        $pdf92->Output();
        break;

    case 93:
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/formato_evaluacion_diariocampoINN.php');
        //require_once($url . '/elgg2/print_pdf/formato_evaluacion_diariocampoINN.php');

        $pdf93 = new formato_evaluacion_diariocampoINN();
        $pdf93->AliasNbPages();
        $pdf93->AddPage();

        $pdf93->datos($guid);

        //$pdf93->Output("VALORACIÓN_INFORME_INVESTIGACIÓN_DIARIO_CAMPO_COMP_INNOVACIÓN_" . $guid . ".pdf", 'D');
        $pdf93->Output();

        break;

    case 94:
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/formato_evaluacion_informeinv_diariocampoINN_inv.php');
        //require_once($url . '/elgg2/print_pdf/formato_evaluacion_informeinv_diariocampoINN_inv.php');

        $pdf94 = new formato_evaluacion_informeinv_diariocampoINN_inv();
        $pdf94->AliasNbPages();
        $pdf94->AddPage();

        $pdf94->datos($guid);

        //$pdf94->Output("VALORACIÓN_INFORME_INV_DIARIO_COMP_INVESTIGACIÓN" . $guid . ".pdf", 'D');
        $pdf94->Output();
        break;

    case 95:
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/formato_valoracion_maestro_escrito.php');
        //require_once($url . '/elgg2/print_pdf/formato_valoracion_maestro_escrito.php');

        $pdf95 = new formato_valoracion_maestro_escrito();
        $pdf95->AliasNbPages();
        $pdf95->AddPage();

        $pdf95->datos($guid);

        //$pdf95->Output("VALORACIÓN_PONENCIA_MAESTRO(A)(ESCRITO)" . $guid . ".pdf", 'D');
        $pdf95->Output();

        break;

    case 96:
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/formato_valoracion_maestro_oral.php');
        //require_once($url . '/elgg2/print_pdf/formato_valoracion_maestro_oral.php');

        $pdf96 = new formato_valoracion_maestro_oral();
        $pdf96->AliasNbPages();
        $pdf96->AddPage();

        $pdf96->datos($guid);

        //$pdf96->Output("VALORACIÓN_PONENCIA_MAESTRO(A)(ORAL)" . $guid . ".pdf", 'D');
        $pdf96->Output();
        break;

    case 97:
        //require_once($url . '/elgg2/print_pdf/formato_eval_informeinv_cuadcampoINN_inv.php');
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/formato_eval_informeinv_cuadcampoINN_inv.php');

        $pdf97 = new formato_eval_informeinv_cuadcampoINN_inv();
        $pdf97->AliasNbPages();
        $pdf97->AddPage();

        $pdf97->datos($guid);

        //$pdf97->Output("ormato_eval_informeinv" . $guid . ".pdf", 'D');
        $pdf97->Output();

        break;

    case 98:
        //require_once($url . '/elgg2/print_pdf/formato_eval_sustentacion_oral_INN.php');
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/formato_eval_sustentacion_oral_INN.php');

        $pdf98 = new formato_eval_sustentacion_oral_INN();
        $pdf98->AliasNbPages();
        $pdf98->AddPage();

        $pdf98->datos($guid);

        //$pdf98->Output("VALORACIÓN_SUSTENTACIÓN_ORAL_INVESTIGACIÓN_catINN_" . $guid . ".pdf", 'D');
        $pdf98->Output();

        break;

    case 99:
        //require_once($url . '/elgg2/print_pdf/formato_eval_sustentacion_oral_INN.php');
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/formato_eval_sustentacion_oral_INN.php');

        $pdf99 = new formato_eval_sustentacion_oral_INN();
        $pdf99->AliasNbPages();
        $pdf99->AddPage();

        $pdf99->datos($guid);

        //$pdf99->Output("VALORACIÓN_SUSTENTACIÓN_ORAL_INVESTIGACIÓN_catINV_" . $guid . ".pdf", 'D');
        $pdf99->Output();

        break;
    case 100:
        //require_once($url . '/elgg2/print_pdf/listado_fina_inv_feria.php');
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/listado_fina_inv_feria.php');

        $feria = get_input('guid_feria');



        $pdf100 = new listado_fina_inv_feria();
        $pdf100->AliasNbPages();
        $pdf100->AddPage();

        $pdf100->datos($feria);

        //$pdf100->Output("Listado".$guid.".pdf", 'F');
        $pdf100->Output();
        break;
    case 101:
        //require_once($url . '/elgg2/print_pdf/formato2_bit7.php');
        require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/formato2_bit7.php');

        $pdf101 = new formato2_bit7();
        $pdf101->AliasNbPages();
        $pdf101->AddPage();

        $pdf101->SetFont('Arial', 'B', 14);
        $pdf101->Cell(0, 10, utf8_decode('TITULO, NOMBRE DE LA INVESTIGACIÓN'), 0, 0, 'C');
        $pdf101->Ln(5);
        $pdf101->SetFont('Arial', 'I', 10);
        $pdf101->Cell(0, 10, utf8_decode('(Formato fuente: Mayúscula Negrilla Arial 14, centrado)'), 0, 0, 'C');

        $pdf101->Ln(5);
        $pdf101->SetFont('Arial', 'B', 10);
        $pdf101->Cell(0, 10, utf8_decode('NOMBRE DEL GRUPO DE INVESTIGACIÓN:'), 0, 0, 'C');
        $pdf101->Ln(5);
        $pdf101->SetFont('Arial', 'I', 10);
        $pdf101->Cell(0, 10, utf8_decode('(Formato fuente: Mayúscula, Arial 10 negrilla, centrado)'), 0, 0, 'C');
        $pdf101->Ln(5);
        $pdf101->SetFont('Arial', '', 10);
        $pdf101->Cell(0, 10, utf8_decode('Investigadores:'), 0, 0, 'C');
        $pdf101->Ln(5);
        $pdf101->Cell(0, 10, utf8_decode('Co Investigadores:'), 0, 0, 'C');
        $pdf101->Ln(5);
        $pdf101->SetFont('Arial', 'I', 10);
        $pdf101->Cell(0, 10, utf8_decode(' (Formato fuente: solo mayúsculas al inicio de cada palabra, Arial 10, centrado)'), 0, 0, 'C');
        $pdf101->Ln(5);
        $pdf101->SetFont('Arial', 'B', 12);
        $pdf101->Cell(0, 10, utf8_decode('Nombre IE - Municipio'), 0, 0, 'C');
        $pdf101->Ln(5);
        $pdf101->SetFont('Arial', 'I', 10);
        $pdf101->Cell(0, 10, utf8_decode('(Formato fuente: solo mayúsculas al inicio de cada palabra, Arial 12, centrado)'), 0, 0, 'C');
        $pdf101->Ln(8);
        $pdf101->SetFont('Arial', 'B', 12);
        $pdf101->MultiCell(185, 5, utf8_decode('Breve relato que da cuenta de la pregunta, cómo llegaron a ella y cuál es la meta final. Min 80, Max 110 palabras '), 0, 'J');
        $pdf101->Ln(5);
        $pdf101->MultiCell(185, 5, utf8_decode('La metodología utilizada para alcanzar la meta propuesta.   Min 50, Max 60 palabras '), 0, 'J');
        $pdf101->Ln(5);
        $pdf101->MultiCell(185, 5, utf8_decode('Resultados y hallazgos importantes 70- 80 palabras'), 0, 'J');
        $pdf101->Ln(5);
        $pdf101->MultiCell(185, 5, utf8_decode('Aprendizajes, logros alcanzados y dificultades presentadas en el proceso de investigación.  Min 80, Max 100 palabras   '), 0, 'J');
        $pdf101->Ln(5);
        $pdf101->MultiCell(185, 5, utf8_decode('Conclusiones del grupo sobre el estudio del problema de investigación.    40- 50 palabras '), 0, 'J');
        $pdf101->Ln(5);
        $pdf101->MultiCell(185, 5, utf8_decode('Enumere mínimo tres citas bibliográficas'), 0, 'J');
        $pdf101->Ln(5);
        $pdf101->SetFont('Arial', 'BI', 12);
        $pdf101->MultiCell(185, 5, utf8_decode('(Formato Arial 12, justificado)'), 0, 'J');
        $pdf101->Ln(5);
        $pdf101->SetFont('Arial', 'B', 12);
        $pdf101->MultiCell(185, 5, utf8_decode('El contenido del artículo no debe superar las 400 palabras ni debe ser inferior a 320 palabras .'), 0, 'J');
        $pdf101->Ln(5);
        $pdf101->SetFont('Arial', 'B', 12);
        $pdf101->Cell(0, 10, utf8_decode('ANEXAR: min. 1, máx.: 2 fotos.'), 0, 0, 'J');
        $pdf101->SetTextColor(255, 0, 0);
        $pdf101->Ln(5);
        $pdf101->Cell(0, 10, utf8_decode('CITAR LAS FUENTES DE FOTOS, CUADROS, DIAGRAMAS Y OTROS.      '), 0, 0, 'J');
        $pdf101->Ln(10);
        $pdf101->SetTextColor(0, 0, 0);
        $pdf101->SetFont('Arial', 'B', 12);
        $pdf101->MultiCell(185, 5, utf8_decode('Nota:  Tener en cuenta las recomendaciones de la página 90 de la Guía de Xua y Teo.'), 0, 'J');

        $pdf101->Output();
        break;

    case 102:
        require_once (elgg_get_plugins_path() . 'reporte/views/default/print/imprimir_pdf.php');
        $titulo = get_input('titulo');
        $header = get_input('header');
        $tabla = get_input('data');
        //require_once($url . '/elgg2/print_pdf/bitacora1.php');
        $pdf = new imprimirPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(4);


        $pdf->Ln(4);


        //tabla de los estudiantes del grupo
        $pdf->pintarTable($header, $tabla);
        $pdf->Ln(8);

        $pdf->Output();
        break;
}


x();

//forward(REFERER);
