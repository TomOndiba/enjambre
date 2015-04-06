<?php


$guid = $vars['guid'];
$id = elgg_view('input/hidden', array('name' => 'id_grupo', 'value' => $guid));
$nombre_input = elgg_view('input/text', array('name' => 'nombre', ));
$button = elgg_view('input/submit', array('id' => 'aceptar', 'value' => elgg_echo('Crear')));
$site_url= elgg_get_site_url();

echo <<<HTML


<div class="form-nuevo-album">
    <h2 class="title-legend">Iniciativa de investigación</h2>

<div>$id
</div>

<div><br>
<label>Nombre: </label><br />
$nombre_input
</div>
  
<div class="contenedor-button" align='center'>
$button
</div>
      
HTML;
?>

<script>

    $(document).ready(function() {
        $(".elgg-form-cuaderno-campo-crear").validate({/*sustituir "formulario" por el id de vuestro formulario*/
            rules: {
                nombre: {/*id del campo que se aplica la regla*/
                    required: true,
                    minlength: 3/*caracteres mínimos*/
                },
                
              
            },
            messages: {
                nombre: {
                    required: "Es necesario el nombre de la iniciativa para registrarla",
                    minlength: "Minimo 3 caracteres!"
                },
               
            }
        });
    });
</script>