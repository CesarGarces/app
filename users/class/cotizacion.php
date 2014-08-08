<?php

class Cotizacion{
	
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
	
	

	
	public function list_cot(){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM cotizacion ORDER BY codigo ASC";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function single_cot($codCot){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM cotizacion WHERE cotizacion.codigo = '".$codCot."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_cot(){
		
		$query = "INSERT INTO cotizacion VALUES('', '".$_POST["nombreCliente"]."', '".$_POST["nombreEmpresa"]."', 
			'".$_POST["asunto"]."', '".$_POST["nombreObra"]."', '".$_POST["codigoObra"]."', '".$_POST["producto"]."', '".$_POST["codProd"]."', '".$_POST["descripcion"]."', '".$_POST["unidad"]."', '".$_POST["cantidad"]."', '".$_POST["valor"]."', '".$_POST["total"]."')";
		$this->objDb->insert($query);
									
	}
	
	public function modify_cot(){
		
		
		$query = "UPDATE cotizacion SET codigo = '".$_POST["codigo"]."', nombre = '".$_POST["nombre"]."', 
			unidad = '".$_POST["unidad"]."', tipo = '".$_POST["tipo"]."', especificacion_1 = '".$_POST["especificacion_1"]."', especificacion_1 = '".$_POST["especificacion_1"]."', especificacion_2 = '".$_POST["especificacion_2"]."', cantidad = '".$_POST["cantidad"]."', valor = '".$_POST["valor"]."' WHERE codigo = '".$_POST["codProd"]."' ";
		$this->objDb->update($query);
		
										
	}
	
	public function delete_cot(){
		
		$query = "DELETE FROM cotizacion WHERE codigo = '".$_GET["codCot"]."' ";
		$this->objDb->delete($query);
		
	}
	
}

?>