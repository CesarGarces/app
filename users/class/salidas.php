<?php

class Salida{
	
	//atributos
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	

	
	public function list_salida(){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM salida ORDER BY id ASC";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
		
		
	}
	
	public function single_prod($codProd){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM bodega WHERE codigo = '".$codProd."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_sal(){

		
		$query = "INSERT INTO salida VALUES('','".$_POST["orden"]."', '".$_POST["obra"]."', '".$_POST["codobra"]."', '".$_POST["despacho"]."', '".$_POST["fecha"]."', '".$_POST["codigom"]."', '".$_POST["desc"]."','".$_POST["unidad"]."', '".$_POST["valor"]."', '".$_POST["cantidad"]."', '".$_POST["compra"]."', '".$_POST["total"]."')";
		$this->objDb->insert($query);
									
	}
	public function new_sal2(){

		foreach ($_POST as $key => $value) {
		$query = "INSERT INTO salida (id, orden, obra, codobra, despacho, fecha, codmat, descripcion, unidad, valor, cantmat, compra, total) VALUES (NULL, '{$value}');";
		$this->objDb->insert($query);
		}
									
	}
	
	public function resta(){
			
		$query = "UPDATE bodega SET cantidad = cantidad  - '".$_POST["cantidad"]."' WHERE codigo = '".$_POST['codigom']."' ";
		$this->objDb->update($query);
		
										
	}
	
	public function delete_sal(){
		
		$query = "DELETE FROM salida WHERE orden = '".$_GET["orden"]."' ";
		$this->objDb->delete($query);
		
	}
	
	public function price_prod(){
				
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT valor FROM bodega WHERE codigo = '".$codProd."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	
	}
	
	public function busqueda_sal($busqueda){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM salida WHERE orden LIKE '".$busqueda."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function suma_sal($busqueda){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT SUM(total) FROM salida WHERE orden = '".$busqueda."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function single_fac($busqueda){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT obra, codobra, despacho, fecha FROM salida WHERE orden = '".$busqueda."' group by orden";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	//estas son funciones para las consultas
	public function list_salidas_obra($codigo_obra){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM salida WHERE `codobra`= $codigo_obra ";
		$this->result = $this->objDb->select($query);
		return $this->result;	
		
	}
	public function list_salidas_obra_material($codigo_obra, $codigo_material){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM salida WHERE `codobra`= $codigo_obra AND `codmat`= $codigo_material ";
		$this->result = $this->objDb->select($query);
		return $this->result;	
		
	}
	public function list_salidas_obra_material_fecha($codigo_obra, $inicio, $fin, $codigo_material){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM salida WHERE `codobra`= $codigo_obra AND `codmat`= $codigo_material AND fecha BETWEEN  '$inicio' AND  '$fin' ORDER BY fecha ASC";
		$this->result = $this->objDb->select($query);
		return $this->result;	
		
	}
	public function list_salida_consecutivo($ini, $fin){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM salida WHERE orden BETWEEN $ini AND $fin ORDER BY orden ASC";
		$this->result = $this->objDb->select($query);
		return $this->result;	
		
	}
	public function list_salida_fecha($busqueda, $ini, $fin){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM salida WHERE obra = '$busqueda' AND fecha BETWEEN '$ini' AND '$fin' ORDER BY id ASC";
		
		$this->result = $this->objDb->select($query);
		return $this->result;	
		
	}
	public function list_salida_ultimo(){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT salida.orden FROM salida ORDER BY orden DESC LIMIT 1";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
		
		
	}
	
}

?>