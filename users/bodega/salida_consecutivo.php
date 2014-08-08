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
require'../class/salidas.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objMa = new Salida();
$objUse = new Users();

$img_users = $objUse->img_users();

            					
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Listado de Salida de Materiales</title>
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
        <li><a href="obra_list.php">Obras</a></li>
        <li><a href="prov_list.php">Proveedores</a></li>
		<li><a href="bodega_list.php">Inventario en bodega</a></li>
		<li><a href="salida_list.php">Orden de salida</a></li>
        <li><a href="entrada_list.php">Orden de entrada</a></li>
        <li class="active"><a href="consultas.php">Consultas</a></li>
        <li><a href="log_out.php">Salir</a></li>
        </ul>
      </div>
        
    <div class="container">
       <div class="table-responsive"> 
        <table align="center" class="table table-striped" border="1">
        	
            <thead>
            	
                <tr>
                  <th colspan="11" align="center">Listado de Salida de Materiales.</th></tr>
                  
                  <form action="salida_consecutivo.php" method="post">
                  <tr>
                  <th colspan="6" align="center">Buscar por Ns de Orden de Salida  Desde: 
                    <input type="text" autofocus name="inicio" />&nbsp;</th>
                    <th colspan="5" align="center">Hasta: 
                    <input type="text" autofocus name="fin" />&nbsp;<input type="submit" value="Filtrar" /></th></tr></form>
                <tr>
                  <td>Orden N</td>
                  <td>Obra</td>
                  <td>Cod Obra</td>
                  <td>Despacho N</td>
                  <td>Fecha</td>
                  <td>Codigo Material</td>
                  <td>Descripcion</td>
                  <td>Unidad</td>
                  <td>Valor</td>     
                  <td>Cant Mat</td>
                  <td>Total</td>
                  </tr>           
                  
                
            </thead>
            <tbody>
            
            	<?php
            		if(isset($_POST['inicio']) && isset($_POST['fin'])){
            			
            					$inicial = $_POST['inicio'];
            					$final = $_POST['fin'];
					          		
		            		$result = $objMa->list_salida_consecutivo($inicial,$final);        	
						$numrows = mysql_num_rows($result);
						
						if($numrows > 0){
							
							while($salida=mysql_fetch_array($result)){?>
		                    
		                    	<tr>
		                            <td><?php echo $salida["orden"];?></td>                        	
		                            <td><?php echo $salida["obra"]; ?></td>
		                            <td><?php echo $salida["codobra"];?></td>
		                            <td><?php echo $salida["despacho"];?></td>
		                            <td><?php echo $salida["fecha"];?></td>
		                            <td><?php echo $salida["codmat"];?></td>
		                            <td><?php echo $salida["descripcion"];?></td>
		                            <td><?php echo $salida["unidad"];?></td>
		                            <td>$<?php echo $salida["valor"];?></td>
		                            <td><?php echo $salida["cantmat"];?></td>
		                            <td>$<?php echo $salida["total"];?></td>
		                            
		                        </tr>
		                        
								<?php
							}
							
						}
            		
            		
            		
            		
            		} //fin if isset
			
			
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