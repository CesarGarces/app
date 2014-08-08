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
$fact = $_GET['fact'];
$objRe = new Entrada();
$list_entrada = $objRe->list_entrada($fact);

?>

<form name="fact" action="entradas_exe.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="fact" value="<?php echo $fact;?>" />
        
    <table align="center" border="1">
      
        <tbody>
            
            
                          
                          
            <tr>
              <td>Factura</td>
              <td>Codigo</td>
              <td>Valor</td>                 
              <td>Cantidad</td>
              <td>Total</td>
          </tr>
                  <?php
                
				$num_rows = mysql_num_rows($list_entrada);
				
				if($num_rows > 0){
					
					if($row=mysql_fetch_array($list_entrada)){ ?>
              <tr>
              
                        <td><?php echo $row["nfac"]; ?></td>   
                        <td><?php echo $row["codmat"]; ?></td>
                        <td><?php echo $row["valor"]; ?></td>
                        <td><?php echo $row["cantmat"]; ?></td>
                        <td><?php echo $row["total"]; ?></td>
          
          <tr><td colspan="8" align="center"><input type="submit" name="send" id="send" value="SEND" /></td></tr>
				
           	<?php
					}
					
				}
				
				?>
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