<?php

class Prov{
	
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
	
	

	
	public function list_prov(){
		
		
		$query = "SELECT * FROM proveedor ORDER BY codigo ASC";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function single_prov($codProd){
		
	
		$query = "SELECT * FROM proveedor WHERE proveedor.codigo = '".$codProd."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_prov(){
		
	
		$query = "INSERT INTO proveedor VALUES('".$_POST["codigo"]."', '".$_POST["nombre"]."', 
			'".$_POST["contacto"]."', '".$_POST["telefono"]."', '".$_POST["celular"]."', '".$_POST["email"]."')";
		$this->objDb->insert($query);
									
	}
	
	public function modify_prov(){
		
		
		$query = "UPDATE proveedor SET codigo = '".$_POST["codigo"]."', nombre = '".$_POST["nombre"]."', 
			contacto = '".$_POST["contacto"]."', telefono = '".$_POST["telefono"]."', celular = '".$_POST["celular"]."', email = '".$_POST["email"]."' WHERE codigo = '".$_POST["codProd"]."' ";
		$this->objDb->update($query);
		
										
	}
	
	public function delete_prov(){
		
		$query = "DELETE FROM proveedor WHERE codigo = '".$_GET["codProd"]."' ";
		$this->objDb->delete($query);
		
	}
	
	public function busqueda_prov($busqueda){
		
		
		$query = "SELECT * FROM proveedor WHERE nombre = '".$busqueda."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function busqueda_proov($busqueda){
		
		
		$query = "SELECT * FROM proveedor WHERE nombre LIKE '".$busqueda."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
}

?>