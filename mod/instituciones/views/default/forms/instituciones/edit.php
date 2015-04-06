<div class="form-nuevo-album" style="margin-top: 30px; width: 92%; margin-left: 2%;margin-right: 2%;">
    <style>
    .thumb{ 
        display: inline-block;
        margin:5px;
        background-color: ghostwhite;
    }

    .thumb>img{
        height: 105px;
        border:none;
    }
</style>
<?php

     echo "<h2 class='title-legend'>Editar Institución</h2>";   
    
$instructions = elgg_echo('help:admin:instruct');
elgg_load_js("mun-dpto");
elgg_load_js('validate');
$institucion= $vars["institucion"];

$file=elgg_view("input/file", array('name' => 'icon', 'id'=>'files',  'onchange'=>'nombre(this.value)'));

$nombre_input = elgg_view('input/text', array(
    'name' => 'nombre',
    'value'=> $vars['nombre'],
    'placeholder' => 'Nombre de la Institución'
        ));
$tipo_institucion=elgg_view('input/dropdown', array(
    'name'=>'tipo_institucion',
    'value'=>$vars['tipo_inst'],
    'options_values'=>array(''=>'Seleccione','Rural'=>'Rural', 'Urbana'=>'Urbana',)
     ));

$corregimiento=elgg_view('input/text', array(
   'name'=>'corregimiento',
   'value'=>$vars['corregimiento']
));


$direccion_input = elgg_view('input/text', array(
    'name' => 'direccion',
    'value' => $vars['direccion']
        ));
$telefono_input = elgg_view('input/text', array(
    'name' => 'telefono',
    "value" => $vars['telefono']
        ));
$director_input = elgg_view('input/text', array(
    'name' => 'director',
    "value" => $vars['director']
        ));
$email_input = elgg_view('input/email', array(
    'name' => 'email',
    "value" => $vars['email']
        ));
$pagina_input = elgg_view('input/text', array(
    'name' => 'website',
    "value" => $vars['website']
        ));

$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Guardar')
        ));


$params=array('departamento_ins'=>$vars['departamento'], 'municipio_ins'=>$vars['municipio']);
$dpto_municipio = elgg_view("municipios_departamento",$params);

$guid_inst=  elgg_view('input/hidden', array('name'=>'guid', 'value'=>$vars['guid']));

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
   <label>Tipo de Institución</label>$tipo_institucion
</div>       
$dpto_municipio       
<div>
        <label>Corregimiento </label> $corregimiento
</div>
        
<div>
    <label>Dirección</label>$direccion_input
</div>
<div>
    <label>Telefono</label>$telefono_input
</div>
<div>
    <label>Nombre del Director</label>$director_input
</div>
<div>
    <label>Email</label><br />$email_input
</div>
<div>
    <label>Página Web</label>$pagina_input
</div>
<div class="elgg-foot">
$button
        $guid_inst
</div>
HTML;
?>
</div>

<script>

    $(document).ready(function() {
        $(".elgg-form-instituciones-edit").validate({/*sustituir "formulario" por el id de vuestro formulario*/
            rules: {
                nombre: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                
               tipo_institucion:{
                   required:true,  
               },
               direccion: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                director: {/*id del campo que se aplica la regla*/
                    required: true,
                },
               
                email: {/*id del campo que se aplica la regla*/
                    required: true,
                    email:true
                },
               
            },
            messages: {
                nombre: {
                    required: "Es necesario el nombre de la Institución para registrarla",
                },
                tipo_institucion:{
                   required:"Este campo es obligatorio",  
               },
                direccion: {
                    required: "Este campo es obligatorio",
                },
                director: {
                    required: "Este campo es obligatorio",
                },
                email: {/*id del campo que se aplica la regla*/
                    required: "Este campo es obligatorio",
                    email: "Por favor, digite una direccioón de correo válida"
                },
               
            }
        });
    });
    
    
    
    
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object
          $("#list").html("");
        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                  
                    var span = document.createElement('span');
                    span.innerHTML = ['<div class="thumb"><img class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '"/></div>'].join('');
                    document.getElementById('list').insertBefore(span, null);
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }

    document.getElementById('files').addEventListener('change', handleFileSelect, false);
    
    
    
     function nombre(fic) {
        fic = fic.split('\\');
        var nombre=fic[fic.length - 1];
        if(nombre==""){
            nombre="Seleccione aquí la imagen";
        }
        $(".lbl-button span").html(nombre);
    }
</script>