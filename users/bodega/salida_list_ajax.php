<?php

require'../class/sessions.php';
$objses = new Sessions();
$objses->init();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
	header('Location: ../index.php?error=2');
}

?>
<?php
//Llamado de los archivos clase
require'../class/config.php';
require'../class/users.php';
require'../class/dbactions.php';
require'../class/salidas.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objMa = new Salida();
$objNo = new Salida();
$objUse = new Users();
if(isset($_POST['msg'])){
  $busqueda= "%".$_POST['msg']."%";
}
if($busqueda=="% %"){
 $busqueda =="%%";
}
$list_salida = $objMa->list_salida();
$busqueda_sal = $objNo->busqueda_sal($busqueda);
$img_users = $objUse->img_users();

?>
<?php
if($busqueda!="%%"){
	$numrows = mysql_num_rows($busqueda_sal);
	$arreglo = Array();
	if($numrows > 0){
		while($row=mysql_fetch_array($busqueda_sal)){
	               $arreglo[] = $row["orden"]; 
        	 }    
         echo json_encode($arreglo);
	}     
	
}	    
?>