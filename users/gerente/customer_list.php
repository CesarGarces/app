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
require'../class/customer.php';
require'../class/dbactions.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los Clientes!!
$objCus = new Customer();
$objUse = new Users();
$list_customer = $objCus->list_customer();
$img_users = $objUse->img_users();

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Modulo de Clientes!!</title>
        <!--diseño-->
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
        
        <div class="container">
       <div class="table-responsive"> 
        <table align="center" class="table table-striped" border="1">
        	
            <thead>
            	<tr>
            	  <td colspan="7" align="center"><a href="new_customer.php">Nuevo Cliente</a></td></tr>
                <tr>
                  <th colspan="7" align="center">Listado de Clientes!!!</th></tr>
                <tr>
                  <td>Nombre de Cliente</td>
                  <td>cedula o nit</td>
                  <td>Direccion</td>
                  <td>Telefono contacto</td>
                  <td colspan="2" align="center">Acciones</td>
                  
                  
                  </tr>
                
            </thead>
            <tbody>
            
            	<?php
        	
				$numrows = mysql_num_rows($list_customer);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($list_customer)){?>
                    
                    	<tr>
                           
                        	<td><?php echo $row["nombreCust"];?></td>
                            <td><?php echo $row["cedNit"]; ?></td
                            ><td><?php echo $row["direccion"]; ?></td>
                            <td><?php echo $row["Tel"]; ?></td>
                           
                            <td><a href="modify_cus.php?idCust=<?php echo $row["idCustomer"];?>">Modificar</a></td>
							<td><a href="delete_cus.php?idCust=<?php echo $row["idCustomer"];?>">Eliminar</a></td>
                            </tr>
                        
						<?php
					}
					
				}
			
				?>
            
            </tbody>
        
        </table>
        </div>
        </div>
        </div>
        <footer>
        <p>&copy; Cesar Garces 2014</p>
      </footer>
         <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../libs/js/bootstrap.min.js"></script>
    </body>
</html>