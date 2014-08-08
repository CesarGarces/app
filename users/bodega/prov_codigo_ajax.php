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
require'../class/prov.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objMa = new Prov();
$objNo = new Prov();
$objUse = new Users();
if(isset($_POST['msg'])){
  $busqueda= "%".$_POST['msg']."%";
  //$busqueda= "%".$_REQUEST['msg']."%";
}
if($busqueda==" "){
 $busqueda =="";
}
$list_prov = $objMa->list_prov();
$busqueda_prov = $objNo->busqueda_proov($busqueda);
$img_users = $objUse->img_users();

?>
<?php
if($busqueda!=""){
	$numrows = mysql_num_rows($busqueda_prov);
	$arreglo = Array();
	if($numrows > 0){
		$row = mysql_fetch_array($busqueda_prov);
		    $arreglo = $row['codigo'];
        	 }    
         echo json_encode($arreglo);
}     
	
	    
?>