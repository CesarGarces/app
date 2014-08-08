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


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

$objPro = new Profiles();

$objPro->modify_profile();

header('Location: profile_list.php');

?>