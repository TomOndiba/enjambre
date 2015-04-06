
   
<style>


/* content */

	#container{	
		margin:0 auto;
		width:818px;
		text-align:left;
		position:relative;
		padding:2em 0;
		}
		
	ul#items{		
		margin:1em 0;
		width:auto;
		height:350px;
		overflow:hidden;
		}
	ul#items li{
		list-style:none;
		float:left;
		height:340px;
		overflow:hidden;
		margin:0 4px;
		background:#DBDAE0;
		color:#fff;
		text-align:center;
		-moz-border-radius:5px;
		-webkit-border-radius:5px;
		border-radius:5px;
		-moz-box-shadow:0 1px 1px #777;
		-webkit-box-shadow:0 1px 1px #777;
		box-shadow:0 1px 1px #777;
		color:#555;
		}
	ul#items li:hover{color:#333;}
	ul#items li .image{
		margin:20px 20px 10px 20px;
		width:220px;
		height:250px;
		overflow:hidden;
		
		}	
	ul#items h3{text-transform:uppercase;font-size:14px;font-weight:bold;margin:.25em 0;text-shadow:#f1f1f1 0 1px 0;}	
	ul#items .info{color:#999;text-shadow:#f1f1f1 0 1px 0;}	
	ol#pagination{position:relative;text-align:center;}
	ol#pagination li{
		display:inline-block;
		width:16px;
		height:16px;
		background:url('http://www.enjambre.gov.co/imagenes/contenidos/bg_buttons.png') no-repeat 0 0;
		text-align:left;
		text-indent:-8000px;
		list-style:none;
		cursor:pointer;
		margin:0 2px;
		}
	ol#pagination li:hover{background:url('http://www.enjambre.gov.co/imagenes/contenidos/bg_buttons.png') no-repeat 0 -16px;}
	ol#pagination li.current{color:#f00;font-weight:bold;background:url('http://www.enjambre.gov.co/imagenes/contenidos/bg_buttons.png') no-repeat 0 -32px;}
	ol#pagination li.prev, ol#pagination li.next{
		position:absolute;
		top:-150px;
		}
	ol#pagination li.prev{left:-30px;background:url('http://www.enjambre.gov.co/imagenes/contenidos/bg_buttons.png') no-repeat 0 -64px;}
	ol#pagination li.next{right:-30px;background:url('http://www.enjambre.gov.co/imagenes/contenidos/bg_buttons.png') no-repeat 0 -48px;}
	
/* // content */

</style>
    


<div id="container">

<ul id="items">
    <li>
    	<p class="image"><a href="http://www.enjambre.gov.co/cartillas/Cartilla%20Rol%20Maestro%20-%20General/"><img src="http://www.enjambre.gov.co/imagenes/contenidos/cartillas/maestro.jpg" alt="Cartilla - Rol Maestro" style="height:250px"/></a></p>
    	<h3>Cartilla No. 1</h3>
    	<p class="info">Rol Maestro</p>
    </li>
    
    <li>
    	<p class="image"><a href="http://www.enjambre.gov.co/cartillas/Cartilla%20Rol%20Estudiante%20-%20General/"><img src="http://www.enjambre.gov.co/imagenes/contenidos/cartillas/estudiante.jpg" alt="Cartilla - Rol Estudiante" style="height:250px" /></a></p>
    	<h3>Cartilla No. 2</h3>
    	<p class="info">Rol Estudiante</p>
    </li>
    
    <li>
    	<p class="image"><a href="http://www.enjambre.gov.co/cartillas/Cartilla%20Rol%20Rector/"><img src="http://www.enjambre.gov.co/imagenes/contenidos/cartillas/rector.jpg" alt="Cartilla - Rol Rector" style="height:250px" /></a></p>
    	<h3>Cartilla No. 3</h3>
    	<p class="info">Rol Rector</p>
    </li>
    
    <li>
    	<p class="image"><a href="http://www.enjambre.gov.co/cartillas/Cartilla%20Rol%20Cordinador%20-%20General/"><img src="http://www.enjambre.gov.co/imagenes/contenidos/cartillas/coordinador-general.jpg" alt="Cartilla - Rol Coordinador General" style="height:250px" /></a></p>
    	<h3>TCartilla No. 4</h3>
    	<p class="info">Rol Coordinador General</p>
    </li>
    
    <li>
    	<p class="image"><a href="http://www.enjambre.gov.co/cartillas/Cartilla%20Rol%20Cordinador%20-%20Reportes/"><img src="http://www.enjambre.gov.co/imagenes/contenidos/cartillas/coordinador-reportes.jpg" alt="Cartilla - Rol Coordinador Reportes" style="height:250px" /></a></p>
    	<h3>Cartilla No. 5</h3>
    	<p class="info">Rol Coordinador Reportes</p>
    </li>
    
    <li>
    	<p class="image"><a href="http://www.enjambre.gov.co/cartillas/Cartilla%20Rol%20Cordinador%20-%20Convocatorias/"><img src="http://www.enjambre.gov.co/imagenes/contenidos/cartillas/coordinador-convocatorias.jpg" alt="Cartilla - Rol Coordinador Convocatorias" style="height:250px" /></a></p>
    	<h3>Cartilla No. 6</h3>
    	<p class="info">Rol Coordinador Convocatorias</p>
    </li>
    
    <li>
    	<p class="image"><a href="http://www.enjambre.gov.co/cartillas/Cartilla%20Rol%20Cordinador%20-%20Ferias/"><img src="http://www.enjambre.gov.co/imagenes/contenidos/cartillas/coordinador-ferias.jpg" alt="Cartilla - Rol Coordinador Ferias" style="height:250px"  /></a></p>
    	<h3>Cartilla No. 7</h3>
    	<p class="info">Rol Coordinador Ferias</p>
    </li>

    

</ul>

</div>

	<script type="text/javascript">
	
$(document).ready(function(){
	$('ul#items').easyPaginate({
		step:2, 
		auto:false, 
		loop:true,
		clickstop:false,
		pause:2000
	});
	
});    
    
    </script>


