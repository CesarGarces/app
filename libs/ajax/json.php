<?php  

  $data=$_GET['term'];
  $bd = new mysqli("localhost", "root", "", "livianos");  
  if(mysqli_connect_errno()) return;  
  
  $descripcion = array();  
  if($res = $bd->query("SELECT * FROM material WHERE descripcion REGEXP '$data'"))  
    while($material = $res->fetch_assoc()){
       $descripcion[] = array(  
        'value' => $material['descripcion'],  
        'label' => $material['descripcion']);  
    }  
      
  $bd->close();  
  echo json_encode($descripcion);  
 
?>  