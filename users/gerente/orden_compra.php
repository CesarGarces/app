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
require'../class/warehouse.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

$objWa = new Warehouse();


$codProd = $_GET['codProd'];

//Obtenemos el usuario a modificar
$single_prod = $objWa->single_prod($codProd);


//buscar perfiles asignados
$objDb = new Database();

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Modulo de Productos!!</title>
    </head>
    
    <body>
    
    	<?php echo "Bienvenido, " . $_SESSION['user'];?>
        
        <?php require'../global/menu.php';?>
        
    <form name="modProd" action="modify_prod_exe.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="codProd" value="<?php echo $codProd;?>" />
        <table align="center" border="1">
        <thead>
            	
                <tr>
                  <th colspan="11" align="center">Orden de Compra!!!</th></tr>
                <tr>
                  <td>Codigo Orden</td>
                  <td>Codigo Obra</td>
                  <td>Codigo producto</td>
                  <td>Cantidad</td>
                 
                
            </thead>
        
        	<tbody>
            	
                 <?php
                
				$num_rows = mysql_num_rows($single_prod);
				
				if($num_rows > 0){
					
					if($row=mysql_fetch_array($single_prod)){ ?>
						
						<tr>
                            <td><input type="text" name="codigo" /></td>
                            <td><input type="text" name="nombre" /></td>
                            <td><input type="text" name="nombre" /></td>
                            <td><input type="text" name="cantidad" /></td>
                           
                            
                            
                            
                            <tr><td colspan="8" align="center"><input type="submit" name="send" id="send" value="SEND" /></td></tr>
                        </tr>
                        
						<?php
					}
					
				}
				
				?>
            	
            </tbody>
        
        </table>
        </form>
    </body>
</html>