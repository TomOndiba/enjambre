<style>
    #lista-redes{
        border-color: #e5e5e5;
        border-width: 1px;
        border-style: solid;
        max-height: 200px;
        overflow-y: auto;
    }

    #lista-redes ul li{
        border-bottom: #e5e5e5 solid 1px;
        padding:8px;
    }
    
    #lista-redes ul li:hover{
        background-color: #ebebeb;
        cursor: pointer;
        font-weight: 700 !important;
    }
    #lista-redes ul li img{
        width: 50px;
        height: 50px;
    }
    #lista-redes ul li span{
        vertical-align: top;
        line-height: 50px;
    }

</style>
<h2 class="titulo-reportes title-legend">Reportes Redes Tematicas</h2>
<br><label>Seleccione las Red tematica</label>
<input type="text" onkeypress="if (event.keyCode == 13) {
            buscarRed(this)
        }
        ;
        return true;"/>
<div id="lista-redes">

</div>
<div id="result">

</div>
<script>
    $(document).ready(function() {
        $("#lista-redes").hide();
    })

    function buscarRed(element) {
        $("#lista-redes").show();
        var nombre = $(element).val();
        elgg.get('ajax/view/reporte/redes_tematicas/consultar_redes', {
            timeout: 30000,
            data: {
                nombre: nombre,
            },
            success: function(result, success, xhr) {
                $("#lista-redes").html(result);
            },
        });
    }

    function cargarRed(red) {
         $("#lista-redes").hide();
         //alert(red);
         
         elgg.get('ajax/view/reporte/redes_tematicas/reporte_usuarios_red', {
            timeout: 30000,
            data: {
                red: red
            },
            success: function(result, success, xhr) {
                $("#result").html(result);
            },
        });
    }



</script>
