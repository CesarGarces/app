<?php

class Users{
	
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	public function login_in(){

		
		// para el inicio de sesion de los usuarios!!
		$user = mysql_real_escape_string($_POST["usern"]);
		$pass = sha1 ($_POST["passwd"]);
		

		$query = "SELECT * FROM users, profiles WHERE users.loginUsers = '{$user}' 
			AND users.passUsers = '{$pass}' AND users.idprofile = profiles.idProfile ";
		$this->result = $this->objDb->select($query);
		$this->rows = mysql_num_rows($this->result);
		if($this->rows > 0){
			
			if($row=mysql_fetch_array($this->result)){
				
				$this->objSe->init();
				$this->objSe->set('user', $row["loginUsers"]);
				$this->objSe->set('iduser', $row["idUsers"]);
				$this->objSe->set('idprofile', $row["idprofile"]);
				
				$this->useropc = $row["nameProfi"];
				
				switch($this->useropc){
					
					
					case 'Admin':
						header('Location: admin/index.php');
						break;
						
					case 'Gerente':
						header('Location: gerente/index.php');
						break;
						
					case 'Administrador':
						header('Location: administrador/index.php');
						break;
						
					case 'Obras':
						header('Location: obras/index.php');
						break;
						
					case 'Bodega':
						header('Location: bodega/index.php');
						break;
					
				}
				
			}
			
		}else{
			
			header('Location: index.php?error=1');
			
		}
		
	}

	
	public function list_users(){
		
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT * FROM users, profiles WHERE users.idprofile = profiles.idProfile 
			ORDER BY users.idUsers ASC";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function img_users(){
				
		//realizamos la busqueda en la bd de todos lo usuarios registrados
		$query = "SELECT imagen FROM users WHERE loginUsers = '".$_SESSION['user']."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
		
	
	public function single_user($idUser){
		
		//realizamos la busqueda del usuario a modificar
		$query = "SELECT * FROM users, profiles WHERE users.idUsers = '".$idUser."' 
			AND users.idprofile = profiles.idProfile ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_user(){
$ruta="../user/img";
$archivo=$_FILES['imagen']['tmp_name'];
$nombreArchivo=$_FILES['imagen']['name'];
move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
$ruta=$ruta."/".$nombreArchivo;

   $pass = sha1 ($_POST["pass"]);


		
	$query = "INSERT INTO users VALUES('', '".$_POST["login"]."', '{$pass}', 
			'".$_POST["profile"]."', '".$_POST["email"]."', '1', '".$ruta."', '1','admin', '".$_POST["status"]."')";
		$this->objDb->insert($query);
		
		$query = "SELECT * FROM users ORDER BY idUsers DESC Limit 1";
		$result = $this->objDb->select($query);
		if($pro=mysql_fetch_array($result)){
			$idUser = $pro["idUsers"];
		}
		
		$query = "SELECT * FROM profiles";
		$this->result = $this->objDb->select($query);
		while($row=mysql_fetch_array($this->result)){
			$namePro = "pro" . $row["idProfile"];
			if(isset($_POST[$namePro])){
				mysql_query("INSERT INTO user_pro VALUES('', '".$row["idProfile"]."', '".$idUser."')");
			}
		}
		
	}
	
	public function modify_user(){
$ruta="../user/img";
$archivo=$_FILES['imagen']['tmp_name'];
$nombreArchivo=$_FILES['imagen']['name'];
move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
$ruta=$ruta."/".$nombreArchivo;
		
		$pass = sha1 ($_POST["pass"]);

		$query = "UPDATE users SET loginUsers = '".$_POST["login"]."', passUsers = '{$pass}',
			idprofile = '".$_POST["profile"]."', emailUser = '".$_POST["email"]."', statusUsers = '".$_POST["status"]."', imagen = '". $ruta."'
			WHERE idUsers = '".$_POST["idUsers"]."' ";
		$this->objDb->update($query);
		
		$query = "DELETE FROM user_pro WHERE idUsers = '".$_POST["idUsers"]."' ";
		$this->objDb->delete($query);
		
		$query = "SELECT * FROM profiles";
		$this->result = $this->objDb->select($query);
		while($row=mysql_fetch_array($this->result)){
			$namePro = "pro" . $row["idProfile"];
			if(isset($_POST[$namePro])){
				mysql_query("INSERT INTO user_pro VALUES('', '".$row["idProfile"]."', '".$_POST["idUsers"]."')");
			}
		}
		
		
	}
	
	public function delete_user(){
		
		$query = "DELETE FROM users WHERE idUsers = '".$_GET["idUser"]."' ";
		$this->objDb->delete($query);
		$query = "DELETE FROM user_pro WHERE idUsers = '".$_GET["idUser"]."' ";
		$this->objDb->delete($query);
		
	}
	
	public function look_user_profiles(){
		$query = "SELECT * FROM user_pro, mod_profile, roles, modules WHERE user_pro.idUsers = '".$_GET["idUser"]."' 
			AND user_pro.idProfile = mod_profile.idProfile AND mod_profile.idmodule = roles.idmodule 
			AND  roles.idmodule = modules.idmodule ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
}

?>