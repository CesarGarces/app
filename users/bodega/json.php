 
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
require'../class/profiles.php';

$objCon = new Connection();
$objCon->get_connected();

  $data=$_GET['term'];
  
  
  $descripcion = array();  
  if($res = $objCon->query("SELECT * FROM material WHERE descripcion REGEXP '$data'"))  
    while($material = $res->fetch_assoc()){
       $descripcion[] = array(  
        'value' => $material['descripcion'],  
        'label' => $material['descripcion']);  
    }  
      
  $objCon->close();  
  echo json_encode($descripcion);  
 
?>  