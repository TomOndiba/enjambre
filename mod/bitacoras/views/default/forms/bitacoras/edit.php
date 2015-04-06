

<div class="editar-bitacoras">
    <?php
    /**
     * Page edit form body
     *
     * @package ElggPages
     */
    $bitacora = $vars['bitacora'];

  

    if ($bitacora == 1) {
        $variables = elgg_get_config('bitacoras');
    } else if ($bitacora == 2) {
        $variables = elgg_get_config('bitacoras2');
    } else if ($bitacora == 3) {
        $variables = elgg_get_config('bitacoras3');
//    } else if ($bitacora == 4) {
//        $variables = elgg_get_config('bitacoras4');
//    } else if ($bitacora == 5) {
//        $variables = elgg_get_config('bitacoras5');
    } else if ($bitacora == 6) {
        $variables = elgg_get_config('bitacoras6');
    } else if ($bitacora == 6.1) {
        $variables = elgg_get_config('bitacoras6.1');
    } else if ($bitacora == 6.2) {
        $variables = elgg_get_config('bitacoras6.2');
    }

    $user = elgg_get_logged_in_user_entity();
    $entity = elgg_extract('entity', $vars);
    $can_change_access = true;


    if ($user && $entity) {
        $can_change_access = ($user->isAdmin() || $user->getGUID() == $entity->owner_guid);
    }

