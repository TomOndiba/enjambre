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
<div class="banner-etapa-2">
    <h1>Indagación</h1>
         <div class="div-cerrar-2" onClick="cerrarEtapa()" data-tooltip="Cerrar"></div>
         <div class="div-ver-cuaderno-etapa" onClick="verDiarioInvestigacion( <?php echo $guid_inv;?> ,'dos' );cerrarEtapa();" data-tooltip="Ver Diario de La etapa 2" data-reveal-id="myModal-diario"></div>
         <div class="div-ver-bitacoras"  onclick="verBitacoras2(<?php echo $guid_inv;?>)" data-tooltip="Ver Bitacoras" ></div>
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
                <li class="item-1"  onclick="cargarComponentes2(2,'formacion', <?php echo $guid_inv ?>, 'Caja de Herramientas')">
                    <div class="titulo-item">
                         <div class="triangulo-item-1"></div>
                        <h3>FORMACION</h3>
                    </div>
                </li>

                <li class="item-2" onclick="cargarComponentes(2,'comunicacion',<?php echo $guid_inv ?>)">
                    <div class="titulo-item">
                         <div class="triangulo-item-2"></div>
                        <h3>COMUNICACION</h3>
                    </div>
                </li>

                <li class="item-3" onclick="cargarComponentes(2,'acompanamiento',<?php echo $guid_inv ?>)">
                    <div class="titulo-item">
                         <div class="triangulo-item-3"></div>
                        <h3>ACOMPAÑAMIENTO</h3>
                    </div>
                </li>

                <li class="item-4"  onclick="cargarComponentes(2,'sistematizacion',<?php echo $guid_inv ?>)">
                    <div class="titulo-item">
                        <div class="triangulo-item-4"></div>
                        <h3>SISTEMATIZACION</h3>
                    </div>
                </li>

                <li class="item-5"  onclick="cargarComponentes(2,'evaluacion',<?php echo $guid_inv ?>)">
                    <div class="titulo-item">
                         <div class="triangulo-item-5"></div>
                        <h3>EVALUACION</h3>
                    </div>
                </li>
                <li class="item-6" onclick="cargarComponentes(2,'herramientas',<?php echo $guid_inv ?>)">
                    <div class="titulo-item">
                         <div class="triangulo-item-6"></div>
                        <h3>HERRAMIENTAS</h3>
                    </div>
                </li>
                <li class="item-7">
                    <div class="titulo-item" onclick="cargarComponentes(2,'innovacion',<?php echo $guid_inv ?>)">
                         <div class="triangulo-item-7"></div>
                        <h3>INNOVACION</h3>
                    </div>
                </li> 


            </ul>
        </div>
    </div>
</div>
<div class="footer-etapa-2">

</div>

<script>

function verBitacoras2(guid){
    
     elgg.get('ajax/view/etapa/etapa2', {
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
   
    elgg.get('ajax/view/etapa/bitacoras_etapa2', {
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
