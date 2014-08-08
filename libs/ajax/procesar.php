<?php  

 include("conexion.php");
  
  $seleciona_dados = mysql_query("SELECT * FROM material WHERE descripcion = '" .$_GET['cli_codigo']. "'");
  $lin_dado_cli = mysql_fetch_array($seleciona_dados);
  
  
  echo '
  <label>codigo;</label> <input type="text" value="'.$lin_dado_cli['codigo'].'" name="cod" />
  <label>descripcion;</label> <input type="text" value="'.$lin_dado_cli['descripcion'].'" name="des" />
  <label>un;</label> <input type="text" value="'.$lin_dado_cli['unidad'].'" name="unidad" />
  <label>precio;</label> <input type="text" value="'.$lin_dado_cli['precio_unidad'].'" name="precio" />
  
  ';
 
?>  