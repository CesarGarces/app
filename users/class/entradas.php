<?php

class Entrada{
	
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
	
	

	
	public function list_entrada(){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM entrada ORDER BY codentr ASC";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
		
		
	}
	
	public function single_prod($codProd){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM bodega WHERE codigo = '".$codProd."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_ent(){

		
		$query = "INSERT INTO entrada VALUES('', '".$_POST["prov"]."', '".$_POST["codprov"]."', 
			'".$_POST["obra"]."', '".$_POST["codobra"]."', '".$_POST["fact"]."', '".$_POST["fecha"]."', '".$_POST["codigom"]."', '".$_POST["descrip"]."', '".$_POST["unidad"]."', '".$_POST["valor"]."', '".$_POST["cantidad"]."','".$_POST["total"]."','".$_POST["tipo_entrada"]."')";
		$this->objDb->insert($query);
									
	}
	
	public function sumar(){
			
		$query = "UPDATE bodega SET cantidad = cantidad  + '".$_POST["cantidad"]."' WHERE codigo = '".$_POST['codigom']."' ";
		$this->objDb->update($query);
		
										
	}
	
	public function delete_ent(){
		
		$query = "DELETE FROM entrada WHERE codentr = '".$_GET["codentr"]."' ";
		$this->objDb->delete($query);
		
	}
	
	public function price_prod(){
				
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT valor FROM bodega WHERE codigo = '".$codProd."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	
	}
	
	public function busqueda_ent($busqueda){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM entrada WHERE entrada.nfac = '".$busqueda."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function suma_ent($busqueda){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT SUM(total) FROM entrada WHERE nfac = '".$busqueda."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function single_fac($busqueda){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT codentr, prov, codprov, obra, codobra, fecha FROM entrada WHERE nfac = '".$busqueda."' group by codprov";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function list_entrada_devolucion($insumo, $obra){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM entrada WHERE entrada.descrip = '$insumo' AND entrada.obra = '$obra' AND tipo_entrada = 1";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
		
		
	}
	//estas son funciones para las consultas
	public function list_entrada_devolucion_obra($codigo_obra){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM entrada WHERE `codobra`= $codigo_obra AND `tipo_entrada` = 1 ";
		$this->result = $this->objDb->select($query);
		return $this->result;	
		
	}
}

?>