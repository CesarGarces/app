<?php

class Material{
	
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
	
	

	
	public function list_material(){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM material ORDER BY codigo ASC";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function single_material($id){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM material WHERE id = '".$id."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function single_material_cod($codigo){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM material WHERE codigo = '".$codigo."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	
	public function new_material(){
		
$ruta="../bodega/img/mat";
$archivo=$_FILES['imagen']['tmp_name'];
$nombreArchivo=$_FILES['imagen']['name'];
move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
$ruta=$ruta."/".$nombreArchivo;

		
		$query = "INSERT INTO material VALUES('','".$_POST["codigo"]."', '".$_POST["descripcion"]."', 
			'".$_POST["unidad"]."', '".$_POST["precio_unidad"]."', '".$_POST["proov"]."', '".$_POST["cod_proov"]."', '".$_POST["fecha_costo"]."', '".$ruta."')";
		$this->objDb->insert($query);
									
	}
	
	public function modify_material(){
$ruta="../bodega/img/mat";
$archivo=$_FILES['imagen']['tmp_name'];
$nombreArchivo=$_FILES['imagen']['name'];
move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
$ruta=$ruta."/".$nombreArchivo;		
		
		$query = "UPDATE material SET  codigo = '".$_POST["codigo"]."', descripcion = '".$_POST["descripcion"]."', 
			unidad = '".$_POST["unidad"]."', precio_unidad = '".$_POST["precio_unidad"]."', proov = '".$_POST["proov"]."', cod_proov = '".$_POST["cod_proov"]."', fecha_costo = '".$_POST["fecha_costo"]."' WHERE id = '".$_POST["id"]."' ";
		$this->objDb->update($query);
		
										
	}
	
	public function delete_material(){
		
		$query = "DELETE FROM material WHERE id = '".$_GET["id"]."' ";
		$this->objDb->delete($query);
		
	}
	
	public function price_material($codProd){
				
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT precio_unidad FROM material WHERE codigo = '".$codProd."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function busqueda_material($busqueda){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM material WHERE descripcion LIKE '".$busqueda."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
}

?>