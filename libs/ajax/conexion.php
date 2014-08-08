<?php  

  $servidor = "localhost";
  $usuario = "root";
  $senha="";
  $db = "livianos";
  
  mysql_connect($servidor,$usuario,$senha) OR DIE ("error conexion; ". mysql_error());
  mysql_select_db($db) OR DIE ("error datos; ". mysql_error());
  mysql_set_charset('utf8');
  ini_set('default_charset','UTF-8')
 
?>  