<?php
class Conexion{
	
	var $conect;
	var $BaseDatos;
	var $Servidor;
	var $Usuario;
	var $Clave;
	
	function Conexion(){
		$this->BaseDatos = "enjambre";
		$this->Servidor = "bd.enjambre.co";
		$this->Usuario = "root";
		$this->Clave = "elgg2014";
	 }

	 function conectar() {
		if(!($con=@mysql_connect($this->Servidor,$this->Usuario,$this->Clave))){
			echo"<h1> [:(] Error al conectar a la base de datos</h1>";
			exit();
		}
		if (!@mysql_select_db($this->BaseDatos,$con)){
			echo "<h1> [:(] Error al seleccionar la base de datos</h1>";
			exit();
		}
		$this->conect=$con;
		return true;
	}
}

?>