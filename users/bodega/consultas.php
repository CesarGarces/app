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
$objUse = new Users();
$list_obra = $objOb->list_obra();
$img_users = $objUse->img_users();

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Consultas Frecuentes</title>
        <link href="../../libs/css/bootstrap.min.css" rel="stylesheet">
         <link href="../../libs/css/custom.css" rel="stylesheet">
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
        <li ><a href="obra_list.php">Obras</a></li>
        <li><a href="prov_list.php">Proveedores</a></li>
		<li><a href="bodega_list.php">Inventario en bodega</a></li>
		<li><a href="salida_list.php">Orden de salida</a></li>
        <li><a href="entrada_list.php">Orden de entrada</a></li>
        <li class="active"><a href="consultas.php">Consultas</a></li>
        <li><a href="log_out.php">Salir</a></li>
        </ul>
      </div>
        
    	<div class="container">
   		<ul class="menu-consultas">
   		
   			<li>
   				<a href="material_total_obra.php">
   					Calcular cantidad despachada de insumos según obra					
				</a>
			</li>
			<li>
				<a href="salida_list_obra.php">
					Listar Órdenes de salida según obra					
				</a>
			</li>
			<li>
				<a href="salida_list_obra_material.php">
					Consultar despacho de insumos según obra e Insumo		
				</a>
			</li>
			<li>
				<a href="salida_list_obra_material_distribuidor.php">
					Consultar distribuidor desde despacho de insumos según obra e Insumo
				</a>
			</li>
			<li>
				<a href="costo_total_obra.php">
					Calcular costo total de insumos despachado según obra					
				</a>
			</li>
			<li>
				<a href="salida_list_obra_material.php">
					Calcular costo total de insumo despachado según obra e Insumo		
				</a>
			</li>
			<li>
				<a href="salida_list_obra_material_fecha.php">
					Calcular costo total de insumo despachado según período de tiempo		
				</a>
			</li>
			<li>
				<a href="salida_fecha.php">
					Listar órdenes de salida según período de tiempo					
				</a>
			</li>
			<li>
				<a href="salida_consecutivo.php">
					Listar órdenes de salida según consecutivo					
				</a>
			</li>
			<li>
				<a href="entrada_devolucion.php">
					Consultar devolución de insumos según obra					
				</a>
			</li>
			<li>
				<a href="entrada_devolucion_total.php">
					Calcular costo total de insumo devuelto según obra					
				</a>
			</li>
			<li>
				<a href="bodega_list_total.php">
					Calcular costo total de insumos en bodega							
		   		</a>
		   	</li>
		   	<li>
				<a href="costo_total_obra.php">
					Calcular costo total de toda la obra							
		   		</a>
		   	</li>
   		</ul> 
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