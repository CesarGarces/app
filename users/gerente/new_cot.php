<script type="text/javascript">
<!--
num=0;
function crear(obj) {
  num++;
  fi = document.getElementById('fiel'); // 1
  contenedor = document.createElement('div'); // 2
  contenedor.id = 'div'+num; // 3
  fi.appendChild(contenedor); // 4
 
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'producto'+num; // 6
  contenedor.appendChild(ele); // 7
  
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'codProd'+num; // 6
  contenedor.appendChild(ele); // 7
  
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'descripcion'+num; // 6
  contenedor.appendChild(ele); // 7
  
  
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'unidad'+num; // 6
  contenedor.appendChild(ele); // 7
  
  
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'cantidad'+num; // 6
  contenedor.appendChild(ele); // 7
  
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'valor'+num; // 6
  contenedor.appendChild(ele); // 7
  
  
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'total'+num; // 6
  contenedor.appendChild(ele); // 7
  
  
  
  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = 'Borrar'; // 8
  ele.name = 'div'+num; // 8
  ele.onclick = function () {borrar(this.name)} // 9
  contenedor.appendChild(ele); // 7
}
function borrar(obj) {
  fi = document.getElementById('fiel'); // 1 
  fi.removeChild(document.getElementById(obj)); // 10
}
--> 
</script>

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
$objUse = new Users();
$img_users = $objUse->img_users();
$objWa = new Warehouse();

$contador = "<script> document.write(num) </script>";

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Modulo de Cotizacion!!</title>
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
        <p><center>
          <p><img src="../global/img/logo_cotizacion.jpg"></p>
          <p><?php require'../class/fecha.php';?>-<?php require'../class/hora.php';?></p>
          <p>&nbsp;</p>
        </center>
        </p>
        
        <form name="newCot" action="new_cot_exe.php" method="post">
        <table width="622" border="1" align="center">
        	
            <td colspan="2"><p>Señor(a): <input type="text" autofocus  name="nombreCliente" placeholder="Nombre Cliente" /></p>
              
              <p><input type="text"  name="nombreEmpresa" placeholder="Nombre Empresa" /></p></td>
            <tr>
              <td><p>Asunto:</p>
              <p><textarea name="asunto"></textarea></p></td></tr>
              <tr>
              <td><p>Obra: <input type="text"  name="nombreObra" placeholder="Obra" /> 
                  Codigo: 
                  <input type="text"  name="codigoObra" placeholder="Codigo Obra" /></p>
             </td>
            </table>
        <blockquote>
          <blockquote>
            
            <center><p>Cordial saludo;
                    </p>
                    <p>Presento la cotización de la obra del asunto para su estudio.  Cualquier inquietud al respecto la atenderé a la mayor brevedad posible. </p>  </center>
          </blockquote>
        </blockquote>
        
        <table width="622" align="center">
        	
            <tr> 
            	  <td></td>
            	  <td>Producto</td>                  
                  <td>Codigo de Producto</td>
                  <td>Descripcion</td>                  
                  <td>Unidad</td>
                  <td>Cantidad</td>
                  <td>$Unit</td>
                  <td>$ Total</td>
            </tr>
            <tr>  <td></td>
            	  <td><input type="text"  name="producto"  /></td>                  
                  <td><input type="text"  name="codProd" /></td>
                  <td><input type="text"  name="descripcion"  /></td>                  
                  <td><input type="text"  name="unidad" /></td>
                  <td><input type="text"  name="cantidad" /></td>
                  <td><input type="text"  name="valor" /></td>
                  <td><input type="text"  name="total" /></td>                  
            </tr> 
            <tr><td><input type="button" value="Agregar" onClick="crear(this)" /></td>
            <td colspan="9"><fieldset id="fiel">
          </fieldset></td></tr>
<tr><td colspan="8" align="center"><input type="submit" name="send" id="send" value="Enviar" /> 
  </td></tr>
            </table>
            
        </form>
        </div>
        </div>
        </div>
    <p>&copy; <a href="http://co.linkedin.com/in/cesargarces" target="_blank">Cesar Garces 2014</a></p>
      </footer>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../libs/js/bootstrap.min.js"></script>
    </body>
</html>