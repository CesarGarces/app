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
$objUse = new Users();
$img_users = $objUse->img_users();
$busqueda= $_POST['busqueda'];
$busqueda_ent = $objMa->busqueda_ent($busqueda);
$suma_ent = $objSe->suma_ent($busqueda);

$prov=$_POST['prov'];
$codprov=$_POST['codprov'];
$obra=$_POST['obra'];
$codobra=$_POST['codobra'];
$fact=$_POST['factura'];
$fecha=$_POST['fecha'];
$valor=$_POST['valor'];
$orden=$_POST['orden'];
$tipo=$_POST['tipo'];






?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Orden de Entrada de materiales</title>
        <link href="../../libs/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../../favicon.ico">
    </head>
    <script type="text/javascript"> function auto_print_page() { window.print(); } </script>
    <style type="text/css">
@font-face {
 font-family: Livianos;
 src: url("../../libs/fonts/Arkitech-Light.eot") /* EOT file for IE */
}
@font-face {
 font-family: Livianos;
 src: url("../../libs/fonts/Arkitech-Light.ttf") /* TTF file for CSS3 browsers */
}
body {
 font-family: Livianos, Verdana, Arial, sans-serif;
 font-size:11px;
 color: black
}
</style>
    <body>
    
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
     <table align="center" width="918">  
    <tr><td width="500" height="157" align="left"><img src="../global/img/logo_corpo.jpg" height="155" width="322" alt="logo"></td><td align="center" background="../global/img/fondo_tabla.jpg"><b><h4><font color="#000000">ORDEN DE ENTRADA DE MATERIAL</font> <p><font color="#000000">N. <?php echo $orden; ?></font></p></h4></b></td></tr>
    </table>
    <p></p>
    <p></p>
    <p><table align="center" width="918" border="0" bgcolor="#C0C0C2">
    <tr>
      <td width="504"></td>
     
      <td width="188">&nbsp;</td>
      <td align="right" width="204"><?php
	                    if ($tipo == 0){
							echo "Compra";
							}else{
								echo "Devolución";
							}
							?>
       
       </td>
     
      </tr>
      </table>
    </p>
    <p></p>
    <table align="center" width="918" border="1" bgcolor="#C0C0C2">
    <tr>
      <td bgcolor="#C0C0C2" width="329">PROVEEDOR</td><td bgcolor="#C0C0C2" width="160"><?php echo $prov ?></td>
      <td bgcolor="#C0C0C2" width="265">OBRA</td><td bgcolor="#C0C0C2" width="136"><?php echo $obra ?></td></tr>
    <tr>
      <td bgcolor="#C0C0C2">CODIGO DE PROVEEDOR</td><td bgcolor="#C0C0C2"><?php echo $codprov ?></td>
      <td bgcolor="#C0C0C2">&nbsp;</td><td bgcolor="#C0C0C2"></td></tr>
    <tr>
      <td bgcolor="#C0C0C2">FACTURA N</td><td bgcolor="#C0C0C2"><?php echo $fact ?></td>
      <td bgcolor="#C0C0C2">CODIGO DE OBRA</td><td bgcolor="#C0C0C2"><?php echo $codobra ?></td></tr>
    <tr>
      <td bgcolor="#C0C0C2">FECHA</td><td bgcolor="#C0C0C2"><?php echo $fecha ?></td>
      <td bgcolor="#C0C0C2">&nbsp;</td><td bgcolor="#C0C0C2"></td></tr>
    </table>
    <p></p>
    <p></p>
    <p></p>
    <table align="center" width="918" border="1" background="../global/img/fondo_trans.png">
    <tr align="center">
      <td bgcolor="#C0C0C2" width="302">CODIGO</td>
      <td bgcolor="#C0C0C2" width="302">DESCRIPCION</td>
      <td bgcolor="#C0C0C2" width="302">U/N</td>
      <td bgcolor="#C0C0C2" width="228">CANTIDAD</td>
      <td bgcolor="#C0C0C2" width="197">VALOR</td>
      <td bgcolor="#C0C0C2" width="163">TOTAL</td>
      </tr>
  
      <?php
        	
				$numrows = mysql_num_rows($busqueda_ent);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($busqueda_ent)){?>
                    
                    	<tr>
                            <td align="center"><?php echo $row["codmat"];?></td>
                            <td align="center"><?php echo $row["descrip"];?></td>
                            <td align="center"><?php echo $row["unidad"];?></td>
                            <td align="center"><?php echo $row["cantmat"];?></td>
                            <td align="center">$<?php echo $row["valor"];?></td>     
                            <td align="center">$<?php echo $row["total"];?></td>
                            
							
                        </tr>
                        
						<?php
					}
					
				}
			
				?>
      
       <tr>
         <td colspan="5" align="right" border="0">
        TOTAL CON IVA 
      <td align="right"><b>$<?php
        	
	
		 $query = mysql_query("SELECT SUM(total) FROM entrada WHERE nfac = '".$busqueda."'");
         $resultado = mysql_result($query, 0);
		 echo $resultado;
				?></b></td>
      </table>
   <p></p> 
        <p></p>
        <p></p>
        <p>
        <table align="center" width="918">
    <tr>
      <td>
        <textarea name="observ" style="font-size:9px ; width:918px">OBSERVACIONES: </textarea></p></td></tr></table>     
      <p></p>
      <p></p>
      <p></p>
      <table align="center" width="918">
    <tr><td width="470" style="font-size:9px">__________________________</td><td width="436" style="font-size:9px">__________________________</td></tr>
    <tr><td style="font-size:9px">DESPACHA</td><td style="font-size:9px">RECIBE</td></tr>
    <tr><td style="font-size:9px">CC</td><td style="font-size:9px">CC</td></tr>
    </table>
        <p>
          <script src="https://code.jquery.com/jquery.js"></script>
          
          <!-- Include all compiled plugins (below), or include individual files as needed -->        </p>
        <p>&nbsp;</p>
        <p><script src="../../libs/js/bootstrap.min.js"></script>
        </p>
    </body>
</html>