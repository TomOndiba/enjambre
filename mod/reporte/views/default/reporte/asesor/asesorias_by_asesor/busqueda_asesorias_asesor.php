<h2 class="titulo-reportes title-legend">Asesorias por Asesor</h2>

<?php
/**
 * Vista que imprime la búsqueda del asesor
 */
$input = elgg_view('input/text', array('id' => 'input-usuario', 'autocomplete' => "off", 'placeholder' => 'Digite el nombre del Asesor'));

$usuario = elgg_get_logged_in_user_entity();
$amigos = elgg_get_asesores();
$cantidad = sizeof($amigos);
?>
<div>

    <div class="mensaje-para">


        <div id="usuario-agregados">

        </div>
        <div id="input">
            <label>Nombre del Asesor:</label>
            <?php echo $input; ?>
        </div>
    </div>
    <div class="inputs-hidden"></div>
    <div id="output-usuarios" style="max-height: 300px; overflow-y: auto">

    </div>


</div>
<div id='investigaciones'>
    
</div>
<div id="result">

</div>
<script>
    function verificarAsesor(guid, nombre) {
        elgg.get('ajax/view/reporte/asesor/asesorias_by_asesor/investigaciones_asesoradas', {
            timeout: 30000,
            data: {
                asesor: guid
            },
            success: function(result, success, xhr) {
                $('#investigaciones').html(result);
                //$('#usuario-agregados').html(nombre);

            },
        });
    }

    var agregados = new Array();
    var amigos = new Array(<?php echo $cantidad; ?>);
    var guids = new Array(<?php echo $cantidad; ?>);
    var imagenes = new Array(<?php echo $cantidad; ?>);
<?php
for ($i = 0; $i < $cantidad; $i++) {
    ?>
        amigos[<?php echo $i; ?>] = "<?php echo $amigos[$i]->name . " " . $amigos[$i]->apellidos; ?>";
        guids[<?php echo $i; ?>] = "<?php echo $amigos[$i]->guid; ?>";
        imagenes[<?php echo $i; ?>] = "<?php echo $amigos[$i]->getIconURL(); ?>";
    <?php
}
?>
    $(document).keyup(function(event) {
        if (event.which == 27)
        {
            $("#output-usuarios").hide();

        }

    });

    $(document).ready(function() {
        $("#input-usuario").focus();
        $("#input-usuario").live('keyup', function() {
            var nombre = $("#input-usuario").val();
            var pos = obtenerAmigosPorNombre(nombre);
            var cadena = llenarDivUsuarios(pos);
            var elemento = document.getElementById('input-usuario');
            var pos = getAbsoluteElementPosition(elemento);
            cambiarPosicion(pos);
            $("#output-usuarios").html(cadena);
            $("#output-usuarios").show();
            if (event.which == 27)
            {
                $("#output-usuarios").hide();
            }
            $(".info-evaluador-form").live('click', function() {
                var posicion = $(this).attr('id');
                agregados.push(posicion);
                var usuario = cargarUsuario(posicion);
                var ocultos = crearInputHidden(posicion);
                $(".inputs-hidden").append(ocultos);
                //$("#usuario-agregados").append(usuario);
                $("#output-usuarios").html("");
                $("#input-usuario").val("");
                $("#input-usuario").focus();
                $("#output-usuarios").hide();
                //$("#input").hide();
            });
        });

    });

    function cambiarPosicion(pos) {
        var top = pos.top + 35;
        $("#output-usuarios").css({
            "top": top + "px",
            "left": pos.left + "px"
        });
    }

    function obtenerAmigosPorNombre(nombre) {
        var posiciones = [];
        for (var i = 0; i < amigos.length; i++) {
            var amigo = amigos[i].toUpperCase();
            if (amigo.indexOf(nombre.toUpperCase()) != -1) {
                posiciones.push(i);
            }
        }
        return posiciones;
    }

    function llenarDivUsuarios(posiciones) {
        var cadena = "<div>";
        for (var i = 0; i < posiciones.length; i++) {         
                cadena += "<div class='info-evaluador-form' id='" + posiciones[i] + "' onclick='verificarAsesor(" + guids[posiciones[i]] + ",\"" + amigos[posiciones[i]] + " \" )'><div class='row'><img src='" + imagenes[posiciones[i]] + "'width='32'/></div><div class='row' style='margin-left:10px;font-weight:700;'>" + amigos[posiciones[i]] + "</div></div>";         
        } 
        cadena += "</div>";
        return cadena;
    }

    function cargarUsuario(pos) {
        var resultado = "<h2 class='title-legend'>" + amigos[pos] + "</h2>";
        return resultado;
    }

    function estaAgregado(posicion) {
        for (var i = 0; i < agregados.length; i++) {
            if (agregados[i] == posicion) {
                return true;
            }
        }
        return false;
    }

    function crearInputHidden(pos) {
        var resultado = "<input type='hidden' id='usuarios' value='" + guids[pos] + "' name='usuarios'/>";

        return resultado;
    }

    function getAbsoluteElementPosition(element) {
        if (typeof element == "string")
            element = document.getElementById(element)

        if (!element)
            return {top: 0, left: 0};

        var y = 0;
        var x = 0;
        while (element.offsetParent) {
            x += element.offsetLeft;
            y += element.offsetTop;
            element = element.offsetParent;
        }
        return {top: y, left: x};
    }
</script>
