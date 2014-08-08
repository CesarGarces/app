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
require'../class/roles.php';
require'../class/dbactions.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objRol = new Roles();
$list_roles = $objRol->show_roles();

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Administrar Roles!!</title>
    <link href="../../libs/css/bootstrap.min.css" rel="stylesheet">
    </head>
    
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation"><!--barra superior-->
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img src="../global/img/livianos.jpg"  width="212" height="59">
        </div>
        
        <div class="navbar-collapse collapse">
          <span class="navbar-form navbar-right">
          
          </span>
          
            <div class="form-group">
              <h3>
                <p class="text-right"><?php
			  
        	
				$numrows = mysql_num_rows($img_users);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($img_users)){?>
                    <img src = "<?php echo $row["imagen"];?>" class="img-circle" width="45" height="30">
					<?php }
				}
			   echo "Bienvenido, " . $_SESSION['user'];
			   			   			   			   
			   ?></p></h3>
            </div>
            <div class="form-group">
              
            </div>
         
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <div class="jumbotron">
    <div class="container">
        <p><?php require'../global/menu.php';?></p>
      </div>
        
        <table align="center" border="1">
        	
            <thead>
            	<tr><td colspan="9" align="center"><a href="new_role.php">Nuevo Rol</a></td></tr>
                <tr><th colspan="9" align="center">Listado de Roles!!!</th></tr>
                <tr>
                	<td>ID</td>
                	<td>Código</td>
                    <td>Nombre del Role</td>
                    <td>Modulo</td>
                    <td>Descripción</td>
                    <td>Creado el</td>
                    <td>Estado</td>
                    <td colspan="2" align="center">Acciones</td></tr>
                
            </thead>
            <tbody>
            
            	<?php
        	
				$numrows = mysql_num_rows($list_roles);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($list_roles)){?>
                    
                    	<tr>
                        	<td><?php echo $row["idRole"];?></td>
                            <td><?php echo $row["codeRole"];?></td>
                            <td><?php echo $row["nameRole"]; ?></td>
                            <td><?php echo $row["nameModule"]; ?></td>                            
                            <td><?php echo $row["descRole"]; ?></td>
                            <td><?php echo $row["dateRole"]; ?></td>
                            <td><?php echo $row["statRole"]; ?></td>
                            <td><a href="modify_role.php?idrole=<?php echo $row["idRole"];?>">Modificar</a></td>
							<td><a href="delete_role.php?idrole=<?php echo $row["idRole"];?>">Eliminar</a></td>
                        </tr>
                        
						<?php
					}
					
				}
			
				?>
            
            </tbody>
        
        </table>
        
    </body>
</html>