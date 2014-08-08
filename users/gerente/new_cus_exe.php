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
require'../class/customer.php';


//$ruta="../user/img";
//$archivo=$_FILES['imagen']['tmp_name'];
//$nombreArchivo=$_FILES['imagen']['name'];
//move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
//$ruta=$ruta."/".$nombreArchivo;
//echo "<br><img src='$ruta'>";
//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

$objCus = new Customer();

$objCus->new_customer();

header('Location: customer_list.php');

?>