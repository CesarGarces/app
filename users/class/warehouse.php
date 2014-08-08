<?php

class Warehouse{
	
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
	
	

	
	public function list_bodega(){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM bodega ORDER BY codigo ASC";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function single_prod($codProd){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM bodega WHERE bodega.codigo = '".$codProd."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_prod(){
		
$ruta="../bodega/img";
$archivo=$_FILES['imagen']['tmp_name'];
$nombreArchivo=$_FILES['imagen']['name'];
move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
$ruta=$ruta."/".$nombreArchivo;

		
		$query = "INSERT INTO bodega VALUES('".$_POST["codigo"]."', '".$_POST["nombre"]."', 
			'".$_POST["unidad"]."', '".$_POST["tipo"]."', '".$_POST["especificacion_1"]."', '".$_POST["especificacion_2"]."', '".$_POST["cantidad"]."', '".$_POST["valor"]."', '".$ruta."', '".$_POST["minimo"]."')";
		$this->objDb->insert($query);
									
	}
	
	public function modify_prod(){
$ruta="../bodega/img";
$archivo=$_FILES['imagen']['tmp_name'];
$nombreArchivo=$_FILES['imagen']['name'];
move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
$ruta=$ruta."/".$nombreArchivo;		
		
		$query = "UPDATE bodega SET cantidad = '".$_POST["cantidad"]."', minimo = '".$_POST["minimo"]."' WHERE codigo = '".$_POST["codProd"]."' ";
		$this->objDb->update($query);
		
										
	}
	
	public function delete_prod(){
		
		$query = "DELETE FROM bodega WHERE codigo = '".$_GET["codProd"]."' ";
		$this->objDb->delete($query);
		
	}
	
	public function price_prod(){
				
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT valor FROM bodega WHERE codigo = '".$codProd."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function busqueda_bodega($busqueda){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM bodega WHERE nombre LIKE '".$busqueda."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
}

?>