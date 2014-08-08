<?php

class Obra{
	
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
	
	

	
	public function list_obra(){
		
		
		$query = "SELECT * FROM obra ORDER BY codigo ASC";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function single_obra($codProd){
		
	
		$query = "SELECT * FROM obra WHERE obra.codigo = '".$codProd."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_obra(){
		
	
		$query = "INSERT INTO obra VALUES('".$_POST["codigo"]."', '".$_POST["nombre"]."', 
			'".$_POST["responsable"]."', '".$_POST["telefono"]."', '".$_POST["celular"]."')";
		$this->objDb->insert($query);
									
	}
	
	public function modify_obra(){
		
		
		$query = "UPDATE obra SET codigo = '".$_POST["codigo"]."', nombre = '".$_POST["nombre"]."', 
			responsable = '".$_POST["responsable"]."', telefono = '".$_POST["telefono"]."', celular = '".$_POST["celular"]."' WHERE codigo = '".$_POST["codProd"]."' ";
		$this->objDb->update($query);
		
										
	}
	
	public function delete_obra(){
		
		$query = "DELETE FROM obra WHERE codigo = '".$_GET["codProd"]."' ";
		$this->objDb->delete($query);
		
	}
	
	public function busqueda_obra($busqueda){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM obra WHERE nombre LIKE '".$busqueda."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
}

?>