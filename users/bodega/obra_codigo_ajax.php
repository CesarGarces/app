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
require'../class/obra.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objMa = new Obra();
$objNo = new Obra();
$objUse = new Users();
if(isset($_POST['msg'])){
  $busqueda= "%".$_POST['msg']."%";
  //$busqueda= "%".$_REQUEST['msg']."%";
}
if($busqueda==" "){
 $busqueda =="";
}
$list_obra = $objMa->list_obra();
$busqueda_obra = $objNo->busqueda_obra($busqueda);
$img_users = $objUse->img_users();

?>
<?php
if($busqueda!=""){
	$numrows = mysql_num_rows($busqueda_obra);
	$arreglo = Array();
	if($numrows > 0){
		$row = mysql_fetch_array($busqueda_obra);
		    $arreglo = $row['codigo'];
        	 }    
         echo json_encode($arreglo);
}     
	
	    
?>