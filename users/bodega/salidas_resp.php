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
require'../class/warehouse.php';
//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();
$objWa = new Warehouse();
$list_bodega = $objWa->list_bodega();

$orden=$_POST['orden'];
$obra=$_POST['obra'];
$codobra=$_POST['codobra'];
$despacho=$_POST['despacho'];
$fecha=$_POST['fecha'];
$codigom=$_POST['codigo'];
$desc=$_POST['nombre'];
$unidad=$_POST['unidad'];
$valor=$_POST['valor'];
$cantidad=$_POST['cantidad'];
$compra=$_POST['compra'];
$materiales = $cantidad + $compra;
$total= $valor * $materiales;
?>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Orden de Salida</title>
        <link href="../../libs/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../../favicon.ico">
    </head>
    <body>
    <form name="modProd" action="salidas_exe.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="fact" value="<?php echo $fact;?>" />
        <table align="center" border="1">
        <tr><td><table align="center" border="1">
          <thead>
          </thead>
            <th colspan="11" align="center">Orden de Salida</th>
                  <tr>
                    <td>Orden N</td>
                    <td>Nombre de Obra</td>
                    <td>Codigo de Obra</td>
                    <td>Despacho N</td>
                    <td>Fecha</td>
                  </tr>
          <tbody>
            <tr>
              <td><input type="text" name="orden" value="<?php echo $orden; ?>"/></td>
              <td><input type="text" name="obra" value="<?php echo $obra; ?>"/></td>
              <td><input type="text" name="codobra" value="<?php echo $codobra; ?>"/></td>
              <td><input type="text" name="despacho" value="<?php echo $despacho; ?>"/></td>
              <td><input type="text" name="fecha" value="<?php echo $fecha; ?>" placeholder="DD/MM/AAAA"/></td>
            </tr>
            <tr>
              <th colspan="11" align="center">Material</th>
            </tr>
            <tr>
              <td>Codigo</td>
              <td>Descripcion</td>
              <td>Unidad</td>
              <td>Valor</td>
              <td>Cantidad</td>
              <td>Compra</td>
              <td>Total</td>
            </tr>
            <tr>
              <td><input type="text" name="codigom"  value="<?php echo $codigom; ?>" /></td>
              <td><input type="text" name="desc"  value="<?php echo $desc; ?>" /></td>
              <td><input type="text" name="unidad"  value="<?php echo $unidad; ?>" /></td>
              <td><input type="text" name="valor" value="<?php echo $valor; ?>"/></td>
              <td><input type="text" name="cantidad" value="<?php echo $cantidad; ?>"/></td>
              <td><input type="text" name="compra" value="<?php echo $compra; ?>"/></td>
              <td><input type="text" name="total" value="<?php echo $total; ?>"/></td>
            </tr>
            <tr><td colspan="8" align="center"><input type="submit" name="send" id="send" value="SEND" /></td></tr>
          </tbody>
          
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
    <script src="../../libs/js/bootstrap.min.js"></script>
    </body>
</html>