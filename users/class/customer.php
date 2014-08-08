<?php

class Customer{
	
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	
	
	
	public function list_customer(){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM customer 
			ORDER BY customer.nombreCust ASC";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	
		
	
	public function single_customer($idCust){
		
		//realizamos la busqueda del cliente a modificar
		$query = "SELECT * FROM customer WHERE customer.idCustomer = '".$idCust."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_customer(){

		
	$query = "INSERT INTO customer VALUES('', '".$_POST["nombre"]."', '".$_POST["ccnit"]."', 
			'".$_POST["dir"]."', '".$_POST["tel"]."')";
		$this->objDb->insert($query);
			
		
	}
	
	public function modify_customer(){

		$query = "UPDATE customer SET nombreCust = '".$_POST["nombre"]."', cedNit = '". $_POST["cednit"]."',
			direccion = '".$_POST["dir"]."', Tel = '".$_POST["tel"]."'
			WHERE idCustomer = '".$_POST["idCust"]."' ";
		$this->objDb->update($query);			
		
	}
	
	public function delete_customer(){
		
		$query = "DELETE FROM customer WHERE idCustomer = '".$_GET["idCust"]."' ";
		$this->objDb->delete($query);		
		
	}
	
	
}

?>