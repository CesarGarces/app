<?php

//Inicio del menu!!
echo '<ul class="nav nav-tabs">';

//La opcion Inicio va estar presente en todos los perfiles!!!
echo '<li><a href="index.php">Inicio</a></li>';
?>
<?php
//Verificamos el perfil para determinar que partes del menu podrá ver
if($_SESSION['idprofile']==3){
	echo '
	    <li><a href="user_list.php">Usuarios</a></li>
		<li><a href="profile_list.php">Perfiles</a></li>';
}
?>
<?php
//El logout va a estar presente en todos los perfiles!!!
echo '<li><a href="log_out.php">Salir</a></li>';
//fin del menu
echo '</ul>';

?>
