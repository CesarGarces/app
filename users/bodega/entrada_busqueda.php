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
require'../class/entradas.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objMa = new Entrada();
$objSe = new Entrada();
$objSa = new Entrada();
$objUse = new Users();
$img_users = $objUse->img_users();
$busqueda= $_POST['busqueda'];
$busqueda_ent = $objMa->busqueda_ent($busqueda);
$suma_ent = $objSe->suma_ent($busqueda);
$single_fac = $objSa->single_fac($busqueda);


?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Orden De Entrada</title>
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
        <li class="active"><a href="entrada_list.php">Orden de entrada</a></li>
        <li><a href="consultas.php">Consultas</a></li>
        <li><a href="log_out.php">Salir</a></li>
        </ul>
    </div>
        
    <div class="container">
       <div class="table-responsive"> 
       <form name="modOb" action="entrada_web.php" method="post" target="_blank">
    <table align="left" class="table table-striped" border="1">
        	
            <thead>
            	<tr>
                
            	  <td colspan="11" align="center"><a href="orden_entrada.php">Nueva Orden Entrada</a></td></tr>
                <tr>
                  <th colspan="2" align="center">Factura N <input type="text" name="factura" value="<?php echo $busqueda; ?>" /></th> 
				</tr>
                <tr>
                  <td>Orden N</td>
                  <td>Proveedor</td>
                  <td>Codigo Prov</td>
                  <td>Obra</td>
                  <td>Cod Obra</td>
                  <td>Fecha</td>
                                     
            </thead>
            <tbody>
            
            	 <?php
        	
				           $numrows = mysql_num_rows($single_fac);
				
				           if($numrows > 0){
					
					       while($row=mysql_fetch_array($single_fac)){?>
                    
                    	<tr>
                        <td><input type="text" name="orden" value="<?php echo $row["codentr"];?>" /></td>
                            <td><input type="text" name="prov" value="<?php echo $row["prov"];?>" /></td>
                        	<td><input type="text" name="codprov" value="<?php echo $row["codprov"];?>" /></td>
                            <td><input type="text" name="obra" value="<?php echo $row["obra"]; ?>" /></td>
                            <td><input type="text" name="codobra" value="<?php echo $row["codobra"];?>" /></td>
                            <td><input type="text" name="fecha" value="<?php echo $row["fecha"];?>" /></td>
                            
                            </tr>
                            	<?php
					}
					
				}
			
				?>
                            <tr>
                            <td>Codigo Material</td>
                            <td>Descripcion</td>
                            <td>Unidad</td>
                            <td>Valor</td>     
                            <td>Cant Mat</td>
                            <td>Total</td> 
                            </tr>
                            <?php
        	
				           $numrows = mysql_num_rows($busqueda_ent);
				
				           if($numrows > 0){
					
					       while($row=mysql_fetch_array($busqueda_ent)){?>
                            <tr>  
                            <td><input type="text" name="codmat" value="<?php echo $row["codmat"];?>" /></td>
                            <td><input type="text" name="descrip" value="<?php echo $row["descrip"];?>" /></td>
                            <td><input type="text" name="unidad" value="<?php echo $row["unidad"];?>" /></td>
                            <td><input type="text" name="valor" value="$<?php echo $row["valor"];?>" /></td>
                            <td><input type="text" name="cantmat" value="<?php echo $row["cantmat"];?>" /></td>
                            <td><input type="text" name="total" value="$<?php echo $row["total"];?>" /></td>
                            <td><input type="hidden" name="tipo" value="<?php echo $row["tipo_entrada"];?>" /></td>
                            
							
                        </tr>
                        
						<?php
					}
					
				}
			
				?>
            
            <tr><td colspan="5" align="right">
        Total:</td><td> <input type="text" name="ptotal" value="$<?php
        	
		
		 $query = mysql_query("SELECT SUM(total) FROM entrada WHERE nfac = '".$busqueda."'");
         $resultado = mysql_result($query, 0);
		 echo $resultado;
				?>" />
                <input type="hidden" name="busqueda" value="<?php echo $busqueda;?>" />
                </td></tr>
                <tr><td align="center" colspan="6"><input type="submit" name="send" id="send" value="IMPRIMIR" /></td></tr>
             </tbody>
        
        </table>   
        </form>
        
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