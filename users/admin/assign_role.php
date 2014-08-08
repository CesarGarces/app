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
require'../class/profiles.php';
require'../class/modules.php';
require'../class/dbactions.php';
require'../class/roles.php';
require'../class/users.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

$objUser = new Users();

//obtenemos los perfiles del usuario seleccionado
$user = $objUser->single_user($_GET["idUser"]);
$profiles = $objUser->look_user_profiles();

if($rowU=mysql_fetch_array($user)){
	$username = $rowU["loginUsers"];
}

$objrol = new Roles();
$objdat = new Database();

$result = $objrol->show_roles();

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Asignar Roles al Usuario Seleccionado!!</title>
    </head>
    
    <body>
    
    	<?php echo "Bienvenido, " . $_SESSION['user'];?>
        
        <?php require'../global/menu.php';?>
        <form name="assigmod" action="assign_role_exe.php" method="post">
        <input type="hidden" name="idUser" value="<?php echo $_GET["idUser"];?>" />
        <table align="center" border="1">
        	<tbody>
            	<tr><td colspan="3">Asignación de Roles a: <?php echo $username;?></td></tr>
				<?php $numrows = mysql_num_rows($profiles);
				
				if($numrows > 0){
					$counter = 1;
					while($rowpro=mysql_fetch_array($profiles)){
						$query = "SELECT * FROM role_user WHERE idRole = '".$rowpro["idRole"]."' 
							AND idUsers = '".$_GET["idUser"]."' ";
						$get_info = $objdat->select($query);
						if($rowR=mysql_fetch_array($get_info)){
							$assig = $rowR["idRole"];
						}else{
							$assig = 'false';
						}
						?>
						<tr>
                        	<td><?php echo $rowpro["nameRole"];?></td>
                            <td><?php echo $rowpro["nameModule"];?></td>
                            <td><?php
                            if($assig==$rowpro["idRole"]){?>
								<input type="checkbox" name="role<?php echo $counter;?>" value="<?php echo $rowpro["idRole"];?>" checked />
							<?php
							}else{?>
								<input type="checkbox" name="role<?php echo $counter;?>" value="<?php echo $rowpro["idRole"];?>" />
							<?php
							}
							?>
                            </td>
                        </tr>
						<?php
						$counter = $counter + 1;
					}
				}
                ?>
                <tr><td colspan="3" align="center"><input type="submit" name="send" id="send" value="SEND" /></td></tr>
          </tbody>
        
        </table>
        </form>
    
    </body>
</html>