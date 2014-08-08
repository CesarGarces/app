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

$var_calc = 2.44;
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Modulo APU!!</title>
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
       <form action="new_cot.php">
        <table align="center" class="table table-striped" border="1">
        	
            <thead>
            	<tr>
            	  <td colspan="11" align="center">Estructuras</td></tr>
                <tr>
                  <th colspan="11" align="center">Cielo!!!</th></tr>
                <tr>
                <tr>
                  <th colspan="2" align="center">Ancho  (PC perpendicular al ancho) (m) =</th>
                  <td colspan="4"><input type="text" name"cielo_ancho"></td>
                  </tr>
                  <tr>
                  <th colspan="2" align="center">Largo  (Omega perpendicular al largo) (m) =</th>
                  <td colspan="4"><input type="text" name"omega_largo"></td>
                  </tr>
                  <tr>
                  <th colspan="2" align="center">Espaciamiento de omega =</th>
                  <td colspan="4"><input type="text" name"omega_espa"></td>
                  </tr>
                <tr>
                  <td>Descripcion</td>
                  <td>Unidad</td>
                  <td>Cantidad</td>
                  <td>$ un</td>
                  <td>$ m/2</td>
                  <td>Chekear</td>
                  </tr>
                
            </thead>
            <tbody>
            
                    
                    	<tr>
                            <td>Perfil vigueta cielo cal 26   Steel</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>Perfil Omega  cal 26 con reborde</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.69"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>Perfil Omega  cal 26 sin revorde</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>Perfil vigueta cielo cal 26   Steel</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>Perfil Omega  cal 20 con reborde.</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>Angulo cal 26 2x3</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>Angulo cal 26 2x2</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>Chazo golpe</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>Clavo P8T 1508 para fijación con pistola</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>Carga verde 32 CW calibre 22</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>Clavo 1&quot; acero</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>Tornillo # 7x7/16&quot; perfil</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>Tornillo # 8x1/2&quot; punta DS</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>M.O. instalación retícula cielo</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>M.O. Variable dificultad</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                            <td>Transporte</td>
                        	<td>UN</td>
                            <td><input type="text" maxlength="5" name="cantidad" value="1.06"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="656"></td>
                            <td><input type="text" maxlength="5" name="cantidad" value="743"></td>
                            <td><input type="checkbox"></td>
                                                                                 
                        </tr>
                        <tr>
                        <td><select name="prod">   
    <?php   
    while ( $row = mysql_fetch_array($list_bodega) )   
    {
        ?>
   
        <option value=" <?php echo $row['codigo']; ?> " >
        <?php echo $row['nombre']; ?>
        </option>       
        <?php
    }   
    ?>       
</select></td>
<td><td><?php   
    while ( $row = mysql_fetch_array($list_bodega) )   
    {
         echo $row["valor"];}?></td></td>
                        </tr>
                        
            
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
    <script src="../libs/js/bootstrap.min.js"></script>
    </body>
</html>