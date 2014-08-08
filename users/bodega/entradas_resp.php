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
require'../class/warehouse.php';
//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();
$objWa = new Warehouse();
$list_bodega = $objWa->list_bodega();

$prov=$_POST['prov'];
$codprov=$_POST['codprov'];
$obra=$_POST['obra'];
$codobra=$_POST['codobra'];
$fact=$_POST['fact'];
$fecha=$_POST['fecha'];
$codigom=$_POST['codigo'];
$descrip=$_POST['nombre'];
$unidad=$_POST['unidad'];
$valor=$_POST['valor'];
$cantidad=$_POST['cantidad'];
$tipo_entrada=$_POST['tipo_entrada'];
$total= $valor * $cantidad;
?>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Orden de Entrada</title>
        <link href="../../libs/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../../favicon.ico">
    </head>
    <body>
    <form name="modProd" action="entradas_exe.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="fact" value="<?php echo $fact;?>" />
        <table align="center" border="1">
        <tr><td><table align="center" border="1">
          <thead>
          </thead>
          <th colspan="11" align="center">Orden de Entada</th>
                  <tr>
                    
                    <td>Proveedor</td>
                    <td>Codigo Proveedor</td>
                    <td>Nombre de Obra</td>
                    <td>Codigo de Obra</td>
                    <td>Factura N</td>
                    <td>Fecha</td>
                  </tr>
          <tbody>
            <tr>
              
              <td><input type="text" name="prov" value="<?php echo $prov; ?>"/></td>
              <td><input type="text" name="codprov" value="<?php echo $codprov; ?>" /></td>
              <td><input type="text" name="obra" value="<?php echo $obra; ?>"/></td>
              <td><input type="text" name="codobra" value="<?php echo $codobra; ?>"/></td>
              <td><input type="text" name="fact2" value="<?php echo $fact; ?>"/></td>
              <td><input type="text" name="fecha" value="<?php echo $fecha; ?>" placeholder="DD/MM/AAAA"/></td>
            </tr>
            <tr>
              <th colspan="11" align="center">Material</th>
            </tr>
            <tr>
              <td>Codigo</td>
              <td>Descripcion</td
              ><td>U/N</td
              ><td>Valor</td>
              <td>Cantidad</td>
              <td>Total</td>
            </tr>
            <tr>
              <td><input type="text" name="codigom"  value="<?php echo $codigom; ?>" /></td>
              <td><input type="text" name="descrip"  value="<?php echo $descrip; ?>" /></td>
              <td><input type="text" name="unidad"  value="<?php echo $unidad; ?>" /></td>
              <td><input type="text" name="valor" value="<?php echo $valor; ?>"/></td>
              <td><input type="text" name="cantidad" value="<?php echo $cantidad; ?>"/></td>
              <td><input type="text" name="total" value="<?php echo $total; ?>"/></td>
              <td><input type="text" name="tipo_entrada" value="<?php echo $tipo_entrada; ?>"/></td>
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