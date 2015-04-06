<?php
$guid_inv=get_input('investigacion');

?>
<script>
$(document).ready(function() {
        $('[data-tooltip!=""]').qtip({// Grab all elements with a non-blank data-tooltip attr.
            style: "qtip-bootstrap",
            content: {
                attr: 'data-tooltip'
            }
        })
    })
</script>
<div class="banner-etapa-4">
    <h1>Método Pedagógico 8,9</h1>
    <div class="div-cerrar-2" onClick="cerrarEtapa()" data-tooltip="Cerrar"></div>
    <div class="div-ver-cuaderno-etapa" data-tooltip="Ver Diario de Campo de la etapa cuatro" onClick="verDiarioInvestigacion( <?php echo $guid_inv;?> ,'cuatro' );cerrarEtapa();" data-reveal-id="myModal-diario"></div>
    <div class="div-ver-bitacoras"  onclick="verBitacoras4(<?php echo $guid_inv;?>)" data-tooltip="Ver Bitacoras" ></div>
</div>
<div class="banner-etapa-footer">
</div>
<div class="contenido-etapa">
    <div class="izquierda">
        <div class="contenido-item" id="contenido-ajax">

        </div>
    </div>
    <div class="derecha">
        <div class="menu-etapa">
           <ul>
                <li class="item-1"  onclick="cargarComponentes2(4,'formacion', <?php echo $guid_inv ?>, 'Caja de Herramientas')">
                    <div class="titulo-item">
                         <div class="triangulo-item-1"></div>
                        <h3>FORMACION</h3>
                    </div>
                </li>

                <li class="item-2" onclick="cargarComponentes(4,'comunicacion',<?php echo $guid_inv ?>)">
                    <div class="titulo-item">
                         <div class="triangulo-item-2"></div>
                        <h3>COMUNICACION</h3>
                    </div>
                </li>

                <li class="item-3" onclick="cargarComponentes(4,'acompanamiento',<?php echo $guid_inv ?>)">
                    <div class="titulo-item">
                         <div class="triangulo-item-3"></div>
                        <h3>ACOMPAÑAMIENTO</h3>
                    </div>
                </li>

                <li class="item-4"  onclick="cargarComponentes(4,'sistematizacion',<?php echo $guid_inv ?>)">
                    <div class="titulo-item">
                        <div class="triangulo-item-4"></div>
                        <h3>SISTEMATIZACION</h3>
                    </div>
                </li>

                <li class="item-5"  onclick="cargarComponentes(4,'evaluacion',<?php echo $guid_inv ?>)">
                    <div class="titulo-item">
                         <div class="triangulo-item-5"></div>
                        <h3>EVALUACION</h3>
                    </div>
                </li>
                <li class="item-6" onclick="cargarComponentes(4,'herramientas',<?php echo $guid_inv ?>)">
                    <div class="titulo-item">
                         <div class="triangulo-item-6"></div>
                        <h3>HERRAMIENTAS</h3>
                    </div>
                </li>
                <li class="item-7">
                    <div class="titulo-item" onclick="cargarComponentes(4,'innovacion',<?php echo $guid_inv ?>)">
                         <div class="triangulo-item-7"></div>
                        <h3>INNOVACION</h3>
                    </div>
                </li> 


            </ul>
        </div>
    </div>
</div>
<div class="footer-etapa-4">

</div>

<script>

function verBitacoras4(guid){
    
     elgg.get('ajax/view/etapa/etapa4', {
            timeout: 30000,
            data: {
                investigacion:guid,
            },
            success: function(result, success, xhr) {
                $('.pop-up-contenedor').html(result);
                cargarBitacoras(guid);
                animarPopUp();
            },
        });
}


function cargarBitacoras(guid) {
   
    elgg.get('ajax/view/etapa/bitacoras_etapa4', {
        timeout: 30000,
        data: {
            guid_inv: guid,
        },
        success: function(result, success, xhr) {
            $('#contenido-ajax').html(result);
            //animarPopUp();
        },
    });
}



</script>