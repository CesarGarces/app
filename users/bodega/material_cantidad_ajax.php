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
require'../class/warehouse.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objMa = new Warehouse();
$objNo = new Warehouse();
$objUse = new Users();
if(isset($_POST['msv'])){
  $busqueda= "%".$_POST['msv']."%";
  //$busqueda= "%".$_REQUEST['msg']."%";
}
if($busqueda==" "){
 $busqueda =="";
}
$list_bodega = $objMa->list_bodega();
$busqueda_bodega = $objNo->busqueda_bodega($busqueda);
$img_users = $objUse->img_users();

?>
<?php
if($busqueda!=""){
	$numrows = mysql_num_rows($busqueda_bodega);
	$arreglo = Array();
	if($numrows > 0){
		$row = mysql_fetch_array($busqueda_bodega);
		    $arreglo = $row['cantidad'];
        	 }    
         echo json_encode($arreglo);
}     
	
	    
?>