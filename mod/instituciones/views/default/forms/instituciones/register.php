

<div class="content-coordinacion">
    <div class="titulo-coordinacion">
        <h2>Administración</h2>
    </div>
    <div class="menu-coordinacion">
        <?php echo elgg_view("convocatorias/menu_admin", array()); ?>
    </div>




    <div class="contenido-coordinacion">
        <div class="titulo-coordinacion">
            <h2>Registrar Institución</h2>
        </div>

        <?php
        $instructions = elgg_echo('help:admin:instruct');
        elgg_load_js("mun-dpto");
        elgg_load_js('validate');

        $file = elgg_view("input/file", array('name' => 'icon', 'id' => 'files'));

        $nombre_input = elgg_view('input/text', array(
            'name' => 'nombre',
            'placeholder' => 'Nombre de la Institución'
        ));


        $tipo_institucion = elgg_view('input/dropdown', array(
            'name' => 'tipo_institucion',
            'options_values' => array('' => 'Seleccione', 'Rural' => 'Rural', 'Urbana' => 'Urbana')
        ));

        $corregimiento = elgg_view('input/text', array(
            'name' => 'corregimiento',
        ));

        $direccion_input = elgg_view('input/text', array(
            'name' => 'direccion',
        ));
        $telefono_input = elgg_view('input/text', array(
            'name' => 'telefono',
        ));
        $director_input = elgg_view('input/text', array(
            'name' => 'director',
        ));
        $email_input = elgg_view('input/email', array(
            'name' => 'email',
        ));
        $pagina_input = elgg_view('input/text', array(
            'name' => 'website',
        ));

        $button = elgg_view('input/submit', array(
            'value' => elgg_echo('Registrar')
        ));
        $dpto_municipio = elgg_view("municipios_departamento");


//     echo "<h2 class='title-legend'>Registrar Institución</h2>";



        echo <<<HTML

  <div><label>$instructions</label></div>
     <div>
        <label>Seleccione una imagen para la Institución</label>
        <label class="lbl-button">
            <span>Seleccione aquí la imagen</span> $file
        </label>
    </div>
     
<output id="list"></output>

<div>
    <label>Nombre</label><br />$nombre_input
</div>
        
        
<div>
    <label>Tipo de Institución</label><br />$tipo_institucion
</div>       
    
$dpto_municipio  
     
 <div>
        <label>Corregimiento </label> $corregimiento
</div>       
<div>
    <label>Dirección</label><br />$direccion_input
</div>
<div>
    <label>Telefono</label><br />$telefono_input
</div>
<div>
    <label>Nombre del Director</label><br />$director_input
</div>
<div>
    <label>Email</label><br />$email_input
</div>
<div>
    <label>Página Web</label><br />$pagina_input
</div>
<div class="elgg-foot">
$button
</div>
HTML;
        ?>

    </div>


    <script>

        $(document).ready(function() {
            $(".elgg-form-instituciones-register").validate({/*sustituir "formulario" por el id de vuestro formulario*/
                rules: {
                    nombre: {/*id del campo que se aplica la regla*/
                        required: true,
                       
                    },
//                    tipo_institucion: {
//                        required: true,
//                    },
//                    direccion: {/*id del campo que se aplica la regla*/
//                        required: true,
//                        
//                    },
//                    director: {/*id del campo que se aplica la regla*/
//                        required: true,
//                    },
//                    email: {/*id del campo que se aplica la regla*/
//                        required: true,
//                        email: true
//                    }

                },
                messages: {
                    nombre: {
                        required: "Es necesario el nombre de la Institución para registrarla",
                       
                    },
//                    tipo_institucion: {
//                        required: "Este campo es obligatorios",
//                    },
//                    direccion: {
//                        required: "Este campo es obligatorio",
//                    },
//                    director: {
//                        required: "Este campo es obligatorio",
//                    },
//                    email: {/*id del campo que se aplica la regla*/
//                        required: "Este campo es obligatorio",
//                        email: "Por favor, digite una direccioón de correo válida"
//                    },
                }
            });
        });
    </script>
