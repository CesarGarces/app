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
require'../class/warehouse.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objWa = new Warehouse();
$objUse = new Users();
$list_bodega = $objWa->list_bodega();
$img_users = $objUse->img_users();

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Modulo de Productos!!</title>
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
            	  <td colspan="11" align="center"><a href="new_product.php">Nuevo Producto</a></td></tr>
                <tr>
                  <th colspan="11" align="center">Listado de Productos!!!</th></tr>
                <tr>
                  <td>Imagen</td>
                  <td>Codigo</td>
                  <td>descripcion</td>
                  <td>Unidad</td>
                  <td>Cantidad</td>
                  <td colspan="2" align="center">Acciones</td></tr>
                
            </thead>
            <tbody>
            
            	<?php
        	
				$numrows = mysql_num_rows($list_bodega);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($list_bodega)){?>
                    
                    	<tr>
                            <td><img src= "<?php echo $row["imagen"];?>" class="img-rounded" width="75" height="50"></td>
                        	<td><?php echo $row["codigo"];?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["unidad"];?></td>
                            <?php
							if ($row["cantidad"] <= 10){
							?>
							<td class="danger"><?php echo $row["cantidad"];?></td>
                            <?php
							}else{
							?>
							<td><?php
							 echo $row["cantidad"];?></td>
                             <?php
							}
							?>
                            
                            
                            <td width="59"><a href="modify_prod.php?codProd=<?php echo $row["codigo"];?>">Modificar</a></td>
							<td><a href="delete_prod.php?codProd=<?php echo $row["codigo"];?>">Eliminar</a></td>
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
        </div>
        <footer>
        <p>&copy; Cesar Garces 2014</p>
      </footer>
        <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../libs/js/bootstrap.min.js"></script>
    </body>
</html>