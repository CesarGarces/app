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
require'../class/obra.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objOb = new Obra();
$objNo = new Obra();
$objUse = new Users();
$busqueda= $_POST['busqueda'];
$list_obra = $objOb->list_obra();
$busqueda_obra = $objNo->busqueda_obra($busqueda);
$img_users = $objUse->img_users();

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Busqueda de Obras</title>
        <link href="../../libs/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../../favicon.ico">
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
    <p></p>
        <ul class="nav nav-tabs">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="material_list.php">Materiales</a></li>
        <li class="active"><a href="obra_list.php">Obras</a></li>
        <li><a href="prov_list.php">Proveedores</a></li>
		<li><a href="bodega_list.php">Inventario en bodega</a></li>
		<li><a href="salida_list.php">Orden de salida</a></li>
        <li><a href="entrada_list.php">Orden de entrada</a></li>
        <li><a href="consultas.php">Consultas</a></li>
        <li><a href="log_out.php">Salir</a></li>
        </ul>
      </div>
        
    <div class="container">
       <div class="table-responsive"> 
        <table align="center" class="table table-striped" border="1">
        	
            <thead>
            	<tr>
            	  <td colspan="11" align="center"><a href="new_obra.php">Nueva Obra</a></td></tr>
                  <form action="obra_busqueda.php" method="post">
                  <tr>
                  <th colspan="15" align="center">Buscar por nombre de obra: 
                    <input type="text" autofocus name="busqueda" />&nbsp;<input type="submit" value="Buscar" /></th></tr></form>
                <tr>
                  <th colspan="11" align="center"></th>
                <tr>        
                  <td>Codigo</td>
                  <td>Nombre</td>
                  <td>Responsable</td>
                  <td>Telefono</td>
                  <td>Celular</td>                
                  <td colspan="2" align="center">Acciones</td></tr>
                
            </thead>
            <tbody>
            
            	<?php
        	
				$numrows = mysql_num_rows($busqueda_obra);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($busqueda_obra)){?>
                    
                    	<tr>
                        	<td><?php echo $row["codigo"];?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["responsable"];?></td>
                            <td><?php echo $row["telefono"];?></td>
                            <td><?php echo $row["celular"];?></td>
                            <td width="59"><a href="modify_obra.php?codProd=<?php echo $row["codigo"];?>">Modificar</a></td>
							<td><a href="delete_obra.php?codProd=<?php echo $row["codigo"];?>">Eliminar</a></td>
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
    <script src="../../libs/js/bootstrap.min.js"></script>
    </body>
</html>