//variable que sireve para ver en que pregunta voy en caso de ser la bitacora 5, alternando en tre par e impar.
    $validador = 20;
    $tabla_bit5 = '';
    foreach ($variables as $name => $type) {
// don't show read / write access inputs for non-owners or admin when editing
        if (($type == 'access' || $type == 'write_access') && !$can_change_access) {
            continue;
        }

// don't show parent picker input for top or new pages.
        if ($name == 'parent_guid' && (!$vars['parent_guid'] || !$vars['guid'])) {
            continue;
        }

        if ($type == 'parent') {
            $input_view = "bitacoras/input/$type";
        } else {
            $input_view = "input/$type";
        }

        if ($name == 'descripcion') {

            //Muestra los Integrantes del grupo que pertenecen al cuaderno
            echo '<br><label style="font-size:16px; font-weight:700;">INTEGRANTES DEL GRUPO </label><br><br>';

            $listado = $vars['integrantes'];

            $tabla1.="<table class='tabla-integrantes' width='30%' align='center'> 
                                <tr> <th>Nombre</th>
                                   <th> Edad </th>
                                   <th>Grado</th>
                                   <th>Sexo</th>
                                   <th>Email</th>
                                </tr>";



            foreach ($listado as $user) {

                $nombres = $user['nombre'] . " " . $user['apellidos'];
                $edad = $user['edad'];
                $curso = $user['curso'];
                $sexo = $user['sexo'];
                $email = $user['email'];

                $tabla1.="<tr>
                                            <td>$nombres</td>
                                            <td>$edad </td>
                                            <td>$curso</td>
                                            <td>$sexo</td>
                                            <td>$email</td>
                                         </tr>";
            }

            $tabla1.="</table><br>";

            if (sizeof($listado) > 0)
                $int = $tabla1;
            else
                $int = "<label> Debe agregar Integrantes al cuaderno </label> <br>";

            echo $int;


            //Muestra los Maestros colaboradores del Cuaderno


            $maestros = $vars['maestros'];

            $tabla2.="<table class='tabla-integrantes' width='30%' align='center'> 
                                    <tr> <th>Nombre del maestro(a) o adulto(s) acompañante(s)</th>
                                         <th>Área del conocimiento en la que se desempeña</th>
                                       
                                    </tr>";



            foreach ($maestros as $maestro) {

                $nombres = $maestro['nombre'] . " " . $maestro['apellidos'];
                $especialidad = $maestro['area'];
                $tabla2.="<tr>
                                                <td>$nombres</td>
                                                <td>$especialidad</td>
                                             </tr>";
            }

            $tabla2.="</table><br>";

            if (sizeof($maestros) > 0)
                $maestros_acomp = $tabla2;
            else
                $maestros_acomp = "<label> Debe agregar Maestro Acompañante al cuaderno </label> <br> <br>";

            echo $maestros_acomp;
        }

        //Se valida que, solo para la bitacora 5, y el titulo que sea numero impar imprima los div
   
        //Verifico que sean o no los segmentos para añadir texto diferente

        if ($name == 'segmento1' || $name == 'segmento2' || $name == 'segmento3') {
            ?>

            <div>
                <label><?php
//                  
//                    echo elgg_echo("pages:$name");
                    ?></label>
                <?php
            } else {
                if ($bitacora == 5 && $validador % 2 != 0) {
//                   
//                    $nombre = elgg_echo("pages:$name");
//                    echo "<div><div class='div-name-bit5'><label>$nombre</label></div><div class='div-value-bit5'>";
//                    
//                    $valor =  elgg_view($input_view, array(
//                                    'name' => $name,
//                                    'value' => $vars[$name],
//                                    'class' => $class,
//                                    'placeholder' => $name,
//                                    'entity' => ($name == 'parent_guid') ? $vars['entity'] : null,
//                                ));
//                    
//                    $tabla_bit5 = "<table>"
//                                    . "<tr>"
//                                        . "<th>$valor</th>"
//                                        . "<th>$valor</th>"
//                                        . "<th>$valor</th>"
//                                    ."</tr>"
//                                . "</table>";
//                    echo $tabla_bit5;
                } else if ($bitacora == 5 && $validador % 2 == 0 && $name != 'title4') {
//                    echo "<label> </label><div class='div-value-bit5'>";
                } else {
                    if ($name == "title0" || $name == "title1" || $name == "title2" || $name == "title5" || $name == "title6" || $name == "title7") {
                        ?>
                        <div>
                            <h2 class="title-legend"><?php
                                
                                echo elgg_echo("pages:$name");
                                ?></h2><?php
                        } else {
                            ?>

                            <div>
                                <label><?php
                                    echo elgg_echo("pages:$name");
                                    ?></label>
                                <?php
                            }
                            if ($bitacora != 5) {//que aplique para que sea diferente de bitacora 5
                                if ($type != 'longtext') {
                                    echo '<br />';
                                }
                            }

//              
                            if ($bitacora == 5) {//se valida que sea bitacora 5 para acomodar los text a medida del formulario
//                                $place = '';
//                                if ($validador % 2 == 0) {
//                                    $place = 'Porcentaje %';
//                                } else {
//                                    $place = 'Total $';
//                                }
//
//                                echo elgg_view($input_view, array(
//                                    'name' => $name,
//                                    'value' => $vars[$name],
//                                    'class' => $class,
//                                    'placeholder' => $place,
//                                    'entity' => ($name == 'parent_guid') ? $vars['entity'] : null,
//                                ));
//
//                                if ($validador % 2 == 0 && $name != 'title4') {
//                                    echo "</div>";
//                                }
//                                $validador--;
                            } else {
                                $clase = "";
                                if ($name == "institucion" || $name == "departamento" || $name == "municipio" || $name == "direccion" || $name == "email" || $name == "telefono" || $name == "nombre_grupo" || $name == "asesor_linea") {
                                    $clase = "deshabilitado";
                                }

                                echo elgg_view($input_view, array(
                                    'name' => $name,
                                    'value' => $vars[$name],
                                    'class' => $clase,
                                    'entity' => ($name == 'parent_guid') ? $vars['entity'] : null,
                                )) . "<br>";
                            }
                        }
                    }
                    ?>
                </div>
                <?php
            }


            echo '<div class="elgg-foot">';
            if ($vars['guid']) {
                echo elgg_view('input/hidden', array(
                    'name' => 'page_guid',
                    'value' => $vars['guid'],
                ));
            }
            echo elgg_view('input/hidden', array(
                'name' => 'container_guid',
                'value' => $vars['container_guid'],
            ));
            if (!$vars['guid']) {
                echo elgg_view('input/hidden', array(
                    'name' => 'parent_guid',
                    'value' => $vars['parent_guid'],
                ));
            }

            echo elgg_view('input/hidden', array(
                'name' => 'guid_cuaderno',
                'value' => $vars['guid_cuaderno'],
            ));

            echo elgg_view('input/hidden', array(
                'name' => 'guid_grupo',
                'value' => $vars['guid_grupo'],
            ));

            echo elgg_view('input/hidden', array(
                'name' => 'bitacora',
                'value' => $vars['bitacora'],
            ));
            echo '<div class="contenedor-button">';
            echo elgg_view('input/submit', array('value' => elgg_echo('save'), 'class' => 'link_button'));

            echo '</div></div>';
            ?>
        </div>   
           
        <script>
            $(".deshabilitado").attr('readonly', true);
        </script>